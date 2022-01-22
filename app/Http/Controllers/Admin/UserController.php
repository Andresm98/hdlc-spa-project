<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

use PDF;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // return Inertia::render('Users/Index', [
    //     'usersList' => $usersList
    // ]);
    public function index()
    {
        $team = Team::find(1);  //Admin Team

        $user = auth()->user();

        if (!$user->hasTeamPermission($team, 'edit')) {
            abort(403, "No tiene permisos");
        }

        $users_list = User::orderBy('id', 'asc')
            ->paginate(10);
        return Inertia::render('Users/Index', compact('users_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team = Team::find(1);  //Admin Team

        $user = auth()->user();

        if (!$user->hasTeamPermission($team, 'edit')) {
            abort(403, "No tiene permisos");
        }

        return Inertia::render('Users/Create');
    }

    public function dd()
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $user = tap(User::create([
            'username' => $request->get('username'),
            'slug' => Str::slug($request->get('username') . '-' . random_int(100, 10000)),
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'password' => Str::random(233),
        ]), function (User $user) {
            $this->createTeam($user);
        });

        // Input File
        $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->slug, 's3');
        Storage::disk('s3')->setVisibility($path, 'private');
        $user->image()->create([
            'filename' => $path,
            'url' => Storage::disk('s3')->url($path)
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_custom = User::select()->where('slug', $id)->get();
        $user = User::find($user_custom[0]['id']);
        if ($user->image) {
            $image = Storage::disk('s3')->temporaryUrl(
                $user->image->filename,
                now()->addMinutes(5)
            );
            return Inertia::render('Users/Show', compact('user_custom', 'image'));
        }
        return Inertia::render('Users/Show', compact('user_custom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_customa = User::select()->where('slug', $id)->get();
        $user_custom = User::find($user_customa[0]['id']);
        if ($user_custom->image) {
            $image = Storage::disk('s3')->temporaryUrl(
                $user_custom->image->filename,
                now()->addMinutes(5)
            );
            return Inertia::render('Users/Edit', compact('user_custom', 'image'));
        }
        return Inertia::render('Users/Edit', compact('user_custom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255|',
            'email' => 'required|email|max:225|' . Rule::unique('users')->ignore($user->id),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }
        // Input File

        if ($request->file('file')) {
            if (!$user->image) {
                $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->slug, 's3');
                Storage::disk('s3')->setVisibility($path, 'private');
                $user->image()->create([
                    'filename' => $path,
                    'url' => Storage::disk('s3')->url($path)
                ]);
            }
            Storage::disk('s3')->delete($user->image->filename);
            $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->slug, 's3');
            Storage::disk('s3')->setVisibility($path, 'private');
            $user->image()->update([
                'filename' => $path,
                'url' => Storage::disk('s3')->url($path)
            ]);
        }

        $user->update($request->all());
        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userCustom = User::find($id);
        if ($userCustom->name == 'Admin') {
            return redirect()->route('admin.users.index')->with('error', 'No se puede eliminar.');
        }
        $userCustom->delete();
        return redirect()->route('admin.users.index')->with('success', 'Eliminado correctamente.');
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' Equipo de ', $user->name, 2)[0] . "",
            'personal_team' => true,
        ]));
    }

    public function welcome()
    {
        return Inertia::render('Users/Welcome');
    }


    public function PDF()
    {
        $users = User::all();
        // return view('report', compact('users'));
        $pdf = PDF::loadView('report', compact('users'));
        // return $pdf -> download('Usuarios-OpenScience.pdf');
        return $pdf->setPaper('a4', 'landscape')->stream('UsuariosHDLC.pdf');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Team;
use App\Models\User;
use App\Models\Zone;
use Inertia\Inertia;
use App\Models\Profile;
use App\Models\Pastoral;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\AppointmentLevel;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    public function  __construct()
    {
        $this->middleware('can:create users')->only('create', 'store', 'createTeam');
        $this->middleware('can:read users')->only('index', 'show');
        $this->middleware('can:update users')->only('edit', 'update');
        $this->middleware('can:delete users')->only('delete', 'destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function welcome()
    {
        $users = count(User::all());
        $roles        = count(Role::all());
        $permissions = count(Permission::all());
        $pastorals = count(Pastoral::all());
        $appointments = count(AppointmentLevel::all());
        $zones = count(Zone::all());

        return Inertia::render('Admin/Welcome', compact(
            'users',
            'roles',
            'permissions',
            'pastorals',
            'appointments',
            'zones',
        ));
    }

    // return Inertia::render('Users/Index', [
    //     'usersList' => $usersList
    // ]);
    public function index()
    {
        // $team = Team::find(1);  //Admin Team
        // $user = auth()->user();
        // if (!$user->hasTeamPermission($team, 'edit')) {
        //     abort(403, "No tiene permisos");
        // }
        $validator = Validator::make(request()->all(), [
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email'],
            'role' => ['exists:roles,name']
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'No se encuentran resultados.']);
        }

        $query = User::query();

        if (request('search')) {
            $search = request('search');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
                $query->orWhere('lastname', 'LIKE', '%' . $search . '%');
            });
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        if (request('role')) {
            $query->whereHas("roles", function ($q) {
                $q->where("name", "=", request('role'));
            });
        }

        $roles  = Role::all();
        return Inertia::render('Admin/Users/Index', [
            'users_list' => $query
                ->paginate(10)
                ->appends(request()->query()),
            'roles' => $roles,
            'filters' => request()->all(['search', 'field', 'direction', 'page', 'role'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $team = Team::find(1);  //Admin Team

        // $user = auth()->user();

        // if (!$user->hasTeamPermission($team, 'edit')) {
        //     abort(403, "No tiene permisos");
        // }

        return Inertia::render('Admin/Users/Create');
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
            'username' => 'required|string|max:60|unique:users',
            'name' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'email' => 'required|string|email|max:60|unique:users',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $user = tap(User::create([
            'username' => $request->get('username'),
            'slug' => Str::slug($request->get('name') . '-' . $request->get('lastname') . '-' . random_int(100, 10000)),
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'password' => Hash::make("secret"),
        ]), function (User $user) {
            $this->createTeam($user);
        });

        // Input File
        $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->id, 's3');
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
    public function show($slug)
    {

        $validator = Validator::make(['slug' => $slug], [
            'slug' => ['required', 'string', 'alpha_dash', 'exists:users,slug']
        ]);

        if ($validator->fails()) {
            abort(404);
        } else {
            $user_custom = User::select()
                ->where('slug', '=', [$slug])
                ->get()
                ->first();
            $user =  User::find($user_custom->id);
            if ($user->image) {
                $image = Storage::disk('s3')->temporaryUrl(
                    $user->image->filename,
                    now()->addMinutes(5)
                );
                return Inertia::render('Admin/Users/Show', compact('user_custom', 'image'));
            }
            return Inertia::render('Admin/Users/Show', compact('user_custom'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {

        $validator = Validator::make(['slug' => $slug], [
            'slug' => ['required', 'string', 'alpha_dash', 'exists:users,slug']
        ]);

        if ($validator->fails()) {
            abort(404);
        } else {
            $user_custom = User::select()
                ->where('slug', '=', [$slug])
                ->get()
                ->first();
            $user =  User::find($user_custom->id);

            $rolesAvailable = Role::all();
            $roles = collect();
            foreach ($user_custom->roles as $role) {
                $roles->push($role->id);
            }
            if ($user_custom->image) {
                $image = Storage::disk('s3')->temporaryUrl(
                    $user_custom->image->filename,
                    now()->addMinutes(5)
                );
                return Inertia::render('Admin/Users/Edit', compact('user_custom', 'image', 'rolesAvailable', 'roles'));
            }
            return Inertia::render('Admin/Users/Edit', compact('user_custom', 'rolesAvailable', 'roles'));
        }
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

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'roles*' => 'nullable|exists:roles,id',
            'file' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', 'Usuario no fue actualizado correctamente.')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $user =  User::find($id);
            if ($request->file('file')) {
                if (!$user->image) {
                    $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->id, 's3');
                    Storage::disk('s3')->setVisibility($path, 'private');
                    $user->image()->create([
                        'filename' => $path,
                        'url' => Storage::disk('s3')->url($path)
                    ]);
                } else {
                    Storage::disk('s3')->delete($user->image->filename);
                    $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->id, 's3');
                    Storage::disk('s3')->setVisibility($path, 'private');
                    $user->image()->update([
                        'filename' => $path,
                        'url' => Storage::disk('s3')->url($path)
                    ]);
                }
            }
            $user->update(
                [
                    'name' => $request->get('name'),
                    'lastname' => $request->get('lastname'),
                    'email' => $request->get('email'),
                ]
            );

            if ($user->id == 1) {
                return redirect()->back()->with('success', 'Usuario Administrador actualizado correctamente a excepción de sus roles.');
            }
            $user->roles()->sync($request->roles);
            return redirect()->back()->with('success', 'Usuario actualizado correctamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $validator = Validator::make(['slug' => $slug], [
            'slug' => ['required', 'string', 'alpha_dash', 'exists:users,slug']
        ]);

        if ($validator->fails()) {
            abort(404);
        } else {
            $user_custom = User::select('id')
                ->where('slug', '=', [$slug])
                ->get()
                ->first();

            $user =  User::find($user_custom->id);

            if ($user->id == 1) {
                return redirect()->route('admin.users.index')->with('error', 'No se puede eliminar.');
            }

            if ($user->profile) {
                if ($user->profile->info_family) {
                    $user->profile->info_family()->delete();
                }
                if ($user->profile->academic_trainings) {
                    $user->profile->academic_trainings()->delete();
                }
                if ($user->profile->transfers) {
                    $user->profile->transfers()->delete();
                }
                if ($user->profile->healths) {
                    $user->profile->healths()->delete();
                }
                if ($user->profile->permits) {
                    $user->profile->permits()->delete();
                }
                if ($user->profile->appointments) {
                    $user->profile->appointments()->delete();
                }
                if ($user->profile->sacraments) {
                    $user->profile->sacraments()->delete();
                }
                if ($user->profile->address) {
                    $user->profile->address()->delete();
                }
                if ($user->profile->files) {
                    $user->profile->files()->delete();
                }
                $user->profile->delete();
            }

            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Eliminado correctamente.');
        }
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

    public function PDF()
    {
        $users = User::all();
        // return view('report', compact('users'));
        $pdf = PDF::loadView('reports.daughters.profile', compact('users'));
        // return $pdf -> download('Usuarios-OpenScience.pdf');
        return $pdf->setPaper('a4', 'portrait')->stream('UsuariosHDLC.pdf');
    }
}

<?php

namespace App\Http\Controllers\Secretary\Daughter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use PDF;
use Spatie\Permission\Models\Permission;

// Inject

use App\Http\Controllers\Secretary\Daughter\ProfileController;
use App\Http\Controllers\AddressController;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function welcome()
    {
        $users = count(User::all());
        $roles  = count(Role::all());
        $permissions = count(Permission::all());
        return Inertia::render('Secretary/Welcome', compact('users', 'roles', 'permissions'));
    }

    function allDaughters($query)
    {
        return   $query->whereHas("roles", function ($q) {
            $q->where("name", "daughter");
        })->paginate(10)
            ->appends(request()->query());
    }

    public function index()
    {

        //                              OBJECT
        // return  User::whereHas("roles", function ($q) {
        // $q->where("name", "daughter");
        // })->get();
        // return User::role('daughter')->get();

        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email']
        ]);

        $query = User::query();

        if (request('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        $result_filters = request()->all(['search', 'field', 'direction', 'page']);

        return Inertia::render('Secretary/Users/Daughter/Index', [
            'daughters_list' => $this->allDaughters($query),
            'filters' => $result_filters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            'slug' => ['required', 'string', 'max:50', 'alpha_dash', 'exists:users,slug']
        ]);

        // Import Methods
        $profile_daughter = new ProfileController();
        $addressClass = new AddressController();
        $provinces =  $addressClass->getProvinces();

        if ($validator->fails()) {
            abort(404);
        } else {
            $daughter_custom = User::select()
                ->where('slug', '=', [$slug])
                ->get()
                ->first();

            $user = User::find($daughter_custom->id);
            $profile_daughter =   $profile_daughter->specificProfile($daughter_custom->id);

            if ($daughter_custom->image) {
                $image = Storage::disk('s3')->temporaryUrl(
                    $daughter_custom->image->filename,
                    now()->addMinutes(5)
                );
                return Inertia::render('Secretary/Users/Daughter/Edit', compact('daughter_custom', 'image', 'profile_daughter', 'provinces'));
            }
            return Inertia::render('Secretary/Users/Daughter/Edit', compact('daughter_custom', 'profile_daughter', 'provinces'));
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
            'roles*' => 'required|exists:roles,id',
            'file' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $user =  User::find($id);
            if ($request->file('file')) {
                if (!$user->image) {
                    $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->slug, 's3');
                    Storage::disk('s3')->setVisibility($path, 'private');
                    $user->image()->create([
                        'filename' => $path,
                        'url' => Storage::disk('s3')->url($path)
                    ]);
                } else {
                    Storage::disk('s3')->delete($user->image->filename);
                    $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->slug, 's3');
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
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /*
 *  Protect Routes with permission and roles Middlewares
 */
    public  function __construct()
    {
        $this->middleware('can:create roles')->only('create', 'store');
        $this->middleware('can:read roles')->only('index');
        $this->middleware('can:update roles')->only('edit', 'update');
        $this->middleware('can:delete roles')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $roles_list = Role::orderBy('id', 'asc')
        //     ->paginate(2);
        // return Inertia::render('Admin/Roles/Index', compact('roles_list'));
        $availablePermissions = Permission::all();
        $roles = Role::with('permissions')->get();
        return Inertia::render(
            'Admin/Roles/IndexR',
            [
                'availablePermissions' => $availablePermissions,
                'roles' => $roles,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $availablePermissions = Permission::all();
        return Inertia::render('Admin/Roles/IndexR', compact('availablePermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:roles',
                'permissions*' => 'required'
            ]
        );
        $role = Role::create([
            'name' => $request->name
        ]);

        $role->permissions()->attach($request->permissions);
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return redirect()->route('admin.roles.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate(
            [
                'name' => 'required|unique:roles,name,' . $role->id,
                'permissions' => 'required'
            ]
        );

        $role->permissions()->sync($request->permissions);
        $role->update(['name' => $request->name]);

        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        $roles_list = Role::orderBy('id', 'asc')
            ->paginate(2);
        return redirect()->route('admin.roles.index');
    }
}

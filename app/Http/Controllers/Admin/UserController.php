<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Http\Requests\StoreUserPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersList = User::orderBy('id', 'desc')
            ->paginate(10);

        return Inertia::render('Users/Index', [
            'usersList' => $usersList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function dd(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {
        User::create($request->validated());
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userCustom = User::find($id);
        return Inertia::render('Users/Show', compact('userCustom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_custom = User::find($id);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:225|' . Rule::unique('users')->ignore($user->id),
            'password' => 'nullable'
        ]);

        if (!$validator->validated()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('Actualizado correctamente.');
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
        if ($userCustom->name == 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'No se puede eliminar.');
        }
        $userCustom->delete();
        return redirect()->route('admin.users.index')->with('success', 'Eliminado correctamente.');
    }
}

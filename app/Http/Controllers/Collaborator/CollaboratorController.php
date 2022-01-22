<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Laravel\Jetstream\Features;
use Inertia\Inertia;

class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team = Team::find(3); // id_team Collaborator
        $user = auth()->user(); // user auth

        if (!$user->hasTeamPermission($team, 'read')) {
            abort(401, 'No puede ver, solo colaboradores');
        }
        return Inertia::render('Collaborator/Index');
    }


    public function mod()
    {
        $team = Team::find(3); // id_team Collaborator
        $user = auth()->user(); // user auth

        if (!$user->hasTeamPermission($team, 'mod')) {
            abort(401, 'NOOOOOr');
        }
        return "metodo modificado colaborador";
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "Crear contenido colaborador (create)";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Mostrar contenido de colaborador (show)";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "Editar el contenido del colaborador (edit)";
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "Eliminar el contenido del colaborador (destroy)";
    }
}

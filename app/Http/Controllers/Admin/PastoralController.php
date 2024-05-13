<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Pastoral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PastoralController extends Controller
{
    public function  __construct()
    {
        $this->middleware('can:create pastoral')->only('create', 'store');
        $this->middleware('can:read pastoral')->only('index', 'show');
        $this->middleware('can:update pastoral')->only('edit', 'update');
        $this->middleware('can:delete pastoral')->only('delete', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pastoral = Pastoral::all();
        return Inertia::render(
            'Admin/Pastoral/Index',
            compact('pastoral')
        );
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
        $validator = Validator::make($request->all(), [
            "name" => ['required', 'string', 'max:50', 'unique:pastorals'],
            "description" => ['string', 'string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        Pastoral::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);
        return redirect()->back()->with(['success' => 'Pastoral creada correctamente.']);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pastoral $pastoral)
    {
        $request->validate(
            [
                'name' => 'required|max:50|unique:pastorals,name,' . $pastoral->id,
                "description" => ['string', 'string', 'max:100'],
            ]
        );

        $pastoral->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return redirect()->back()->with(['success' => 'Pastoral actualizada correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pastoral $pastoral)
    {
        try {
            $pastoral->delete();
            return redirect()->back()->with(['success' => 'Pastoral eliminada correctamente.']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with(['error' => 'Pastoral no puede ser eliminada.']);
        }
    }
}

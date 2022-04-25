<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::all();
        return Inertia::render(
            'Admin/Office/Index',
            compact('offices')
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
            "office_name" => ['required', 'string', 'max:50', 'unique:offices'],
            "office_observation" => ['string', 'string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        Office::create([
            'office_name' => $request->get('office_name'),
            'office_observation' => $request->get('office_name'),
        ]);
        return redirect()->back()->with(['success' => 'Oficio creado correctamente.']);
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
    public function update(Request $request, Office $office)
    {
        $request->validate(
            [
                'office_name' => 'required|max:50|unique:offices,office_name,' . $office->id,
                "office_observation" => ['string', 'string', 'max:100'],
            ]
        );

        $office->update([
            'office_name' => $request->get('office_name'),
            'office_observation' => $request->get('office_name'),
        ]);

        return redirect()->back()->with(['success' => 'Officio actualizado correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        try {
            $office->delete();
            return redirect()->back()->with(['success' => 'Oficio eliminado correctamente.']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with(['error' => 'El oficio no puede ser eliminado.']);
        }
    }
}

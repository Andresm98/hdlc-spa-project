<?php

namespace App\Http\Controllers\Admin;

use App\Models\Zone;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zone = Zone::all();
        return Inertia::render(
            'Admin/Zone/Index',
            compact('zone')
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
            "name" => ['required', 'string', 'max:50', 'unique:zones'],
            "description" => ['string', 'string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        Zone::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);
        return redirect()->back()->with(['success' => 'Zona creada correctamente.']);
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
    public function update(Request $request, Zone $zone)
    {
        $request->validate(
            [
                'name' => 'required|max:50|unique:zones,name,' . $zone->id,
                "description" => ['string', 'string', 'max:100'],
            ]
        );

        $zone->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return redirect()->back()->with(['success' => 'Zona actualizada correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        try {
            $zone->delete();
            return redirect()->back()->with(['success' => 'Zona eliminada correctamente.']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with(['error' => 'Zona no puede ser eliminada.']);
        }
    }
}

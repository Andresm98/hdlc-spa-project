<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\AppointmentLevel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AppointmentLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointmentlevels = AppointmentLevel::where('appointment_levelc_id', '=', null)
            ->orWhere('level', '=', 1)
            ->get();

        return Inertia::render(
            'Admin/Council/Index',
            compact('appointmentlevels')
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
            "name" => ['required', 'string', 'max:50', 'unique:appointment_levels'],
            "description" => ['string', 'string', 'max:400'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        AppointmentLevel::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'level' => 1,
            'last_level' => 'N'
        ]);
        return redirect()->back()->with(['success' => 'Nivel creado correctamente.']);
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
    public function update(Request $request, AppointmentLevel $appointmentlevel)
    {
        $validator = Validator::make($request->all(), [
            "name" => ['required', 'string', 'max:50', 'unique:appointment_levels,name,' . $appointmentlevel->id],
            "description" => ['string', 'string', 'max:400'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $appointmentlevel->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return redirect()->back()->with(['success' => 'Nivel actualizado correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppointmentLevel $appointmentlevel)
    {
        try {
            $appointmentlevel->delete();
            return redirect()->back()->with(['success' => 'Nivel eliminado correctamente.']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with(['error' => 'El Nivel no puede ser eliminado.']);
        }
    }
}

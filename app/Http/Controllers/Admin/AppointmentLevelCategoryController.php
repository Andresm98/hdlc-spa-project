<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AppointmentLevel;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;

class AppointmentLevelCategoryController extends Controller
{

    public function  __construct()
    {
        $this->middleware('can:create appointment level')->only('create', 'store');
        $this->middleware('can:read appointment level')->only('index', 'show');
        $this->middleware('can:update appointment level')->only('edit', 'update');
        $this->middleware('can:delete appointment level')->only('delete', 'destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $validator = Validator::make(['id' => $id], [
            "id" => ['required', 'exists:appointment_levels,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $appointmentlevels = AppointmentLevel::where('appointment_levelc_id', '=', $id)
            ->where('last_level', '=', 'Y')
            ->where('level', '=', 2)
            ->get();

        return $appointmentlevels;
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
    public function store(Request $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            "id" => ['required', 'exists:appointment_levels,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

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
            'appointment_levelc_id' => $id,
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'level' => 2,
            'last_level' => 'Y'
        ]);
        return redirect()->back()->with(['success' => 'Categories creada correctamente.']);
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

        return redirect()->back()->with(['success' => 'Categoría actualizada correctamente.']);
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

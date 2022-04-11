<?php

namespace App\Http\Controllers\Secretary\Daughter;

use Illuminate\Http\Request;
use App\Models\AppointmentLevel;
use App\Http\Controllers\Controller;

class AppointmentLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status, $id)
    {
        switch ($status) {
            case 1:
                return AppointmentLevel::where('appointment_levelc_id', '=', null)
                    ->where('level', '=', 1)
                    ->where('last_level', '=', 'N')
                    ->get();
            case 2:
                return AppointmentLevel::where('appointment_levelc_id', '=', $id)
                    ->where('level', '=', 2)
                    ->where('last_level', '=', 'Y')
                    ->get();
        }
    }

    public function appointmentLevelData($appointment_level_id)
    {
        $data = collect();

        $data->put('levelCategory',   AppointmentLevel::find($appointment_level_id));


        $data->put(
            'level',
            AppointmentLevel::where('id', '=', $data->get('levelCategory')->appointment_levelc_id)
                ->where('level', '=', 1)
                ->where('last_level', '=', 'N')
                ->get()
                ->first()
        );
        return $data;
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
        //
    }
}

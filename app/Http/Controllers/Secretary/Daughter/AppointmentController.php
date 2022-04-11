<?php

namespace App\Http\Controllers\Secretary\Daughter;

use App\Models\User;
use App\Models\Community;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $validator = Validator::make(['id' => $user_id], [
            'id' => ['required', 'exists:users,id']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'No existen datos']);
        }

        $user = User::find($user_id);
        return $user->profile->appointments()
        ->with('appointment_level')
        ->with('community')
        ->orderBy('date_appointment', 'DESC')
        ->get();
    }

    public function getCommunity($community_id)
    {
        $validator = Validator::make(['id' => $community_id], [
            'id' => ['required', 'exists:communities,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        return Community::find($community_id);
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
    public function store(Request $request, $user_id)
    {
        $validatorData = Validator::make($request->all(), [
            'appointment_level_id' => ['required', 'exists:appointment_levels,id'],
            'community_id.id' => ['required', 'exists:communities,id'],
            'description' => ['required', 'max:2000'],
            'date_appointment' => ['required', 'date_format:Y-m-d H:i:s'],
            // 'date_end_appointment' => ['required', 'date_format:Y-m-d H:i:s'],
        ]);

        $validator = Validator::make([
            'user_id' => $user_id,
        ], [
            'user_id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $user = User::find($user_id);
        $user->profile->appointments()->create([
            'community_id' => $request->community_id["id"],
            'appointment_level_id' => $request->get('appointment_level_id'),
            'description' => $request->get('description'),
            'date_appointment' => $request->get('date_appointment'),
            // 'date_end_appointment' => $request->get('date_end_appointment'),
        ]);

        return redirect()->back()->with([
            'success' => 'Nombramiento guardado correctamente!'
        ]);
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
    public function update(Request $request,  $user_id, $appointment_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
            'appointment_id' => $appointment_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'appointment_id' => ['required', 'exists:appointments,id']
        ]);

        $validatorData = Validator::make(
            $request->all(),
            [
                'appointment_level_id.id' => ['required', 'exists:appointment_levels,id'],
                'community_id.id' => ['required', 'exists:communities,id'],
                'description' => ['required', 'max:2000'],
                'date_appointment' => ['required', 'date_format:Y-m-d H:i:s'],
                // 'date_end_appointment' => ['date_format:Y-m-d H:i:s'],
            ]
        );
        if ($validator->fails() || $validatorData->fails()) {
            return response()->json(['error' => 'No existen los datos']);
        }

        $appointment = Appointment::find($appointment_id);

        $appointment->update([
            'community_id' => $request->community_id["id"],
            'appointment_level_id' => $request->appointment_level_id["id"],
            'description' => $request->get('description'),
            'date_appointment' => $request->get('date_appointment'),
            'date_end_appointment' => $request->get('date_end_appointment'),
        ]);

        return redirect()->back()->with(['success' => 'Nombramiento actualizado correctamente!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $appointment_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
            'appointment_id' => $appointment_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'appointment_id' => ['required', 'exists:appointments,id']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'No existen los datos']);
        }

        $appointment = Appointment::find($appointment_id);
        $appointment->delete();
        return redirect()->back()->with(['success' => 'Nombramiento eliminado correctamente!!']);
    }
}

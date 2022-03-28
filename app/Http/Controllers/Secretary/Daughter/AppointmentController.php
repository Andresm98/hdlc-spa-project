<?php

namespace App\Http\Controllers\Secretary\Daughter;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
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
        return $user->profile->appointments;
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
            'name_appointment' => ['required', 'max:100'],
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
                ->withErrors($validator->errors())
                ->withInput();
        }

        $user = User::find($user_id);
        $user->profile->appointments()->create([
            'name_appointment' => $request->get('name_appointment'),
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
                'name_appointment' => ['required', 'max:100'],
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
            'name_appointment' => $request->get('name_appointment'),
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

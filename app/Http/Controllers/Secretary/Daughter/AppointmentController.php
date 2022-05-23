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
        return  response()->json([
            'listActual' =>   $user->profile->appointments()
                ->with('appointment_level')
                ->with('community')
                ->with('transfer')
                ->where('date_end_appointment', null)
                ->orderBy('date_appointment', 'DESC')
                ->get(),
            'listOld' =>   $user->profile->appointments()
                ->with('appointment_level')
                ->with('community')
                ->with('transfer')
                ->where('date_end_appointment', '!=', null)
                ->orderBy('date_appointment', 'DESC')
                ->get(),
            'listIndividualActual' =>   $user->profile->appointments()
                ->with('appointment_level')
                ->with('community')
                ->with('transfer')
                ->where('date_end_appointment', null)
                ->where('transfer_id', null)
                ->orderBy('date_appointment', 'DESC')
                ->get(),
            'listIndividualOld' =>   $user->profile->appointments()
                ->with('appointment_level')
                ->with('community')
                ->with('transfer')
                ->where('date_end_appointment', '!=', null)
                ->where('transfer_id', null)
                ->orderBy('date_appointment', 'DESC')
                ->get(),
        ]);
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
            // 'appointment_level_id' => ['required', 'exists:appointment_levels,id'],
            'community_id' => ['required', 'exists:communities,id'],
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

        $array = $request->get('appointment_level_id');

        // Get Actual Appointment

        $lastAppointment = $user->profile->appointments()
            ->where("date_end_appointment", null)
            ->get()
            ->last();

        // Set if community_id is equal in the last register

        if ($lastAppointment) {
            if ($request->community_id["id"] == $lastAppointment->community_id) {
                foreach ($array as $data) {
                    $comprobationAppointment =   $user->profile->appointments()
                        ->where('appointment_level_id', $data['id'])
                        ->where('date_end_appointment', null)
                        ->get();

                    if ($comprobationAppointment->count()) {
                        return redirect()->back()->with(['error' => 'El nombramiento ' . $data['name'] . ' no puede ser almacenado, ya existe un registro vigente.']);
                    }

                    $user->profile->appointments()->create([
                        'community_id' => $request->community_id["id"],
                        'appointment_level_id' =>  $data['id'],
                        'description' => $request->get('description'),
                        'date_appointment' => $request->get('date_appointment'),
                        // 'date_end_appointment' => $request->get('date_end_appointment'),
                    ]);
                }
                return redirect()->back()->with([
                    'success' => 'Nombramiento guardado correctamente!'
                ]);
            } else {
                // Set Actual Date in List Active Appointments

                $user->profile->appointments()
                    ->where("date_end_appointment", null)
                    ->update(['date_end_appointment' =>  $request->get('date_appointment')]);

                foreach ($array as $data) {

                    $comprobationAppointment =   $user->profile->appointments()
                        ->where('appointment_level_id',  $data['id'])
                        ->where('date_end_appointment',  null)
                        ->get();

                    if ($comprobationAppointment->count()) {
                        return redirect()->back()->with(['error' => 'El nombramiento ' . $data['name'] . ' no puede ser almacenado, ya existe un registro vigente.']);
                    }

                    $user->profile->appointments()->create([
                        'community_id' => $request->community_id["id"],
                        'appointment_level_id' =>  $data['id'],
                        'description' => $request->get('description'),
                        'date_appointment' => $request->get('date_appointment'),
                        // 'date_end_appointment' => $request->get('date_end_appointment'),
                    ]);
                }

                $user->profile->transfers()
                    ->where("transfer_date_relocated", null)
                    ->update(['transfer_date_relocated' =>  $request->get('date_appointment')]);

                $user->profile->transfers()->create([
                    'transfer_reason' => 'Razón del cambio',
                    'transfer_date_adission' => $request->get('date_appointment'),
                    // 'transfer_date_relocated' => $request->get('transfer_date_relocated'),
                    'transfer_observation' => 'Observaciones del cambio ',
                    'community_id' => $request->community_id["id"],
                    // 'office_id' => $request->office_id["id"],
                ]);

                return redirect()->back()->with([
                    'success' => 'Nombramiento guardado correctamente!'
                ]);
            }
        } else {

            // Set Actual Date in List Active Appointments

            $user->profile->appointments()
                ->where("date_end_appointment", null)
                ->update(['date_end_appointment' =>  $request->get('date_appointment')]);

            foreach ($array as $data) {

                $comprobationAppointment =   $user->profile->appointments()
                    ->where('appointment_level_id',  $data['id'])
                    ->where('date_end_appointment',  null)
                    ->get();

                if ($comprobationAppointment->count()) {
                    return redirect()->back()->with(['error' => 'El nombramiento ' . $data['name'] . ' no puede ser almacenado, ya existe un registro vigente.']);
                }

                $user->profile->appointments()->create([
                    'community_id' => $request->community_id["id"],
                    'appointment_level_id' =>  $data['id'],
                    'description' => $request->get('description'),
                    'date_appointment' => $request->get('date_appointment'),
                    // 'date_end_appointment' => $request->get('date_end_appointment'),
                ]);
            }

            $user->profile->transfers()
                ->where("transfer_date_relocated", null)
                ->update(['transfer_date_relocated' =>  $request->get('date_appointment')]);

            $user->profile->transfers()->create([
                'transfer_reason' => 'Razón del cambio',
                'transfer_date_adission' => $request->get('date_appointment'),
                // 'transfer_date_relocated' => $request->get('transfer_date_relocated'),
                'transfer_observation' => 'Observaciones del cambio ',
                'community_id' => $request->community_id["id"],
                // 'office_id' => $request->office_id["id"],
            ]);

            return redirect()->back()->with([
                'success' => 'Nombramiento guardado correctamente!'
            ]);
        }
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
            ]
        );
        if ($validator->fails() || $validatorData->fails()) {
            return response()->json(['error' => 'No existen los datos']);
        }

        $appointment = Appointment::find($appointment_id);

        $user = User::find($user_id);

        $comprobationAppointment =   $user->profile->appointments()
            ->where('appointment_level_id',  $request->appointment_level_id["id"])
            ->where('date_end_appointment', null)
            ->get()
            ->last();

        if ($comprobationAppointment) {
            if ($comprobationAppointment->id == $appointment->id) {
                $appointment->update([
                    'community_id' => $request->community_id["id"],
                    'appointment_level_id' => $request->appointment_level_id["id"],
                    'description' => $request->get('description'),
                    'date_appointment' => $request->get('date_appointment'),
                    'date_end_appointment' => $request->get('date_end_appointment'),
                ]);
                return redirect()->back()->with(['success' => 'Nombramiento actualizado correctamente!']);
            } else {
                return redirect()->back()->with(['error' => 'El nombramiento no puede ser actualizado, ya existe un registro vigente.']);
            }
        }

        $validatorData = Validator::make(
            $request->all(),
            [
                'appointment_level_id.id' => ['required', 'exists:appointment_levels,id'],
                'community_id.id' => ['required', 'exists:communities,id'],
                'description' => ['required', 'max:2000'],
                'date_appointment' => ['required', 'date_format:Y-m-d H:i:s'],
                'date_end_appointment' => ['required', 'date_format:Y-m-d H:i:s'],
            ]
        );

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

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

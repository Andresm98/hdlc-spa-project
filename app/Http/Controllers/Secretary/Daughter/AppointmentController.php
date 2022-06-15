<?php

namespace App\Http\Controllers\Secretary\Daughter;

use App\Models\User;
use App\Models\Transfer;
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
                ->where('status', 1)
                ->where('transfer_id', '!=', null)
                ->orderBy('date_appointment', 'DESC')
                ->get(),
            'listOld' =>   $user->profile->appointments()
                ->with('appointment_level')
                ->with('community')
                ->with('transfer')
                ->where('status', 0)
                ->where('community_id', '!=', null)
                ->orderBy('date_appointment', 'DESC')
                ->get(),
            'listIndividualActual' =>   $user->profile->appointments()
                ->with('appointment_level')
                ->where('status', 1)
                ->where('transfer_id', null)
                ->where('community_id', null)
                ->orderBy('date_appointment', 'DESC')
                ->get(),
            'listIndividualOld' =>   $user->profile->appointments()
                ->with('appointment_level')
                ->where('status', 0)
                ->where('transfer_id', null)
                ->where('community_id', null)
                ->orderBy('date_appointment', 'DESC')
                ->get(),
            //
            'lastTransfer' => $user->profile->transfers()
                ->where('status', 1)
                ->with('community')
                ->get()
                ->first()

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

        $validator = Validator::make([
            'user_id' => $user_id,
        ], [
            'user_id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $user = User::find($user_id);

        if ($request->community_id != null && $request->transfer != null) {
            if ($request->get('status') == 1) {
                $validatorData = Validator::make($request->all(), [
                    'community_id.id' => ['required', 'exists:communities,id'],
                    'description' => ['required', 'max:2000'],
                    'date_appointment' => ['required', 'date_format:Y-m-d H:i:s'],
                    'transfer.id' => ['required', 'exists:transfers,id'],
                    'status' => ['required', 'digits_between:0,1'],
                ]);
                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors())
                        ->withInput();
                }
                $array = $request->appointment_level_id;

                foreach ($array as $data) {
                    $user->profile->appointments()->create([
                        'community_id' => $request->community_id['id'],
                        'appointment_level_id' =>  $data['id'],
                        'description' => $request->description,
                        'date_appointment' => $request->date_appointment,
                        'transfer_id' => $request->transfer["id"],
                        'status' => $request->get('status')
                    ]);
                }
                return redirect()->back()->with([
                    'success' => 'Nombramientos guardados correctamente!'
                ]);
            } else {
                $validatorData = Validator::make($request->all(), [
                    'community_id.id' => ['required', 'exists:communities,id'],
                    'description' => ['required', 'max:2000'],
                    'date_appointment' => ['required', 'date', 'before:date_end_appointment', 'date_format:Y-m-d H:i:s'],
                    'date_end_appointment' => ['required', 'date', 'after:date_appointment', 'date_format:Y-m-d H:i:s'],
                    'transfer.id' => ['required', 'exists:transfers,id'],
                    'status' => ['required', 'digits_between:0,1'],
                ]);
                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors())
                        ->withInput();
                }
                $array = $request->appointment_level_id;

                foreach ($array as $data) {
                    $user->profile->appointments()->create([
                        'community_id' => $request->community_id['id'],
                        'appointment_level_id' =>  $data['id'],
                        'description' => $request->description,
                        'date_appointment' => $request->date_appointment,
                        'date_end_appointment' => $request->date_end_appointment,
                        'transfer_id' => $request->transfer["id"],
                        'status' => $request->get('status')
                    ]);
                }
                return redirect()->back()->with([
                    'success' => 'Nombramientos guardados correctamente!'
                ]);
            }
        } else {
            if ($request->get('status') == 1) {
                $validatorData = Validator::make($request->all(), [
                    'description' => ['required', 'max:2000'],
                    'date_appointment' => ['required', 'date_format:Y-m-d H:i:s'],
                ]);
                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors())
                        ->withInput();
                }
                $array = $request->appointment_level_id;

                foreach ($array as $data) {
                    $user->profile->appointments()->create([
                        'appointment_level_id' =>  $data['id'],
                        'description' => $request->description,
                        'date_appointment' => $request->date_appointment,
                        'status' => $request->get('status')
                    ]);
                }
                return redirect()->back()->with([
                    'success' => 'Nombramientos individuales guardados correctamente!'
                ]);
            } else {
                $validatorData = Validator::make($request->all(), [
                    'description' => ['required', 'max:2000'],
                    'date_appointment' => ['required', 'date', 'before:date_end_appointment', 'date_format:Y-m-d H:i:s'],
                    'date_end_appointment' => ['required', 'date', 'after:date_appointment', 'date_format:Y-m-d H:i:s'],
                ]);
                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors())
                        ->withInput();
                }
                $array = $request->appointment_level_id;

                foreach ($array as $data) {
                    $user->profile->appointments()->create([
                        'appointment_level_id' =>  $data['id'],
                        'description' => $request->description,
                        'date_appointment' => $request->date_appointment,
                        'date_end_appointment' => $request->date_end_appointment,
                        'status' => $request->get('status')
                    ]);
                }
                return redirect()->back()->with([
                    'success' => 'Nombramientos individuales guardados correctamente!'
                ]);
            }
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

        if ($validator->fails()) {
            return abort(404);
        }

        $user = User::find($user_id);

        $appointment = Appointment::find($appointment_id);

        $transfer = Transfer::find($appointment->transfer_id);

        if ($transfer) {
            if ($transfer->status == 1) {
                $validatorData = Validator::make(
                    $request->all(),
                    [
                        'appointment_level_id.id' => ['required', 'exists:appointment_levels,id'],
                        'community_id.id' => ['required', 'exists:communities,id'],
                        'description' => ['required', 'max:2000'],
                        'date_appointment' => ['required', 'date', 'before:date_end_appointment', 'date_format:Y-m-d H:i:s'],
                        'date_end_appointment' => ['nullable', 'date', 'after:date_appointment', 'date_format:Y-m-d H:i:s'],
                        'status' => ['required', 'digits_between:0,1'],
                    ]
                );

                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors())
                        ->withInput();
                }

                if ($request->get('status') == 1) {
                    $appointment->update([
                        'community_id' => $request->community_id["id"],
                        'appointment_level_id' => $request->appointment_level_id["id"],
                        'description' => $request->get('description'),
                        'date_appointment' => $request->get('date_appointment'),
                        'date_end_appointment' => null,
                        'status' => $request->get('status')
                    ]);
                } else {
                    $appointment->update([
                        'community_id' => $request->community_id["id"],
                        'appointment_level_id' => $request->appointment_level_id["id"],
                        'description' => $request->get('description'),
                        'date_appointment' => $request->get('date_appointment'),
                        'date_end_appointment' => $request->get('date_end_appointment'),
                        'status' => $request->get('status')
                    ]);
                }

                return redirect()->back()->with(['success' => 'Nombramiento del cambio actualizado correctamente!']);
            } else {
                $validatorData = Validator::make(
                    $request->all(),
                    [
                        'appointment_level_id.id' => ['required', 'exists:appointment_levels,id'],
                        'community_id.id' => ['required', 'exists:communities,id'],
                        'description' => ['required', 'max:2000'],
                        'date_appointment' => ['required', 'date', 'before:date_end_appointment', 'date_format:Y-m-d H:i:s'],
                        'date_end_appointment' => ['required', 'date', 'after:date_appointment', 'date_format:Y-m-d H:i:s'],
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
                    'status' => 0
                ]);
                return redirect()->back()->with(['success' => 'Nombramiento antiguo actualizado correctamente!']);
            }
        } else {
            if ($request->get('status') == 0) {
                $validatorData = Validator::make(
                    $request->all(),
                    [
                        'appointment_level_id.id' => ['required', 'exists:appointment_levels,id'],
                        'description' => ['required', 'max:2000'],
                        'date_appointment' => ['required', 'date', 'before:date_end_appointment', 'date_format:Y-m-d H:i:s'],
                        'date_end_appointment' => ['required', 'date', 'after:date_appointment', 'date_format:Y-m-d H:i:s'],
                        'status' => ['required', 'digits_between:0,1'],
                    ]
                );

                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors())
                        ->withInput();
                }

                $appointment->update([
                    'appointment_level_id' => $request->appointment_level_id["id"],
                    'description' => $request->get('description'),
                    'date_appointment' => $request->get('date_appointment'),
                    'date_end_appointment' => $request->get('date_end_appointment'),
                    'status' => $request->get('status')
                ]);
                return redirect()->back()->with(['success' => 'Nombramiento Individual actualizado correctamente!']);
            } else {
                $validatorData = Validator::make(
                    $request->all(),
                    [
                        'appointment_level_id.id' => ['required', 'exists:appointment_levels,id'],
                        'description' => ['required', 'max:2000'],
                        'date_appointment' => ['required', 'date_format:Y-m-d H:i:s'],
                        'status' => ['required', 'digits_between:0,1'],
                    ]
                );

                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors())
                        ->withInput();
                }

                $appointment->update([
                    'appointment_level_id' => $request->appointment_level_id["id"],
                    'description' => $request->get('description'),
                    'date_appointment' => $request->get('date_appointment'),
                    'date_end_appointment' => null,
                    'status' => $request->get('status')
                ]);
                return redirect()->back()->with(['success' => 'Nombramiento Individual actualizado correctamente!']);
            }
        }
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

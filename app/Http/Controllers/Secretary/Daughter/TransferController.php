<?php

namespace App\Http\Controllers\Secretary\Daughter;

use App\Models\User;
use App\Models\Transfer;
use App\Models\Community;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
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
            return abort(404);
        }
        $user = User::find($user_id);
        return $user->profile->transfers()
            ->with('office')
            ->with('community')
            ->orderBy('transfer_date_adission', 'DESC')
            ->get();
    }

    public function allCommunities()
    {
        $communities_list = Community::where('comm_id', '=', null)
            ->where('comm_level', '=', 1)
            ->orWhere('comm_level', '=', 2)
            ->orderBy('comm_name', 'asc')
            ->get();
        return $communities_list;
    }

    public function allAppointments($transfer_id)
    {
        $appointments_list = Appointment::where('transfer_id',  $transfer_id)
            ->with('appointment_level')
            ->with('community')
            ->orderBy('appointment_level_id', 'asc')
            ->get();
        return $appointments_list;
    }

    public function transferData($transfer_id)
    {

        $transfer =  Transfer::with('community')
            ->with('office')
            ->where('id', '=', $transfer_id)
            ->get()
            ->first();

        return $transfer;
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

        // Get Actual Transfer

        $lastTransfer = $user->profile->transfers()
            ->where("transfer_date_relocated", null)
            ->get()
            ->last();

        if ($lastTransfer) {
            if ($request->transfer['transfer_date_relocated'] != null || $request->appointment['date_end_appointment'] != null) {
                $validatorData = Validator::make($request->all(), [
                    'transfer.transfer_reason' => ['required', 'max:100'],
                    'transfer.transfer_date_adission' => ['required', 'date', 'before:transfer.transfer_date_relocated', 'date_format:Y-m-d H:i:s'],
                    'transfer.transfer_date_relocated' => ['required', 'date', 'after:transfers.transfer_date_adission', 'date_format:Y-m-d H:i:s'],
                    'transfer.transfer_observation' => ['required', 'max:4000'],
                    'transfer.community_id' => ['required', 'exists:communities,id'],
                    //
                    'appointment.community_id' => ['required', 'exists:communities,id'],
                    'appointment.description' => ['required', 'max:2000'],
                    'appointment.date_appointment' => ['required', 'date', 'before:appointment.date_end_appointment', 'date_format:Y-m-d H:i:s'],
                    'appointment.date_end_appointment' => ['required', 'date', 'after:appointment.date_appointment', 'date_format:Y-m-d H:i:s'],
                ]);

                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors())
                        ->withInput();
                }
                $transfer =  $user->profile->transfers()->create([
                    'transfer_reason' => $request->transfer['transfer_reason'],
                    'transfer_date_adission' => $request->transfer['transfer_date_adission'],
                    'transfer_date_relocated' => $request->transfer['transfer_date_relocated'],
                    'transfer_observation' => $request->transfer['transfer_observation'],
                    'community_id' => $request->transfer['community_id'],
                ]);

                $array = $request->appointment['appointment_level_id'];

                foreach ($array as $data) {
                    $user->profile->appointments()->create([
                        'community_id' => $request->appointment['community_id'],
                        'appointment_level_id' =>  $data['id'],
                        'description' => $request->appointment['description'],
                        'date_appointment' => $request->appointment['date_appointment'],
                        'date_end_appointment' => $request->appointment['date_end_appointment'],
                        'transfer_id' => $transfer->id,
                    ]);
                }
                return redirect()->back()->with([
                    'success' => 'Transferencia guardada correctamente!'
                ]);
            } else {
                // Validate Data
                $validatorData = Validator::make($request->all(), [
                    'transfer.transfer_reason' => ['required', 'max:100'],
                    'transfer.transfer_date_adission' => ['required', 'date', 'date_format:Y-m-d H:i:s'],
                    'transfer.transfer_observation' => ['required', 'max:4000'],
                    'transfer.community_id' => ['required', 'exists:communities,id'],
                    //
                    'appointment.community_id' => ['required', 'exists:communities,id'],
                    'appointment.description' => ['required', 'max:2000'],
                    'appointment.date_appointment' => ['required', 'date', 'date_format:Y-m-d H:i:s'],
                ]);

                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors())
                        ->withInput();
                }

                // Update Old Transfer and Appointments
                $lastTransfer->update([
                    'transfer_date_relocated' => $request->transfer['transfer_date_adission']
                ]);

                $user->profile->appointments()
                    ->where('transfer_id', $lastTransfer->id)
                    ->update(['date_end_appointment' =>  $request->appointment['date_appointment']]);

                // Store Data
                $transfer =  $user->profile->transfers()->create([
                    'transfer_reason' => $request->transfer['transfer_reason'],
                    'transfer_date_adission' => $request->transfer['transfer_date_adission'],
                    'transfer_date_relocated' => $request->transfer['transfer_date_relocated'],
                    'transfer_observation' => $request->transfer['transfer_observation'],
                    'community_id' => $request->transfer['community_id'],
                ]);

                $array = $request->appointment['appointment_level_id'];

                foreach ($array as $data) {
                    $user->profile->appointments()->create([
                        'community_id' => $request->appointment['community_id'],
                        'appointment_level_id' =>  $data['id'],
                        'description' => $request->appointment['description'],
                        'date_appointment' => $request->appointment['date_appointment'],
                        'date_end_appointment' => $request->appointment['date_end_appointment'],
                        'transfer_id' => $transfer->id,
                    ]);
                }
                return redirect()->back()->with([
                    'success' => 'Transferencia guardada correctamente!'
                ]);
            }
        } else {
            if ($request->transfer['transfer_date_relocated'] != null || $request->appointment['date_end_appointment'] != null) {
                $validatorData = Validator::make($request->all(), [
                    'transfer.transfer_reason' => ['required', 'max:100'],
                    'transfer.transfer_date_adission' => ['required', 'date', 'before:transfer.transfer_date_relocated', 'date_format:Y-m-d H:i:s'],
                    'transfer.transfer_date_relocated' => ['required', 'date', 'after:transfers.transfer_date_adission', 'date_format:Y-m-d H:i:s'],
                    'transfer.transfer_observation' => ['required', 'max:4000'],
                    'transfer.community_id' => ['required', 'exists:communities,id'],
                    //
                    'appointment.community_id' => ['required', 'exists:communities,id'],
                    'appointment.description' => ['required', 'max:2000'],
                    'appointment.date_appointment' => ['required', 'date', 'before:appointment.date_end_appointment', 'date_format:Y-m-d H:i:s'],
                    'appointment.date_end_appointment' => ['required', 'date', 'after:appointment.date_appointment', 'date_format:Y-m-d H:i:s'],
                ]);

                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors())
                        ->withInput();
                }
                $transfer =  $user->profile->transfers()->create([
                    'transfer_reason' => $request->transfer['transfer_reason'],
                    'transfer_date_adission' => $request->transfer['transfer_date_adission'],
                    'transfer_date_relocated' => $request->transfer['transfer_date_relocated'],
                    'transfer_observation' => $request->transfer['transfer_observation'],
                    'community_id' => $request->transfer['community_id'],
                ]);

                $array = $request->appointment['appointment_level_id'];

                foreach ($array as $data) {
                    $user->profile->appointments()->create([
                        'community_id' => $request->appointment['community_id'],
                        'appointment_level_id' =>  $data['id'],
                        'description' => $request->appointment['description'],
                        'date_appointment' => $request->appointment['date_appointment'],
                        'date_end_appointment' => $request->appointment['date_end_appointment'],
                        'transfer_id' => $transfer->id,
                    ]);
                }
                return redirect()->back()->with([
                    'success' => 'Transferencia guardada correctamente!'
                ]);
            } else {
                $validatorData = Validator::make($request->all(), [
                    'transfer.transfer_reason' => ['required', 'max:100'],
                    'transfer.transfer_date_adission' => ['required', 'date',  'date_format:Y-m-d H:i:s'],
                    'transfer.transfer_observation' => ['required', 'max:4000'],
                    'transfer.community_id' => ['required', 'exists:communities,id'],
                    //
                    'appointment.community_id' => ['required', 'exists:communities,id'],
                    'appointment.description' => ['required', 'max:2000'],
                    'appointment.date_appointment' => ['required', 'date', 'date_format:Y-m-d H:i:s'],
                ]);

                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors())
                        ->withInput();
                }
                $transfer =  $user->profile->transfers()->create([
                    'transfer_reason' => $request->transfer['transfer_reason'],
                    'transfer_date_adission' => $request->transfer['transfer_date_adission'],
                    'transfer_observation' => $request->transfer['transfer_observation'],
                    'community_id' => $request->transfer['community_id'],
                ]);

                $array = $request->appointment['appointment_level_id'];

                foreach ($array as $data) {
                    $user->profile->appointments()->create([
                        'community_id' => $request->appointment['community_id'],
                        'appointment_level_id' =>  $data['id'],
                        'description' => $request->appointment['description'],
                        'date_appointment' => $request->appointment['date_appointment'],
                        'transfer_id' => $transfer->id,
                    ]);
                }
                return redirect()->back()->with([
                    'success' => 'Transferencia guardada correctamente!'
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
    public function update(Request $request, $user_id, $transfer_id)
    {

        $validator = Validator::make([
            'user_id' => $user_id,
            'transfer_id' => $transfer_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'transfer_id' => ['required', 'exists:transfers,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }


        $user = User::find($user_id);

        $transfer = Transfer::find($transfer_id);

        // Get Actual Transfer

        $lastTransfer = $user->profile->transfers()
            ->where("transfer_date_relocated", null)
            ->get()
            ->last();

        if ($lastTransfer) {
            if ($transfer_id == $lastTransfer->id) {

                $validatorData = Validator::make($request->all(), [
                    'transfer_reason' => ['required', 'max:100'],
                    'transfer_date_adission' => ['required', 'date', 'before:transfer_date_relocated', 'date_format:Y-m-d H:i:s'],
                    'transfer_date_relocated' => ['nullable', 'date', 'after:transfer_date_adission', 'date_format:Y-m-d H:i:s'],
                    'transfer_observation' => ['required', 'max:4000'],
                    'community_id.id' => ['required', 'exists:communities,id'],
                ]);

                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors())
                        ->withInput();
                }

                $transfer->update([
                    'transfer_reason' => $request->get('transfer_reason'),
                    'transfer_date_adission' => $request->get('transfer_date_adission'),
                    'transfer_date_relocated' => $request->get('transfer_date_relocated'),
                    'transfer_observation' => $request->get('transfer_observation'),
                    'community_id' => $request->community_id["id"],
                ]);

                $transfer->appointments()
                    ->where('transfer_id', $transfer->id)
                    ->update([
                        'community_id' => $request->community_id["id"],
                        'date_appointment' => $request->get('transfer_date_adission'),
                        'date_end_appointment' => $request->get('transfer_date_relocated'),
                    ]);

                return redirect()->back()->with(['success' => 'Cambio actualizado correctamente']);
            }
        }

        $validatorData = Validator::make($request->all(), [
            'transfer_reason' => ['required', 'max:100'],
            'transfer_date_adission' => ['required', 'date', 'before:transfer_date_relocated', 'date_format:Y-m-d H:i:s'],
            'transfer_date_relocated' => ['required', 'date', 'after:transfer_date_adission', 'date_format:Y-m-d H:i:s'],
            'transfer_observation' => ['required', 'max:4000'],
            'community_id.id' => ['required', 'exists:communities,id'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $transfer->update([
            'transfer_reason' => $request->get('transfer_reason'),
            'transfer_date_adission' => $request->get('transfer_date_adission'),
            'transfer_date_relocated' => $request->get('transfer_date_relocated'),
            'transfer_observation' => $request->get('transfer_observation'),
            'community_id' => $request->community_id["id"],
        ]);

        $transfer->appointments()
            ->where('transfer_id', $transfer->id)
            ->update([
                'community_id' => $request->community_id["id"],
                'date_appointment' => $request->get('transfer_date_adission'),
                'date_end_appointment' => $request->get('transfer_date_relocated'),
            ]);

        return redirect()->back()->with(['success' => 'Historial de cambio actualizada correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $transfer_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
            'transfer_id' => $transfer_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'transfer_id' => ['required', 'exists:transfers,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $user = User::find($user_id);

        $transfer = Transfer::find($transfer_id);


        $transfer->delete();

        // $lastTransfer = $user->profile->transfers()
        //     ->orderBy('transfer_date_adission', 'DESC')
        //     ->get()
        //     ->first();


        // if ($lastTransfer) {
        //     $lastTransfer->update([
        //         'transfer_date_relocated' => null,
        //     ]);
        // }
        return redirect()->back()->with(['success' => 'Transferencia eliminada correctamente']);
    }
}

<?php

namespace App\Http\Controllers\Secretary\Daughter;

use App\Models\User;
use App\Models\Transfer;
use App\Models\Community;
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

        $validatorData = Validator::make($request->all(), [
            'transfer_reason' => ['required', 'max:100'],
            'transfer_date_adission' => ['required', 'date_format:Y-m-d H:i:s'],
            // 'transfer_date_relocated' => ['required', 'date_format:Y-m-d H:i:s'],
            'transfer_observation' => ['required', 'max:4000'],
            'community_id.id' => ['required', 'exists:communities,id'],
            'office_id.id' => ['required', 'exists:offices,id']
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

        // Return the last transfer
        $lastTransfer =  $user->profile->transfers()
            ->orderBy('transfer_date_adission', 'ASC')
            ->get()
            ->last();
        if ($lastTransfer) {
            $lastTransfer->update([
                'transfer_date_relocated' => $request->get('transfer_date_adission'),
            ]);
        }

        $user->profile->transfers()->create([
            'transfer_reason' => $request->get('transfer_reason'),
            'transfer_date_adission' => $request->get('transfer_date_adission'),
            // 'transfer_date_relocated' => $request->get('transfer_date_relocated'),
            'transfer_observation' => $request->get('transfer_observation'),
            'community_id' => $request->community_id["id"],
            'office_id' => $request->office_id["id"],
        ]);

        return redirect()->back()->with([
            'success' => 'Transferencia guardada correctamente!'
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
    public function update(Request $request, $user_id, $transfer_id)
    {

        $validator = Validator::make([
            'user_id' => $user_id,
            'transfer_id' => $transfer_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'transfer_id' => ['required', 'exists:transfers,id']
        ]);

        $validatorData = Validator::make(
            $request->all(),
            [
                'transfer_reason' => ['required', 'max:100'],
                'transfer_date_adission' => ['required', 'date_format:Y-m-d H:i:s'],
                // 'transfer_date_relocated' => ['required', 'date_format:Y-m-d H:i:s'],
                'transfer_observation' => ['required', 'max:4000'],
                'community_id.id' => ['required', 'exists:communities,id'],
                'office_id.id' => ['required', 'exists:offices,id']
            ]
        );

        if ($validator->fails()) {
            return abort(404);
        }

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $transfer = Transfer::find($transfer_id);

        $transfer->update([
            'transfer_reason' => $request->get('transfer_reason'),
            'transfer_date_adission' => $request->get('transfer_date_adission'),
            // 'transfer_date_relocated' => $request->get('transfer_date_relocated'),
            'transfer_observation' => $request->get('transfer_observation'),
            'community_id' => $request->community_id["id"],
            'office_id' => $request->office_id["id"],
        ]);

        return redirect()->back()->with(['success' => 'Transferencia actualizada correctamente']);
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

        if ($transfer) {
            if ($transfer->transfer_date_relocated) {
                return redirect()->back()->with(['error' => 'Transferencia no puede ser eliminada, forma parte del historial!']);
            }
        }

        $transfer->delete();

        $lastTransfer = $user->profile->transfers()
            ->orderBy('transfer_date_adission', 'DESC')
            ->get()
            ->first();
        if ($lastTransfer) {
            $lastTransfer->update([
                'transfer_date_relocated' => null,
            ]);
        }
        return redirect()->back()->with(['success' => 'Transferencia eliminada correctamente']);
    }
}

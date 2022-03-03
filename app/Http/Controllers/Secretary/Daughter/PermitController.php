<?php

namespace App\Http\Controllers\Secretary\Daughter;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permit;
use Illuminate\Support\Facades\Validator;

class PermitController extends Controller
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
        return $user->profile->permits;
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
        $validator = Validator::make($request->all(), [
            'reason' => ['required', 'max:100'],
            'description' => ['required', 'max:2000'],
            'date_province' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_general' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_out' => ['required', 'date_format:Y-m-d H:i:s'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }
        $user = User::find($user_id);
        $user->profile->permits()->create([
            'reason' => $request->get('reason'),
            'description' => $request->get('description'),
            'date_province' => $request->get('date_province'),
            'date_general' => $request->get('date_general'),
            'date_out' => $request->get('date_out'),
        ]);

        return redirect()->back()->with([
            'success' => 'Permiso guardado correctamente!'
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
    public function update(Request $request, $user_id, $permit_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
            'permit_id' => $permit_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'permit_id' => ['required', 'exists:permits,id']
        ]);

        $validatorData = Validator::make(
            $request->all(),
            [
                'reason' => ['required', 'max:100'],
                'description' => ['required', 'max:2000'],
                'date_province' => ['required', 'date_format:Y-m-d H:i:s'],
                'date_general' => ['required', 'date_format:Y-m-d H:i:s'],
                'date_out' => ['required', 'date_format:Y-m-d H:i:s'],
            ]
        );
        if ($validator->fails() || $validatorData->fails()) {
            return response()->json(['error' => 'No existen los datos']);
        }

        $sacrament = Permit::find($permit_id);

        $sacrament->update([
            'reason' => $request->get('reason'),
            'description' => $request->get('description'),
            'date_province' => $request->get('date_province'),
            'date_general' => $request->get('date_general'),
            'date_out' => $request->get('date_out'),
            'date_in' => $request->get('date_in'),
        ]);

        return redirect()->back()->with(['success' => 'Permiso actualizado correctamente!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $permit_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
            'permit_id' => $permit_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'permit_id' => ['required', 'exists:permits,id']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'No existen los datos']);
        }

        $sacrament = Permit::find($permit_id);
        $sacrament->delete();
        return redirect()->back()->with(['success' => 'Permiso eliminado correctamente']);
    }
}

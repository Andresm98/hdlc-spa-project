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
        return Permit::with('address')
            ->where('profile_id', '=', $user->profile->id)
            ->orderBy('date_province', 'DESC')
            ->get();
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
            'reason' => ['required', 'max:100'],
            'address' => ['required', 'max:100'],
            'description' => ['required', 'max:2000'],
            'date_province' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_general' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_out' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_in' => ['required', 'date_format:Y-m-d H:i:s'],
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
        // Get permissions active

        if (count($user->profile->permits->where('status', 1)) > 0) {
            return redirect()->back()->with(['error' => 'Error, existe un permiso vigente!']);
        }

        $permit = $user->profile->permits()->create([
            'reason' => $request->get('reason'),
            'description' => $request->get('description'),
            'date_province' => $request->get('date_province'),
            'date_general' => $request->get('date_general'),
            'date_out' => $request->get('date_out'),
            'date_in' => $request->get('date_in'),
            'status' => 1,
        ]);

        $permit->address()->create([
            'address' => $request->get('address'),
            'political_division_id' => $request->get('political_division_id'),
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

        if ($validator->fails()) {
            return abort(404);
        }


        $user = User::find($user_id);
        $permit = Permit::find($permit_id);

        // Get permissions active
        $countPermissions = count($user->profile->permits->where('status', 1)->where('id', '!=', $permit->id));
        if ($request->get('status') == 1 &&  $countPermissions > 0) {
            return redirect()->back()->with(['error' => 'Error, existe un permiso vigente!']);
        }

        $validatorData = Validator::make(
            $request->all(),
            [
                'reason' => ['required', 'max:100'],
                'description' => ['required', 'max:2000'],
                'address' => ['required', 'max:100'],
                'date_province' => ['required', 'date_format:Y-m-d H:i:s'],
                'date_general' => ['required', 'date_format:Y-m-d H:i:s'],
                'date_out' => ['required', 'date_format:Y-m-d H:i:s'],
                'date_in' => ['required', 'date_format:Y-m-d H:i:s'],
                'status' => ['required', 'digits_between:0,1'],
            ]
        );
        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $permit->update([
            'reason' => $request->get('reason'),
            'description' => $request->get('description'),
            'date_province' => $request->get('date_province'),
            'date_general' => $request->get('date_general'),
            'date_out' => $request->get('date_out'),
            'date_in' => $request->get('date_in'),
            'status' => $request->get('status'),
        ]);

        $permit->address()->update([
            'address' => $request->get('address'),
            'political_division_id' => $request->get('political_division_id'),
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
            return abort(404);
        }

        $permit = Permit::find($permit_id);
        $permit->address()->delete();
        $permit->delete();
        return redirect()->back()->with(['success' => 'Permiso eliminado correctamente']);
    }
}

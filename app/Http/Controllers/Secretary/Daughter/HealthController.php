<?php

namespace App\Http\Controllers\Secretary\Daughter;

use App\Models\Health;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class HealthController extends Controller
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
            return response()->json(['error' => 'No existen datos.']);
        }

        $user = User::find($user_id);
        return $user->profile->healths;
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
            'actual_health' => ['required', 'max:4000'],
            'chronic_diseases' => ['required', 'max:4000'],
            'other_health_problems' => ['required', 'max:4000'],
            'consult_date' => ['required', 'date_format:Y-m-d H:i:s'],
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
        $user->profile->healths()->create([
            'actual_health' => $request->get('actual_health'),
            'chronic_diseases' => $request->get('chronic_diseases'),
            'other_health_problems' => $request->get('other_health_problems'),
            'consult_date' => $request->get('consult_date'),
        ]);

        return redirect()->back()->with([
            'success' => 'Estado de salud guardado correctamente!'
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
    public function update(Request $request, $user_id, $health_id)
    {

        $validator = Validator::make([
            'user_id' => $user_id,
            'health_id' => $health_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'health_id' => ['required', 'exists:healths,id']
        ]);

        $validatorData = Validator::make(
            $request->all(),
            [
                'actual_health' => ['required', 'max:4000'],
                'chronic_diseases' => ['required', 'max:4000'],
                'other_health_problems' => ['required', 'max:4000'],
                'consult_date' => ['required', 'date_format:Y-m-d H:i:s'],
            ]
        );

        if ($validator->fails()) {
            return abort(404);
        }

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $health = Health::find($health_id);

        $health->update([
            'actual_health' => $request->get('actual_health'),
            'chronic_diseases' => $request->get('chronic_diseases'),
            'other_health_problems' => $request->get('other_health_problems'),
            'consult_date' => $request->get('consult_date'),
        ]);

        return redirect()->back()->with(['success' => 'Estado de salud actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $health_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
            'health_id' => $health_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'health_id' => ['required', 'exists:healths,id']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'No existen los datos']);
        }

        $health = Health::find($health_id);
        $health->delete();
        return redirect()->back()->with(['success' => 'Estado de salud eliminado correctamente']);
    }
}

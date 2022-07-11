<?php

namespace App\Http\Controllers\Secretary\Daughter;

use App\Models\User;
use App\Models\Sacrament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SacramentController extends Controller
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
        return $user->profile->sacraments()
        ->orderBy('sacrament_date','DESC')
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

    public function sacramentName($sacrament_name)
    {
        switch ($sacrament_name) {
            case "Bautismo":
                return 0;
                break;
            case "Penitencia":
                return 1;
                break;
            case "Eucaristia":
                return 2;
                break;
            case "Confirmación":
                return 3;
                break;
            case "Orden Sacerdotal":
                return 4;
                break;
            case "Matrimonio":
                return 5;
                break;
            case "Unión de Enfermos":
                return 6;
                break;
        }
    }

    public function store(Request $request, $user_id)
    {

        $validatorData = Validator::make($request->all(), [
            'sacrament_name' => ['required', 'max:100'],
            'sacrament_date' => ['required', 'date_format:Y-m-d H:i:s'],
            'observation' => ['required', 'max:4000'],
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
        $user->profile->sacraments()->create([
            'sacrament_name' => $request->get('sacrament_name'),
            'sacrament_date' => $request->get('sacrament_date'),
            'observation' => $request->get('observation'),
        ]);

        return redirect()->back()->with([
            'success' => 'Sacramento guardado correctamente!'
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
    public function update(Request $request, $user_id, $sacrament_id)
    {

        $validator = Validator::make([
            'user_id' => $user_id,
            'sacrament_id' => $sacrament_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'sacrament_id' => ['required', 'exists:sacraments,id']
        ]);

        $validatorData = Validator::make(
            $request->all(),
            [
                'sacrament_name' => ['required', 'max:100'],
                'sacrament_date' => ['required', 'date_format:Y-m-d H:i:s'],
                'observation' => ['required', 'max:4000'],
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

        $sacrament = Sacrament::find($sacrament_id);

        $sacrament->update([
            'sacrament_name' => $request->get('sacrament_name'),
            'sacrament_date' => $request->get('sacrament_date'),
            'observation' => $request->get('observation'),
        ]);

        return redirect()->back()->with(['success' => 'Sacramento actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $sacrament_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
            'sacrament_id' => $sacrament_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'sacrament_id' => ['required', 'exists:sacraments,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $sacrament = Sacrament::find($sacrament_id);
        $sacrament->delete();
        return redirect()->back()->with(['success' => 'Sacramento eliminado correctamente']);
    }
}

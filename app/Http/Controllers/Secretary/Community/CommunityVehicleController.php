<?php

namespace App\Http\Controllers\Secretary\Community;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommunityVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($community_id)
    {
        $validator = Validator::make(['id' => $community_id], [
            'id' => ['required', 'exists:communities,id']
        ]);
        if ($validator->fails()) {
            return abort(404);
        }

        $community = Community::find($community_id);

        return $community->vehicles()
            ->orderBy('year', 'desc')
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
    public function store(Request $request, $community_id)
    {
        $validatorData = Validator::make($request->all(), [
            'brand' => ['required', 'max:100'],
            'type' => ['required', 'max:100'],
            'color' => ['required', 'max:50'],
            'plaque' => ['required', 'max:100'],
            'year' => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
        ]);

        $validator = Validator::make([
            'community_id' => $community_id,
        ], [
            'community_id' => ['required', 'exists:communities,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $community = Community::find($community_id);

        $community->vehicles()->create([
            'brand' => $request->get('brand'),
            'type' => $request->get('type'),
            'color' => $request->get('color'),
            'plaque' => $request->get('plaque'),
            'year' => $request->get('year'),
        ]);

        return redirect()->back()->with([
            'success' => 'Vehículo de la comunidad creado correctamente!',
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
    public function  update(Request $request, $community_id, $vehicle_id)
    {
        $validatorData = Validator::make($request->all(), [
            'brand' => ['required', 'max:100'],
            'type' => ['required', 'max:100'],
            'color' => ['required', 'max:50'],
            'plaque' => ['required', 'max:100'],
            'year' => ['nullable', 'date', 'date_format:Y-m-d H:i:s'],
        ]);

        $validator = Validator::make([
            'community_id' => $community_id,
            'vehicle_id' => $vehicle_id
        ], [
            'community_id' => ['required', 'exists:communities,id'],
            'vehicle_id' => ['required', 'exists:vehicles,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $visit = Vehicle::find($vehicle_id);

        $visit->update([
            'brand' => $request->get('brand'),
            'type' => $request->get('type'),
            'color' => $request->get('color'),
            'plaque' => $request->get('plaque'),
            'year' => $request->get('year'),
        ]);

        return redirect()->back()->with([
            'success' => 'Vehículo de la comunidad actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function  destroy($community_id, $vehicle_id)
    {

        $validator = Validator::make([
            'community_id' => $community_id,
            'vehicle_id' => $vehicle_id
        ], [
            'community_id' => ['required', 'exists:communities,id'],
            'vehicle_id' => ['required', 'exists:vehicles,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $vehicle = Vehicle::find($vehicle_id);

        $vehicle->delete();

        return redirect()->back()->with(['success' => 'Vehículo eliminado correctamente']);
    }
}

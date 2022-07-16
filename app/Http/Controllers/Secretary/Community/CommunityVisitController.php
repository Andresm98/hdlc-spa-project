<?php

namespace App\Http\Controllers\Secretary\Community;

use App\Models\Community;
use Illuminate\Http\Request;
use App\Models\Visit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CommunityVisitController extends Controller
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
        return $community->visits()
        ->orderBy('comm_date_init_visit','desc')
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
            'comm_reason_visit' => ['required', 'max:100'],
            'comm_type_visit' => ['required','digits_between:1,3'],
            'comm_description_visit' => ['required', 'max:4000'],
            'comm_date_init_visit' => ['required', 'date_format:Y-m-d H:i:s'],
            'comm_date_end_visit' => ['required', 'date_format:Y-m-d H:i:s'],
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
        $community->visits()->create([
            'comm_reason_visit' => $request->get('comm_reason_visit'),
            'comm_type_visit' => $request->get('comm_type_visit'),
            'comm_description_visit' => $request->get('comm_description_visit'),
            'comm_date_init_visit' => $request->get('comm_date_init_visit'),
            'comm_date_end_visit' => $request->get('comm_date_end_visit'),
        ]);

        return redirect()->back()->with([
            'success' => 'Visita de la comunidad creado correctamente!',
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
    public function update(Request $request, $community_id, $visit_id)
    {
        $validatorData = Validator::make($request->all(), [
            'comm_reason_visit' => ['required', 'max:100'],
            'comm_type_visit' => ['required','digits_between:1,3'],
            'comm_description_visit' => ['required', 'max:4000'],
            'comm_date_init_visit' => ['required', 'date_format:Y-m-d H:i:s'],
            'comm_date_end_visit' => ['required', 'date_format:Y-m-d H:i:s'],
        ]);

        $validator = Validator::make([
            'community_id' => $community_id,
            'visit_id' => $visit_id
        ], [
            'community_id' => ['required', 'exists:communities,id'],
            'visit_id' => ['required', 'exists:visits,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }
        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $visit = Visit::find($visit_id);
        $visit->update([
            'comm_reason_visit' => $request->get('comm_reason_visit'),
            'comm_type_visit' => $request->get('comm_type_visit'),
            'comm_description_visit' => $request->get('comm_description_visit'),
            'comm_date_init_visit' => $request->get('comm_date_init_visit'),
            'comm_date_end_visit' => $request->get('comm_date_end_visit'),
        ]);

        return redirect()->back()->with([
            'success' => 'Visita de la comunidad actualizada correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($community_id, $visit_id)
    {

        $validator = Validator::make([
            'community_id' => $community_id,
            'visit_id' => $visit_id
        ], [
            'community_id' => ['required', 'exists:communities,id'],
            'visit_id' => ['required', 'exists:visits,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }


        $visit = Visit::find($visit_id);
        $visit->delete();
        return redirect()->back()->with(['success' => 'Visita eliminada correctamente']);
    }
}

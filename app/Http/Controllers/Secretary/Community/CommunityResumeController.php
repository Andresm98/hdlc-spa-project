<?php

namespace App\Http\Controllers\Secretary\Community;

use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommunityResume;
use Illuminate\Support\Facades\Validator;

class CommunityResumeController extends Controller
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
            return "Error no existen datos!";
        }

        $community = Community::find($community_id);
        return $community->resumes;
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
        $validator = Validator::make($request->all(), [
            'comm_name_resume' => ['required', 'max:100'],
            'comm_annexed_resume' => ['required', 'max:400'],
            'comm_observation_resume' => ['required', 'max:4000'],
            'comm_date_resume' => ['required', 'date_format:Y-m-d H:i:s'],
        ]);

        $validatorData = Validator::make([
            'community_id' => $community_id,
        ], [
            'community_id' => ['required', 'exists:communities,id'],
        ]);

        if ($validator->fails() || $validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $community = Community::find($community_id);
        $community->resumes()->create([
            'comm_name_resume' => $request->get('comm_name_resume'),
            'comm_annexed_resume' => $request->get('comm_annexed_resume'),
            'comm_observation_resume' => $request->get('comm_observation_resume'),
            'comm_date_resume' => $request->get('comm_date_resume'),
        ]);

        return redirect()->back()->with([
            'success' => 'Actividad de la comunidad creado correctamente!',
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
    public function update(Request $request, $community_id, $resume_id)
    {
        $validator = Validator::make($request->all(), [
            'comm_name_resume' => ['required', 'max:100'],
            'comm_annexed_resume' => ['required', 'max:400'],
            'comm_observation_resume' => ['required', 'max:4000'],
            'comm_date_resume' => ['required', 'date_format:Y-m-d H:i:s'],
        ]);

        $validatorData = Validator::make([
            'community_id' => $community_id,
            'resume_id' => $resume_id
        ], [
            'community_id' => ['required', 'exists:communities,id'],
            'resume_id' => ['required', 'exists:community_resumes,id']
        ]);

        if ($validator->fails() || $validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $resume = CommunityResume::find($resume_id);
        $resume->update([
            'comm_name_resume' => $request->get('comm_name_resume'),
            'comm_annexed_resume' => $request->get('comm_annexed_resume'),
            'comm_observation_resume' => $request->get('comm_observation_resume'),
            'comm_date_resume' => $request->get('comm_date_resume'),
        ]);

        return redirect()->back()->with([
            'success' => 'Resumen de la comunidad actualizado correctamente!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($community_id, $resume_id)
    {
        $validatorData = Validator::make([
            'community_id' => $community_id,
            'resume_id' => $resume_id
        ], [
            'community_id' => ['required', 'exists:communities,id'],
            'resume_id' => ['required', 'exists:community_resumes,id']
        ]);

        if ($validatorData->fails()) {
            return response()->json(['error' => 'Error no existen los datos!']);
        }

        $resume = CommunityResume::find($resume_id);
        $resume->delete();
        return redirect()->back()->with(['success' => 'Resumen eliminado correctamente!']);
    }
}

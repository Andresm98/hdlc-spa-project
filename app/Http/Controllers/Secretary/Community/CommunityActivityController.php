<?php

namespace App\Http\Controllers\Secretary\Community;

use App\Models\Community;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommunityActivityController extends Controller
{

    /*
    * Prove Verified proveNewVerified
    */

    public static function proveNewVerified()
    {
        $hashedPassword = Auth::user()->getAuthPassword();

        if (Hash::check('secret', $hashedPassword)) {
            return true;
        }

        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($resume_id)
    {
        $validator = Validator::make(['id' => $resume_id], [
            'id' => ['required', 'exists:resumes,id']
        ]);
        if ($validator->fails()) {
            return "error";
        }

        $checking = $this->proveNewVerified();

        if ($checking) {
            return abort(404);
        }

        $community = Community::find($resume_id);

        return $community->activities;
    }

    public function indexActitiesByResume($resume_id)
    {
        $validator = Validator::make(
            ['resume_id' => $resume_id],
            ['resume_id' => ['required', 'exists:resumes,id']]
        );
        if ($validator->fails()) {
            return abort(404);
        }

        $checking = $this->proveNewVerified();

        if ($checking) {
            return abort(404);
        }

        $resume = Resume::find($resume_id);

        return $resume->activities;
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
    public function store(Request $request, $resume_id)
    {
        $validatorData = Validator::make($request->all(), [
            'comm_name_activity' => ['required', 'max:100'],
            // 'comm_description_activity' => ['required', 'max:4000'],
            // 'comm_date_activity' => ['required', 'date_format:Y-m-d H:i:s'],
            'comm_nr_daughters' => 'required|integer|between:1,1000',
            'comm_nr_beneficiaries' => 'required|integer|between:1,5000',
            'comm_nr_collaborators' => 'required|integer|between:1,1000',
        ]);

        $validator = Validator::make([
            'resume_id' => $resume_id,
        ], [
            'resume_id' => ['required', 'exists:resumes,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }
        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $resume = Resume::find($resume_id);

        $resume->activities()->create([
            'comm_name_activity' => $request->get('comm_name_activity'),
            'comm_description_activity' => '',
            'comm_date_activity' => date("y-m-d 00:00:00"),
            'comm_nr_daughters' => $request->get('comm_nr_daughters'),
            'comm_nr_beneficiaries' => $request->get('comm_nr_beneficiaries'),
            'comm_nr_collaborators' => $request->get('comm_nr_collaborators'),
            'community_id' => $request->get('id_comm'),
        ]);

        return redirect()->back()->with([
            'success' => 'Actividad de la comunidad guardada correctamente!',
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
    public function update(Request $request, $resume_id, $activity_id)
    {
        $validatorData = Validator::make($request->all(), [
            'comm_name_activity' => ['required', 'max:100'],
            'comm_nr_daughters' => 'required|integer|between:1,1000',
            'comm_nr_beneficiaries' => 'required|integer|between:1,5000',
            'comm_nr_collaborators' => 'required|integer|between:1,1000',
        ]);

        $validator = Validator::make([
            'resume_id' => $resume_id,
            'activity_id' => $activity_id
        ], [
            'resume_id' => ['required', 'exists:resumes,id'],
            'activity_id' => ['required', 'exists:activities,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }
        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $activity = Activity::find($activity_id);

        $activity->update([
            'comm_name_activity' => $request->get('comm_name_activity'),
            // 'comm_description_activity' => $request->get('comm_description_activity'),
            // 'comm_date_activity' => $request->get('comm_date_activity'),
            'comm_nr_daughters' => $request->get('comm_nr_daughters'),
            'comm_nr_beneficiaries' => $request->get('comm_nr_beneficiaries'),
            'comm_nr_collaborators' => $request->get('comm_nr_collaborators'),
        ]);

        return redirect()->back()->with([
            'success' => 'Actividad de la comunidad actualizada correctamente!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($resume_id, $activity_id)
    {
        $validator = Validator::make([
            'resume_id' => $resume_id,
            'activity_id' => $activity_id
        ], [
            'resume_id' => ['required', 'exists:resumes,id'],
            'activity_id' => ['required', 'exists:activities,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $activity = Activity::find($activity_id);
        $activity->delete();
        return redirect()->back()->with(['success' => 'Permiso eliminado correctamente']);
    }
}

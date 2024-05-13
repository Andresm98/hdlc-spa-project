<?php

namespace App\Http\Controllers\Secretary\Community;

use PDF;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Models\Resume;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Transfer;
use Illuminate\Support\Facades\Validator;

class CommunityResumeController extends Controller
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
    public function index($community_id)
    {
        $validator = Validator::make(['id' => $community_id], [
            'id' => ['required', 'exists:communities,id']
        ]);
        if ($validator->fails()) {
            return "Error no existen datos!";
        }

        $checking = $this->proveNewVerified();

        if ($checking) {
            return abort(404);
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
        $validatorData = Validator::make($request->all(), [
            'comm_name_resume' => ['required', 'max:100'],
            'comm_annexed_resume' => ['required', 'max:400'],
            'comm_observation_resume' => ['required', 'max:4000'],
            'comm_date_resume' => ['required', 'date_format:Y-m-d H:i:s'],
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
        $validatorData = Validator::make($request->all(), [
            'comm_name_resume' => ['required', 'max:100'],
            'comm_annexed_resume' => ['required', 'max:400'],
            'comm_observation_resume' => ['required', 'max:4000'],
            'comm_date_resume' => ['required', 'date_format:Y-m-d H:i:s'],
        ]);

        $validator = Validator::make([
            'community_id' => $community_id,
            'resume_id' => $resume_id
        ], [
            'community_id' => ['required', 'exists:communities,id'],
            'resume_id' => ['required', 'exists:resumes,id']
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
        $validator = Validator::make([
            'community_id' => $community_id,
            'resume_id' => $resume_id
        ], [
            'community_id' => ['required', 'exists:communities,id'],
            'resume_id' => ['required', 'exists:resumes,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $resume = Resume::find($resume_id);

        $resume->delete();

        return redirect()->back()->with(['success' => 'Resumen eliminado correctamente!']);
    }

    public function printResumeOne($resume_id)
    {
        $validator = Validator::make(
            ['resume_id' => $resume_id],
            ['resume_id' => ['required', 'exists:resumes,id']]
        );

        if ($validator->fails()) {
            return abort(404);
        }

        $resume = Resume::find($resume_id);

        $community = Community::find($resume->community_id);

        $firstDay = date('Y-m-d', strtotime('first day of january this year'));

        $lastDay = date('Y-m-d', strtotime('last day of december this year'));

        $activities = Activity::where('community_id', $resume->community_id)
            ->whereBetween('comm_date_activity', [$firstDay, $lastDay])
            ->get();

        $exitTransfers = Transfer::where('community_id', $resume->community_id)
            ->whereBetween('transfer_date_relocated', [$firstDay, $lastDay])
            ->with('profile.actual.community')
            ->with('profile.user')
            ->get();

        $actualTransfers = CommunityDaughterController::indexResponse($resume->community_id);

        $pdf = PDF::loadView('reports.resume.resume', compact('community', 'activities', 'resume', 'exitTransfers', 'actualTransfers'));

        return $pdf->setPaper('a4', 'portrait')->stream('Resumen Anual' . $community->name . '' . date("Y") . '.pdf');
    }

    public function printResumeTwo($resume_id)
    {
        $validator = Validator::make(
            ['resume_id' => $resume_id],
            ['resume_id' => ['required', 'exists:resumes,id']]
        );

        if ($validator->fails()) {
            return abort(404);
        }

        $resume = Resume::find($resume_id);

        $community = Community::find($resume->community_id);

        $actualTransfers = CommunityDaughterController::indexResponse($resume->community_id);

        $pdf = PDF::loadView('reports.resume.resume-two', compact('community', 'actualTransfers'));

        return $pdf->setPaper('a4', 'landscape')->stream('Resumen Anual' . $community->name . '' . date("Y") . '.pdf');
    }
}

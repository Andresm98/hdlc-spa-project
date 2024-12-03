<?php

namespace App\Http\Controllers\Secretary\Community;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Resume;
use App\Models\Staff;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StaffController extends Controller
{

    public $moveIndex = null;

    public function __construct()
    {
        $this->moveIndex;
    }

    public function setMoveIndex($moveIndex)
    {
        $this->moveIndex = $moveIndex;
    }
    public function getMoveIndex()
    {
        return $this->moveIndex;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index($resume_id, $option)
    {
        $validator = Validator::make(['id' => $resume_id], [
            'id' => ['required', 'exists:resumes,id']
        ]);

        if ($validator->fails()) {
            return "error";
        }

        $resume = Resume::find($resume_id);

        $arrayStaff = $resume->staffs;

        $data = array();

        foreach ($arrayStaff as $staffKey) {
            $staff = Staff::find($staffKey->id);

            array_push($data, [
                'id' => $staff->id,
                'lastname' => $staff->transfer->profile->user->lastname,
                'profileid' => $staff->transfer->profile->id,
                'fullnamecomm' => $staff->transfer->profile->user->name,
                'datebirth' => date('d.m.Y', strtotime($staff->transfer->profile->date_birth)),
                'datevocation' => date('d.m.Y', strtotime($staff->transfer->profile->date_vocation)),
                'office' => $staff->office,
                'dateinsert' => date('d.m.Y', strtotime($staff->transfer->transfer_date_adission)),
                'transferdaterelocated' => !empty($staff->transfer->transfer_date_relocated) ? date('d.m.Y', strtotime($staff->transfer->transfer_date_relocated)) : '',
                'community' => $staff->transfer->community->comm_name,
                'retirement' => $staff->retirement,
                'resume_id' => $resume->id,
                'transfer_id' => $staff->transfer->id,
            ]);
        }

        usort($data, function ($a, $b) {
            return strcmp($a['lastname'], $b['lastname']);
        });

        $profileIds = array_column($data, 'profileid');

        $query = Transfer::query();

        $query->whereIn('profile_id', $profileIds)
            ->with('profile.user')
            ->with('community')
            ->with('appointments.appointment_level')
            ->orderBy('transfer_date_adission', 'desc')
            ->where('status',  1)
            ->get();

        $class = new StaffController();

        foreach ($query->get() as $value) {
            foreach ($value->appointments as $valueLTwo) {
                if ((int)$valueLTwo->appointment_level_id === 10) {
                    $class->setMoveIndex($value->id);
                    break;
                }
            }
        }

        $moveProfileId = (int)$class->getMoveIndex();

        foreach ($data as $index => $staff) {
            if ($staff['transfer_id'] == $moveProfileId) {

                $firstElement = array_splice($data, $index, 1);

                array_unshift($data, $firstElement[0]);

                break;
            }
        }

        if ($option === 1 && $option != "") {
            return $data;
        }

        usort($data, function ($a, $b) {
            return strcmp($a['community'], $b['community']);
        });

        $communityCounts = [];

        foreach ($data as $item) {
            $communityName = $item['community'];
            if (!isset($communityCounts[$communityName])) {
                $communityCounts[$communityName] = 0;
            }
            $communityCounts[$communityName]++;
        }

        $groupedData = [];

        foreach ($communityCounts as $community => $count) {
            $groupedData[] = [
                'community' => $community,
                'count' => $count,
                'records' => array_filter($data, function ($item) use ($community) {
                    return $item['community'] == $community;
                })
            ];
        }

        return $groupedData;
    }


    public function refreshList(Request $request)
    {
        $actualTransfers = CommunityDaughterController::indexResponse($request->community_id,  Str::substr($request->comm_date_resume, 0, 4));
        $actualTransferIds = $actualTransfers->pluck('id')->toArray();


        Staff::where('resume_id', $request->id)
            ->whereNotIn('transfer_id', $actualTransferIds)
            ->delete();

        foreach ($actualTransfers as $transfer) {

            $staffRecord = Staff::where('transfer_id', $transfer->id)
                ->where('resume_id', $request->id)
                ->first();

            if (!$staffRecord) {
                Staff::create([
                    'office' => '',
                    'retirement' => '',
                    'transfer_id' => $transfer->id,
                    'resume_id' => $request->id,
                ]);
            }
        }
        return redirect()->back()->with([
            'success' => 'Lista actualizada!',
        ]);
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'office' => ['required', 'max:500'],
            'retirement' =>  ['required', 'max:500'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        Staff::create([
            'office' => $request->get('name'),
            'retirement' => $request->get('description'),
        ]);

        return redirect()->back()->with([
            'success' => 'Actividad de la comunidad guardada correctamente!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'office' => ['nullable', 'string', 'max:500'],
            'retirement' =>  ['nullable', 'string', 'max:500'],
            'id' => ['required', 'exists:staff,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $staff = Staff::find($request->get('id'));

        $staff->update([
            'office' => $request->get('office'),
            'retirement' => $request->get('retirement'),
        ]);

        return redirect()->back()->with([
            'success' => 'Registro actualizado correctamente!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}

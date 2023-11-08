<?php

namespace App\Http\Controllers\Secretary\Community;

use App\Models\User;
use App\Models\Transfer;
use App\Models\Community;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CommunityDaughterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($community_id)
    {
        $validator = Validator::make(['community_id' => $community_id], [
            'community_id' => ['required', 'exists:communities,id']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'No existe la comunidad']);
        }
        $community = Community::find($community_id);

        if ($community->comm_level == 1) {
            $array = Community::where('comm_id', $community_id)
                ->pluck('id')
                ->toArray();
            array_push($array, (int)$community_id);
            $arrayid = DB::table('users')
                ->select('profiles.id')
                //
                ->join('profiles', 'profiles.user_id', '=', 'users.id')
                ->join('transfers', 'transfers.profile_id', '=', 'profiles.id')
                ->join('communities', 'communities.id', '=', 'transfers.community_id')
                ->whereIn('transfers.community_id',  $array)
                ->where('transfers.status', '=', 1)
                ->get();

            $query = Transfer::query();

            return   $query->whereIn('profile_id', $arrayid->pluck('id')->toArray())
                ->with('profile.user')
                ->with('community')
                ->with('appointments.appointment_level')
                ->orderBy('transfer_date_adission', 'desc')
                ->where('status',  1)
                ->get();
        } else if ($community->comm_level == 2 && $community->comm_id = $community_id) {
            $arrayid =  DB::table('users')
                //
                ->select('profiles.id')
                //
                ->join('profiles', 'profiles.user_id', '=', 'users.id')
                ->join('transfers', 'transfers.profile_id', '=', 'profiles.id')
                ->join('communities', 'communities.id', '=', 'transfers.community_id')

                ->where('transfers.community_id', '=', $community_id)
                ->where('transfers.status', '=', 1)
                ->get();

            $query = Transfer::query();

            return   $query->whereIn('profile_id', $arrayid->pluck('id')->toArray())
                ->with('profile.user')
                ->with('community')
                ->with('appointments.appointment_level')
                ->orderBy('transfer_date_adission', 'desc')
                ->where('status',  1)
                ->get();
        }
    }

    public function report($community_id)
    {
        $validator = Validator::make(['community_id' => $community_id], [
            'community_id' => ['required', 'exists:communities,id']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'No existe la comunidad']);
        }
        $community = Community::find($community_id);

        if ($community->comm_status == 1) {
            $arrayid =  DB::table('users')
                //
                ->select('profiles.id')
                //
                ->join('profiles', 'profiles.user_id', '=', 'users.id')
                ->join('transfers', 'transfers.profile_id', '=', 'profiles.id')
                ->join('communities', 'communities.id', '=', 'transfers.community_id')

                ->where('transfers.community_id', '=', $community_id)
                ->where('transfers.status', '=', 1)
                ->get();

            $query = Transfer::query();

            return   $query->whereIn('profile_id', $arrayid->pluck('id')->toArray())
                ->with('profile.user')
                ->with('community')
                ->with('appointments.appointment_level')
                ->orderBy('transfer_date_adission', 'desc')
                ->where('status',  1)
                ->get();
        }
    }

    public static function reportStatic($community_id)
    {
        $validator = Validator::make(['community_id' => $community_id], [
            'community_id' => ['required', 'exists:communities,id']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'No existe la comunidad']);
        }
        $community = Community::find($community_id);

        if ($community->comm_status == 1) {
            $arrayid =  DB::table('users')
                //
                ->select('profiles.id')
                //
                ->join('profiles', 'profiles.user_id', '=', 'users.id')
                ->join('transfers', 'transfers.profile_id', '=', 'profiles.id')
                ->join('communities', 'communities.id', '=', 'transfers.community_id')

                ->where('transfers.community_id', '=', $community_id)
                ->where('transfers.status', '=', 1)
                ->get();

            $query = Transfer::query();

            return   $query->whereIn('profile_id', $arrayid->pluck('id')->toArray())
                ->with('profile.user')
                ->with('community')
                ->with('appointments.appointment_level')
                ->orderBy('transfer_date_adission', 'desc')
                ->where('status',  1)
                ->get();
        }
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
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

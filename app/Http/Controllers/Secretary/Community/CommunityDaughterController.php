<?php

namespace App\Http\Controllers\Secretary\Community;

use App\Models\Transfer;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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



        // return $community->transfers()
        //     ->where('transfer_date_relocated', '=', null)
        //     ->get();


        // return DB::table('profiles')
        //     ->join('transfers', function ($join, $community_id) {
        //         $community =    Community::find(3);
        //         $join->on('profiles.id', '=', 'transfers.profile_id')
        //             ->where('transfers.community_id', '=', $community_id)
        //             ->where('transfers.transfer_date_relocated', '=', null);
        //     })
        //     ->get();


        return DB::table('users')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->join('transfers', 'transfers.profile_id', '=', 'profiles.id')
            ->join('offices', 'offices.id', '=', 'transfers.office_id')
            ->where('transfers.community_id', '=', $community_id)
            ->where('transfers.transfer_date_relocated', '=', null)
            ->get();

        // return DB::table('transfers')
        //     ->when($community_id, function ($query, $community_id) {
        //         $query->where('community_id', '=', $community_id)
        //             ->where('transfers.transfer_date_relocated', '=', null);
        //     })
        //     ->get();
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

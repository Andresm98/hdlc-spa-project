<?php

namespace App\Http\Controllers\Secretary\Community;

use Inertia\Inertia;
use App\Models\Pastoral;
use App\Models\Transfer;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CommunityRealityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SELECT count(*) FROM `communities` WHERE pastoral_id='7'

        // $list = DB::table('communities')
        //     ->select('pastoral_id', DB::raw('count(*) as total'))
        //     ->groupBy('pastoral_id')
        //     ->get();


        $groupCommunities = Community::select("pastoral_id", DB::raw("count(*) as total"))
            ->groupBy('pastoral_id')
            ->where('comm_status', '=', 1)
            ->where('comm_level',  1)
            ->get();

        $groupWorks = Community::select("pastoral_id", DB::raw("count(*) as total"))
            ->groupBy('pastoral_id')
            ->where('comm_status', '=', 1)
            ->where('comm_level', 2)
            ->get();

        $pastorals = Pastoral::select('id', 'name')
            ->orderBy('id', 'asc')
            ->get();

        // SELECT * FROM `transfers` WHERE community_id=
        $transfers = Transfer::select('community_id', DB::raw('count(*) as total'))
            ->with('community')
            ->where('transfer_date_relocated', null)
            ->groupBy('community_id')
            ->get();

        $groupDaughters = array();

        foreach ($pastorals as $pastoral) {
            $count = 0;
            foreach ($transfers as $trans) {
                $data =  $pastoral->id;
                if ($pastoral->id == $trans->community->pastoral_id) {
                    $count += $trans->total;
                }
            }
            array_push($groupDaughters, ['pastoral_id' => $data, 'total' => $count]);
        }

        $groupDaughters;
        return Inertia::render('Secretary/Communities/Reality', [
            'groupCommunities' => $groupCommunities,
            'groupWorks' => $groupWorks,
            'groupDaughters' => $groupDaughters,
            'pastorals' => $pastorals,
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

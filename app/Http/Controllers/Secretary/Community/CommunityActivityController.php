<?php

namespace App\Http\Controllers\Secretary\Community;

use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CommunityActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($community_id)
    {
        $validator = Validator::make(['id' => $community_id], [
            'id' => ['required', 'exists:community_activities,id']
        ]);
        if ($validator->fails()) {
            return "error";
        }
        $community = Community::find($community_id);
        return $community->activities;
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
            'name_appointment' => ['required', 'max:100'],
            'description' => ['required', 'max:2000'],
            'date_appointment' => ['required', 'date_format:Y-m-d H:i:s'],
            // 'date_end_appointment' => ['required', 'date_format:Y-m-d H:i:s'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }
        $user = Community::find($community_id);
        $user->profile->appointments()->create([
            'name_appointment' => $request->get('name_appointment'),
            'description' => $request->get('description'),
            'date_appointment' => $request->get('date_appointment'),
            // 'date_end_appointment' => $request->get('date_end_appointment'),
        ]);

        return redirect()->back()->with([
            'success' => 'Nombramiento guardado correctamente!'
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

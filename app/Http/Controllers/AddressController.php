<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoliticalDivision;
use App\Models\Profile;
use App\Models\User;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{

    /**
     *  Display Data Political Division
     *
     * @return \Illuminate\Http\Response
     */

    public  function getProvinces()
    {
        return   DB::table('political_divisions')
            ->where('level', '=', '1')
            ->get();
    }

    public  function getCantons($province_id)
    {

        return  DB::table('political_divisions')
            ->where('political_divisionc_id', "=", $province_id)
            ->where('level', '=', '2')
            ->get();
    }

    public  function getParishes($canton_id)
    {
        return  DB::table('political_divisions')
            ->where('political_divisionc_id', "=", $canton_id)
            ->where('level', '=', '3')
            ->get();
    }

    public  function getFinalAddress($canton_id)
    {
        return  DB::table('political_divisions')
            ->select('id')
            ->where('political_divisionc_id', "=", $canton_id)
            ->where('level', '=', '3')
            ->get();
    }

    public function getSaveAddress($actual_parish)
    {

        // Parishes
        $data_parish = DB::table('political_divisions')
            ->where('id', "=", $actual_parish)
            ->where('level', '=', '3')
            ->get()
            ->first();

        $parishes =  DB::table('political_divisions')
            ->where('political_divisionc_id', "=", $data_parish->political_divisionc_id)
            ->where('level', '=', '3')
            ->get();

        // Cantons
        $data_canton = DB::table('political_divisions')
            ->where('id', '=', $data_parish->political_divisionc_id)
            ->where('level', '=', '2')
            ->get()
            ->first();

        $cantons = DB::table('political_divisions')
            ->where('political_divisionc_id', '=', $data_canton->political_divisionc_id)
            ->where('level', '=', '2')
            ->get();

        // Provinces
        $data_province = DB::table('political_divisions')
            ->where('id', '=', $data_canton->political_divisionc_id)
            ->where('level', '=', '1')
            ->get()
            ->first();

        return response()->json([
            'data_parish' => $data_parish,
            'parishes' => $parishes,
            'data_canton' => $data_canton,
            'cantons' => $cantons,
            'data_province' => $data_province
        ]);
    }

    public function getSaveAddressBt($actual_ubication)
    {

        if (!$actual_ubication) {
            return response()->json([
                'data_parish' => null,
                'parishes' => null,
                'data_canton' => null,
                'cantons' => null,
                'data_province' => null
            ]);
        }

        $pivote_ubication = DB::table('political_divisions')
            ->where('id', "=", $actual_ubication)
            ->first();

        if ($pivote_ubication->level === 1) {
            $data_province = DB::table('political_divisions')
                ->where('id', '=', $actual_ubication)
                ->where('level', '=', '1')
                ->get()
                ->first();

            $cantons = DB::table('political_divisions')
                ->where('political_divisionc_id', '=', $data_province->id)
                ->where('level', '=', '2')
                ->get();

            return response()->json([
                'data_parish' => null,
                'parishes' => null,
                'data_canton' => null,
                'cantons' => $cantons,
                'data_province' => $data_province
            ]);
        }

        if ($pivote_ubication->level === 2) {
            // Cantons
            $data_canton = DB::table('political_divisions')
                ->where('id', '=', $actual_ubication)
                ->where('level', '=', '2')
                ->get()
                ->first();

            $cantons = DB::table('political_divisions')
                ->where('political_divisionc_id', '=', $data_canton->political_divisionc_id)
                ->where('level', '=', '2')
                ->get();

            // Provinces

            $data_province = DB::table('political_divisions')
                ->where('id', '=', $data_canton->political_divisionc_id)
                ->where('level', '=', '1')
                ->get()
                ->first();

            // parishes

            $parishes =  DB::table('political_divisions')
                ->where('political_divisionc_id', "=", $data_canton->id)
                ->where('level', '=', '3')
                ->get();


            return response()->json([
                'data_parish' => null,
                'parishes' => $parishes,
                'data_canton' => $data_canton,
                'cantons' => $cantons,
                'data_province' => $data_province
            ]);
        }

        if ($pivote_ubication->level === 3) {
            // Parishes
            $data_parish = DB::table('political_divisions')
                ->where('id', "=", $actual_ubication)
                ->where('level', '=', '3')
                ->get()
                ->first();

            $parishes =  DB::table('political_divisions')
                ->where('political_divisionc_id', "=", $data_parish->political_divisionc_id)
                ->where('level', '=', '3')
                ->get();

            // Cantons
            $data_canton = DB::table('political_divisions')
                ->where('id', '=', $data_parish->political_divisionc_id)
                ->where('level', '=', '2')
                ->get()
                ->first();

            $cantons = DB::table('political_divisions')
                ->where('political_divisionc_id', '=', $data_canton->political_divisionc_id)
                ->where('level', '=', '2')
                ->get();

            // Provinces

            $data_province = DB::table('political_divisions')
                ->where('id', '=', $data_canton->political_divisionc_id)
                ->where('level', '=', '1')
                ->get()
                ->first();

            return response()->json([
                'data_parish' => $data_parish,
                'parishes' => $parishes,
                'data_canton' => $data_canton,
                'cantons' => $cantons,
                'data_province' => $data_province
            ]);
        }
    }

    public function getActualAddress($actual_parish)
    {

        // Parishes
        $data_parish = DB::table('political_divisions')
            ->where('id', "=", $actual_parish)
            ->where('level', '=', '3')
            ->get()
            ->first();

        // Cantons
        $data_canton = DB::table('political_divisions')
            ->where('id', '=', $data_parish->political_divisionc_id)
            ->where('level', '=', '2')
            ->get()
            ->first();

        // Provinces

        $data_province = DB::table('political_divisions')
            ->where('id', '=', $data_canton->political_divisionc_id)
            ->where('level', '=', '1')
            ->get()
            ->first();

        return collect([
            'data_parish' => $data_parish->name,
            'data_canton' => $data_canton->name,
            'data_province' => $data_province->name,
        ]);
    }
    public function showActualAddress($actual_parish)
    {

        // Parishes
        $data_parish = DB::table('political_divisions')
            ->where('id', "=", $actual_parish)
            ->where('level', '=', '3')
            ->get()
            ->first();

        // Cantons
        $data_canton = DB::table('political_divisions')
            ->where('id', '=', $data_parish->political_divisionc_id)
            ->where('level', '=', '2')
            ->get()
            ->first();

        // Provinces

        $data_province = DB::table('political_divisions')
            ->where('id', '=', $data_canton->political_divisionc_id)
            ->where('level', '=', '1')
            ->get()
            ->first();

        return   $data_canton->name . ', PROVINCIA - ' . $data_province->name;
    }

    public  function getMyAddress($profile_id)
    {
        $profile = Profile::find($profile_id);
        return $profile->address;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

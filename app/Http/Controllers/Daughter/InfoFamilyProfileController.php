<?php

namespace App\Http\Controllers\Daughter;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InfoFamilyProfileController extends Controller
{
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
    public function store(Request $request, $id)
    {
        $validator = Validator::make([
            'id' => $id,
        ], [
            'id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $validatorData = Validator::make($request->all(), [
            'names_father' => ['required', 'max:100'],
            'names_mother' => ['required', 'max:100'],
            'nr_sisters' => ['required', 'digits_between:1,20'],
            'nr_brothers' => ['required', 'digits_between:1,20'],
            'place_of_family' => ['required', 'digits_between:1,20'],
            //
            'name_family_member' => ['required', 'max:100'],
            'relation' => ['required', 'max:100'],
            'cellphone' => ['required', 'max:20'],
            'phone' => ['nullable', 'max:20'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $user = User::find($id);

        if (!$user->profile->info_family) {
            $info_family =  $user->profile->info_family()->create([
                'names_father' => $request->get('names_father'),
                'names_mother' => $request->get('names_mother'),
                'nr_sisters' => $request->get('nr_sisters'),
                'nr_brothers' => $request->get('nr_brothers'),
                'place_of_family' => $request->get('place_of_family'),
            ]);
            $info_family->info_family_break()->create([
                'name_family_member' => $request->get('name_family_member'),
                'relation' => $request->get('relation'),
                'cellphone' => $request->get('cellphone'),
                'phone' => $request->get('phone'),
            ]);
            return redirect()->back()->with([
                'success' => 'Información familiar guardada correctamente!'
            ]);
        }
        // If exists
        else {

            $info_family = $user->profile->info_family;
            $info_family->update([
                'names_father' => $request->get('names_father'),
                'names_mother' => $request->get('names_mother'),
                'nr_sisters' => $request->get('nr_sisters'),
                'nr_brothers' => $request->get('nr_brothers'),
                'place_of_family' => $request->get('place_of_family'),
            ]);
            $info_family->info_family_break()->update([
                'name_family_member' => $request->get('name_family_member'),
                'relation' => $request->get('relation'),
                'cellphone' => $request->get('cellphone'),
                'phone' => $request->get('phone'),
            ]);
            return redirect()->back()->with([
                'success' => 'Información familiar actualizada correctamente!'
            ]);
        }
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

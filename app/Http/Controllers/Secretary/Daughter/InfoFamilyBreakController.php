<?php

namespace App\Http\Controllers\Secretary\Daughter;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InfoFamilyBreakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $validator = Validator::make(['id' => $user_id], [
            'id' => ['required', 'exists:users,id']
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'No existen datos.']);
        }
        $user = User::find($user_id);
        return $user->profile->info_family->info_family_break;
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
    public function storeUpdateData(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'name_family_member' => ['required', 'max:100'],
            'relation' => ['required', 'max:100'],
            'cellphone' => ['required', 'max:20'],
            'phone' => ['required', 'max:20'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }
        $user = User::find($user_id);
        // If no exists

        if ($user->profile->info_family) {
            if (!$user->profile->info_family->info_family_break) {
                $user->profile->info_family->info_family_break()->create([
                    'name_family_member' => $request->get('name_family_member'),
                    'relation' => $request->get('relation'),
                    'cellphone' => $request->get('cellphone'),
                    'phone' => $request->get('phone'),
                ]);
                return redirect()->back()->with([
                    'success' => 'Estado de salud guardado correctamente!'
                ]);
            }
            // If exists
            else {
                $user->profile->info_family->info_family_break()->update([
                    'name_family_member' => $request->get('name_family_member'),
                    'relation' => $request->get('relation'),
                    'cellphone' => $request->get('cellphone'),
                    'phone' => $request->get('phone'),
                ]);
                return redirect()->back()->with([
                    'success' => 'Estado de salud actualizado correctamente!'
                ]);
            }
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

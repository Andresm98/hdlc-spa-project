<?php

namespace App\Http\Controllers\Secretary\Daughter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
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

    /*
    *  Get Actual Profile
    */

    public function specificProfile($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'exists:users,id']
        ]);
        if ($validator->fails()) {
            abort(404);
        }
        $profile = Profile::with('address')
            ->where('user_id', '=', $id)
            ->get();

        return   $profile->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find($request->get("user_id"));
        if (!$user->profile) {
            $profile = $user->profile()->create([
                'identity_card' => $request->get("identity_card"),
                'date_birth' => $request->get("date_birth"),
                'date_vocation' => $request->get("date_vocation"),
                'date_admission' => $request->get("date_admission"),
                'cellphone' => $request->get("cellphone"),
                'phone' => $request->get("phone"),
                'observation' => $request->get("observation"),
            ]);

            $profile->address()->create([
                'address' => $request->get("address"),
                'political_division_id' => $request->get("political_division_id")
            ]);

            return back()->with([
                'success' => 'El perfil del usuario fue guardado correctamente.',
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
    public function update(Request $request, $profile_custom_id)
    {
        $user = User::find($profile_custom_id);
        if ($user->profile) {
            $user->profile()->update([
                'identity_card' => $request->get("identity_card"),
                'date_birth' => $request->get("date_birth"),
                'date_vocation' => $request->get("date_vocation"),
                'date_admission' => $request->get("date_admission"),
                'cellphone' => $request->get("cellphone"),
                'phone' => $request->get("phone"),
                'observation' => $request->get("observation"),
            ]);

            $user->profile->address()->update([
                'address' => $request->address["address"],
                'political_division_id' => $request->address["political_division_id"]
            ]);

            return back()->with([
                'success' => 'El perfil del usuario fue actualizado correctamente.',
            ]);
        }
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

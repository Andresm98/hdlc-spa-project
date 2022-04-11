<?php

namespace App\Http\Controllers\Secretary\Daughter;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            // // 'date_birth' => ['required', 'date_format:Y-m-d H:i:s'],
            'user_id' => ['required', 'exists:users,id'],
            'identity_card' => ['required', 'string', 'max:13'],
            'date_birth' => ['required', 'date_format:Y-m-d'],
            // 'date_vocation' => ['required', 'date_format:Y-m-d'],
            // 'date_admission' => ['required', 'date_format:Y-m-d'],
            // 'date_send' => ['required', 'date_format:Y-m-d'],
            // 'date_vote' => ['required', 'date_format:Y-m-d'],
            // 'date_death' => ['date_format:Y-m-d'],
            'cellphone' => ['required', 'string', 'max:15'],
            'phone' => ['required', 'string', 'max:15'],
            'observation' => ['required', 'string', 'max:4000'],
            'address.address' => ['required', 'string', 'max:100'],
            'address.political_division_id' => ['required', 'string', 'exists:political_divisions,id']
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $user = User::find($request->get("user_id"));
        if (!$user->profile) {
            $profile = $user->profile()->create([
                'identity_card' => $request->get("identity_card"),
                'date_birth' => $request->get("date_birth"),
                'date_vocation' => $request->get("date_vocation"),
                'date_admission' => $request->get("date_admission"),
                'date_send' => $request->get('date_send'),
                'date_vote' => $request->get('date_vote'),
                'date_death' => $request->get('date_death'),
                'cellphone' => $request->get("cellphone"),
                'phone' => $request->get("phone"),
                'observation' => $request->get("observation"),
            ]);

            $profile->address()->create([
                'address' => $request->address["address"],
                'political_division_id' => $request->address["political_division_id"]
            ]);

            return  redirect()->route('secretary.daughters.edit', $user->slug)->with([
                'success' => 'El perfil del usuario fue actualizado correctamente.',
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

        $validator = Validator::make(['id' => $profile_custom_id], [
            'id' => ['required', 'exists:users,id']
        ]);

        if($validator->fails()){
            return abort(404);
        }

        $validatorData = Validator::make($request->all(), [
            // // 'date_birth' => ['required', 'date_format:Y-m-d H:i:s'],
            'user_id' => ['required', 'exists:users,id'],
            'identity_card' => ['required', 'string', 'max:13'],
            'date_birth' => ['required', 'date_format:Y-m-d H:i:s'],
            // 'date_vocation' => ['required', 'date_format:Y-m-d H:i:s'],
            // 'date_admission' => ['required', 'date_format:Y-m-d H:i:s'],
            // 'date_send' => ['required', 'date_format:Y-m-d H:i:s'],
            // 'date_vote' => ['required', 'date_format:Y-m-d H:i:s'],
            // 'date_death' => ['date_format:Y-m-d H:i:s'],
            'cellphone' => ['required', 'string', 'max:15'],
            'phone' => ['required', 'string', 'max:15'],
            'observation' => ['required', 'string', 'max:4000'],
            'address.address' => ['required', 'string', 'max:100'],
            'address.political_division_id' => ['required', 'string', 'exists:political_divisions,id'],
        ]);


        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $user = User::find($profile_custom_id);
        if ($user->profile) {
            $user->profile()->update([
                'identity_card' => $request->get("identity_card"),
                'date_birth' => $request->get("date_birth"),
                'date_vocation' => $request->get("date_vocation"),
                'date_admission' => $request->get("date_admission"),
                'date_send' => $request->get('date_send'),
                'date_vote' => $request->get('date_vote'),
                'date_death' => $request->get('date_death'),
                'cellphone' => $request->get("cellphone"),
                'phone' => $request->get("phone"),
                'observation' => $request->get("observation"),
            ]);
            $user->profile->address()->update([
                'address' => $request->address["address"],
                'political_division_id' => $request->address["political_division_id"]
            ]);

            return redirect()->route('secretary.daughters.edit', $user->slug)->with([
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

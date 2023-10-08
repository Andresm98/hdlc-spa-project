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
        $profile = Profile::with('address', 'origin', 'profileBooks.book')
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
            // 'date_birth' => ['required', 'date_format:Y-m-d H:i:s'],
            'user_id' => ['required', 'exists:users,id'],
            'identity_card' => ['required', 'string', 'max:13'],
            'iess_card' => ['nullable', 'string', 'max:30'],
            'driver_license' => ['nullable', 'string', 'max:50'],
            'date_birth' => ['required', 'date_format:Y-m-d'],
            'date_vocation' => ['nullable', 'date_format:Y-m-d'],
            'date_admission' => ['nullable', 'date_format:Y-m-d'],
            'date_send' => ['nullable', 'date_format:Y-m-d'],
            'date_vote' => ['nullable', 'date_format:Y-m-d'],
            'date_death' => ['nullable', 'date_format:Y-m-d'],
            'cellphone' => ['required', 'string', 'max:15'],
            'phone' => ['nullable', 'string', 'max:15'],
            'observation' => ['required', 'string', 'max:4000'],
            'address.address' => ['required', 'string', 'max:100'],
            'address.political_division_id' => ['required', 'string', 'exists:political_divisions,id'],

            'address_bt.address_bt' => ['required', 'string', 'max:100'],
            'address_bt.political_division_id_bt' => ['nullable', 'string', 'exists:political_divisions,id']
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $user = User::find($request->get("user_id"));
        if (!$user->profile) {
            $profile = $user->profile()->create([
                'status' => 1,
                'identity_card' => $request->get("identity_card"),
                'iess_card' => $request->get("iess_card"),
                'driver_license' => $request->get("driver_license"),
                'date_birth' => $request->get("date_birth"),
                'date_vocation' => $request->get("date_vocation"),
                'date_admission' => $request->get("date_vocation"),
                'date_send' => $request->get('date_send'),
                'date_vote' => $request->get('date_vote'),
                'cellphone' => $request->get("cellphone"),
                'phone' => $request->get("phone"),
                'observation' => $request->get("observation"),
            ]);

            $profile->address()->create([
                'address' => $request->address["address"],
                'political_division_id' => $request->address["political_division_id"]
            ]);

            $profile->origin()->create([
                'address' => $request->address_bt["address_bt"],
                'political_division_id' => $request->address_bt["political_division_id_bt"]
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

        if ($validator->fails()) {
            return abort(404);
        }

        $validatorData = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'identity_card' => ['nullable', 'string', 'max:13'],
            'iess_card' => ['nullable', 'string', 'max:30'],
            'driver_license' => ['nullable', 'string', 'max:50'],
            'date_birth' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_vocation' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'date_admission' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'date_send' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'date_vote' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'date_retirement' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'cellphone' => ['nullable', 'string', 'max:15'],
            'phone' => ['nullable', 'string', 'max:15'],
            'page' => ['nullable', 'string', 'max:10'],
            'observation' => ['required', 'string', 'max:4000'],
            'address.address' => ['required', 'string', 'max:100'],
            'address.political_division_id' => ['required', 'string', 'exists:political_divisions,id'],
            'origin.address' => ['required', 'string', 'max:100'],
            'origin.political_division_id' => ['nullable', 'string', 'exists:political_divisions,id']
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
                'iess_card' => $request->get("iess_card"),
                'driver_license' => $request->get("driver_license"),
                'date_birth' => $request->get("date_birth"),
                'date_vocation' => $request->get("date_vocation"),
                'date_admission' => $request->get("date_vocation"),
                'date_send' => $request->get('date_send'),
                'date_vote' => $request->get('date_vote'),
                'date_retirement' => $request->get('date_retirement'),
                'cellphone' => $request->get("cellphone"),
                'phone' => $request->get("phone"),
                'page' => $request->get('page'),
                'observation' => $request->get("observation"),
            ]);
            $user->profile->address()->update([
                'address' => $request->address["address"],
                'political_division_id' => $request->address["political_division_id"]
            ]);

            $user->profile->origin()->update([
                'address' => $request->origin["address"],
                'political_division_id' => $request->origin["political_division_id"]
            ]);

            $user->profile->profileBooks()->delete();

            $profileBooks = (array) $request->get('profile_books');

            foreach ($profileBooks as $proBook) {
                $user->profile->profileBooks()->create([
                    'book_id' => $proBook['id']
                ]);
            }

            return redirect()->route('secretary.daughters.edit', $user->slug)->with([
                'success' => 'El perfil del usuario fue actualizado correctamente.',
            ]);
        }
    }


    public function updateStatus(Request $request, $profile_id)
    {
        $validator = Validator::make([
            'profile_id' => $profile_id,
        ], [
            'profile_id' => ['required', 'exists:profiles,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $profile = Profile::find($profile_id);

        if ($request->get('operation') == 1) {
            $profile->update([
                'status' =>  1,
                'date_death' => null,
                'date_exit' => null
            ]);
        }

        if ($request->get('operation') == 2) {
            $validatorData = Validator::make($request->all(), [
                'dateDeathProfile' => ['required', 'date_format:Y-m-d H:i:s'],
            ]);

            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors())
                    ->withInput();
            }

            $profile->update([
                'status' =>  2,
                'date_death' => $request->get('dateDeathProfile'),
                'date_exit' => null
            ]);

            $transfer = $profile->transfers->where('status', 1)->first();
            if ($transfer) {
                $transfer->update([
                    'transfer_date_relocated' => $request->get('dateDeathProfile'),
                    'status' => 0
                ]);
                $appointments = $transfer->appointments;
                foreach ($appointments as $appointment) {
                    $appointment->update([
                        'date_end_appointment' => $request->get('dateDeathProfile'),
                        'status' => 0
                    ]);
                }
            }

            $permission = $profile->permits->where('status', 1)->first();
            if ($permission) {
                $permission->update([
                    'status' => 0,
                ]);
            }
        }

        if ($request->get('operation') == 3) {
            $validatorData = Validator::make($request->all(), [
                'dateExitProfile' => ['required', 'date_format:Y-m-d H:i:s'],
            ]);

            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors())
                    ->withInput();
            }

            $profile->update([
                'status' =>  3,
                'date_death' => null,
                'date_exit' => $request->get('dateExitProfile')
            ]);

            $transfer = $profile->transfers->where('status', 1)->first();
            if ($transfer) {
                $transfer->update([
                    'transfer_date_relocated' => $request->get('dateExitProfile'),
                    'status' => 0
                ]);
                $appointments = $transfer->appointments;
                foreach ($appointments as $appointment) {
                    $appointment->update([
                        'date_end_appointment' => $request->get('dateExitProfile'),
                        'status' => 0
                    ]);
                }
            }

            $permission = $profile->permits->where('status', 1)->first();
            if ($permission) {
                $permission->update([
                    'status' => 0,
                ]);
            }
        }

        if ($request->get('operation') == 4) {
            $validatorData = Validator::make($request->all(), [
                'dateOtherCountryProfile' => ['required', 'date_format:Y-m-d H:i:s'],
                'place_other_country' => ['nullable', 'string', 'max:30'],
            ]);

            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors())
                    ->withInput();
            }

            $profile->update([
                'status' =>  4,
                'date_death' => null,
                'date_exit' => null,
                'date_other_country' => $request->get('dateOtherCountryProfile'),
                'place_other_country' => $request->get('place_other_country'),
            ]);

            $transfer = $profile->transfers->where('status', 1)->first();

            if ($transfer) {
                $transfer->update([
                    'transfer_date_relocated' => $request->get('dateOtherCountryProfile'),
                    'status' => 0
                ]);
                $appointments = $transfer->appointments;
                foreach ($appointments as $appointment) {
                    $appointment->update([
                        'date_end_appointment' => $request->get('dateOtherCountryProfile'),
                        'status' => 0
                    ]);
                }
            }

            $permission = $profile->permits->where('status', 1)->first();
            if ($permission) {
                $permission->update([
                    'status' => 0,
                ]);
            }
        }

        return  redirect()->route('secretary.daughters.edit', $profile->user->slug)->with([
            'success' => 'El perfil de la hermana fue actualizado correctamente.',
        ]);
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

<?php

namespace App\Http\Controllers\Daughter;

use PDF;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Secretary\Daughter\ProfileController;
use App\Http\Controllers\Secretary\Daughter\TransferController;

class UserProfileController extends Controller
{
    /*
    * Display advance funcs
    */

    public function getAdvanceFunctions()
    {
        $authUser = auth()->user();

        $daughter = User::find($authUser->id);

        $daughter->profile;

        if ($daughter->profile) {

            $transferActive = $daughter->profile->transfers()->where('status', 1)->first();

            if ($transferActive) {

                $appointments = $transferActive->appointments;

                if ($appointments) {

                    $flag = true;

                    foreach ($appointments as $app) {
                        if (
                            $app->appointment_level->id == 4 || $app->appointment_level->id == 7 ||
                            $app->appointment_level->id == 10 || $app->appointment_level->id == 12 ||
                            $app->appointment_level->id == 17 || $app->appointment_level->id == 18
                        ) {
                            $flag = true;
                            break;
                        } else {
                            $flag = false;
                        }
                    }

                    if (!$flag) {
                        return false;
                    }

                    return true;
                }
            }
        }
    }

    /*
    * Prove Verified proveNewVerified
    */

    public static function proveNewVerified()
    {
        $hashedPassword = Auth::user()->getAuthPassword();

        if (Hash::check('secret', $hashedPassword)) {
            return true;
        }

        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = auth()->user();

        $checking = $this->proveNewVerified();

        if ($checking) {
            return abort(404);
        }

        $daughter = User::find($authUser->id);

        if (!$daughter) {
            return abort(404);
        }

        $daughter->profile;

        if ($daughter->profile->status !== 1) {
            return abort(404);
        }

        if ($daughter->profile) {
            $daughter->profile->info_family;
            if ($daughter->profile->info_family) {
                $daughter->profile->info_family->info_family_break;
            }
            $daughter->profile->address;

            if (!$daughter->profile->origin) {
                $daughter->profile->origin()->create([
                    'address' => "",
                    'political_division_id' => null
                ]);
            } else {
                $daughter->profile->origin;
            }
        }

        if ($daughter->image) {
            $image = Storage::disk('s3')->temporaryUrl(
                $daughter->image->filename,
                now()->addMinutes(5)
            );
            return Inertia::render(
                'Daughter/Profile',
                [
                    'daughter' => $daughter,
                    'image' => $image
                ]
            );
        }

        return Inertia::render(
            'Daughter/Profile',
            [
                'daughter' => $daughter,
            ]
        );
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
            'identity_card' => ['required', 'string', 'max:13'],
            'iess_card' => ['nullable', 'string', 'max:30'],
            'driver_license' => ['nullable', 'string', 'max:50'],
            'date_birth' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_vocation' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'date_admission' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'date_send' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'date_vote' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'cellphone' => ['required', 'string', 'max:15'],
            'phone' => ['nullable', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:100'],
            'political_division_id' => ['required', 'string', 'exists:political_divisions,id'],
            'address_bt' => ['required', 'string', 'max:100'],
            'political_division_id_bt' => ['nullable', 'string', 'exists:political_divisions,id']
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $user = User::find($id);
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
                'observation' => null,
                'phone' => $request->get("phone"),
            ]);

            $profile->address()->create([
                'address' => $request->get("address"),
                'political_division_id' => $request->get("political_division_id"),
            ]);

            $profile->origin()->create([
                'address' => $request->get("address_bt"),
                'political_division_id' => $request->get("political_division_id_bt"),
            ]);
        }
        return  redirect()->back()->with([
            'success' => 'El perfil del usuario fue creado correctamente.',
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
        $validator = Validator::make([
            'id' => $id,
        ], [
            'id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $validatorData = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'fullnamecomm' => 'required|string|max:60',
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'roles*' => 'required|exists:roles,id',
            'file' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2024'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $user =  User::find($id);

        foreach ($user->roles as $role) {
            if ($role->name == "daughter") {
                continue;
            } else {
                return abort(404);
            }
        }


        if ($request->file('file')) {
            if (!$user->image) {
                $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->id, 's3');
                Storage::disk('s3')->setVisibility($path, 'private');
                $user->image()->create([
                    'filename' => $path,
                    'url' => Storage::disk('s3')->url($path)
                ]);
            } else {
                Storage::disk('s3')->delete($user->image->filename);
                $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->id, 's3');
                Storage::disk('s3')->setVisibility($path, 'private');
                $user->image()->update([
                    'filename' => $path,
                    'url' => Storage::disk('s3')->url($path)
                ]);
            }
        }
        $user->update(
            [
                'name' => $request->get('name'),
                'fullnamecomm' => $request->get('fullnamecomm'),
                'lastname' => $request->get('lastname'),
                'email' => $request->get('email'),
            ]
        );
        return redirect()->back()->with('success', 'Usuario actualizado correctamente.');
    }

    public function updateProfile(Request $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'exists:users,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $validatorData = Validator::make($request->all(), [
            'identity_card' => ['required', 'string', 'max:13'],
            'iess_card' => ['nullable', 'string', 'max:30'],
            'driver_license' => ['nullable', 'string', 'max:50'],
            'date_birth' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_vocation' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'date_admission' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'date_send' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'date_vote' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'cellphone' => ['required', 'string', 'max:15'],
            'phone' => ['nullable', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:100'],
            'political_division_id' => ['required', 'string', 'exists:political_divisions,id'],
            'address_bt' => ['required', 'string', 'max:100'],
            'political_division_id_bt' => ['nullable', 'string', 'exists:political_divisions,id']
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }
        $user = User::find($id);
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
                'cellphone' => $request->get("cellphone"),
                'phone' => $request->get("phone"),
            ]);
            $user->profile->address()->update([
                'address' =>  $request->get("address"),
                'political_division_id' =>  $request->get("political_division_id"),
            ]);

            $user->profile->origin()->update([
                'address' =>  $request->get("address_bt"),
                'political_division_id' =>  $request->get("political_division_id_bt"),
            ]);

            return redirect()->back()->with('success', 'Perfil de usuario actualizado correctamente.');
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

    function search($value, $array)
    {
        return array_search($value, $array);
    }

    public function reportInfoProfilePDF(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "options"    => ['nullable', 'array', 'min:0', 'max:6'],
            "options.*"    => ['nullable', 'integer', 'distinct', 'between:1,6'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', "Error al validar datos");
        }

        $authUser = auth()->user();

        $user = User::find($authUser->id);
        if (!$user) {
            return abort(404);
        }

        // Import Methods
        $profile_daughter = new ProfileController();
        $addressClass = new AddressController();
        $data =   collect(['status' => true]);

        if ($user->profile) {

            $profile = $user->profile;
            $data->put('profile',  $profile);


            if ($user->image) {
                $image = Storage::disk('s3')->temporaryUrl(
                    $user->image->filename,
                    now()->addMinutes(5)
                );
                $data->put('image', $image);
            }

            if ($user->profile->info_family) {
                if ($user->profile->info_family->info_family_break) {
                    $data->put('info_family',  $user->profile->info_family);
                }
                $data->put('info_family',   $user->profile->info_family);
            }

            $data->put('address',  $addressClass->getActualAddress($data->get('profile')->address->political_division_id));

            //  Aditional Information
            $from = date('Y-01-01 00:00:00');
            $to = date('Y-12-31 00:00:00');
            if ($request->get('options') != null) {
                if (is_numeric($this->search("1", $request->get('options')))) {
                    $data->put('healths', $user->profile->healths()
                        ->orderBy('consult_date', 'desc')->first());
                }
                if (is_numeric($this->search("2", $request->get('options')))) {
                    $data->put('academic_trainings', $user->profile->academic_trainings()
                        ->orderBy('date_title', 'asc')
                        ->get());
                }
                if (is_numeric($this->search("3", $request->get('options')))) {
                    $data->put('sacraments', $user->profile->sacraments()
                        ->orderBy('sacrament_date', 'asc')
                        ->get());
                }
                if (is_numeric($this->search("4", $request->get('options')))) {
                    $data->put('permits', $user->profile->permits()
                        ->with('address')
                        ->get());
                }

                $transfers = $user->profile->transfers()->with('community')->get();
                $data->put(
                    'transfer',
                    $transfers->where('status', 1)->first()
                );


                $transfer = $user->profile->transfers->where('status', 1)->first();
                $controllerTransfers = new TransferController();
                if ($transfer) {
                    $data->put(
                        'appointments',
                        $controllerTransfers->allAppointments($transfer->id)
                    );
                }

                $data->put(
                    'individualappointments',
                    $user->profile->appointments()
                        ->where('transfer_id', null)
                        ->with('appointment_level')
                        ->with('community')
                        ->get()
                );
            }
            //
            // return $data;
            $pdf = PDF::loadView('reports.daughters.profile', compact('data'));
            // return $pdf -> download('Usuarios-OpenScience.pdf');
            return $pdf->setPaper('a4', 'portrait')->stream('Perfil Hermana ' . $user->name . '.pdf');
        } else {
            return redirect()->back()->with('error', 'Por favor ingrese la información de su perfil.');
        }
    }
}

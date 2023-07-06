<?php

namespace App\Http\Controllers\Api\Daughter;

use App\Exports\DaughListExport;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use PDF;
use App\Models\Team;
use App\Models\Address;
use App\Models\Profile;
use App\Models\Pastoral;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\AddressController;
use Maatwebsite\Excel\Facades\Excel;

class ProfileController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email'],
            'dateStart' => ['date_format:Y-m-d'],
        ]);

        $addressClass = new AddressController();

        $provinces =  $addressClass->getProvinces();

        $query = User::query();

        if (request('search')) {
            $search = request('search');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
                $query->orWhere('lastname', 'LIKE', '%' . $search . '%');
            });
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        if (request('pastoral')) {
            $query->whereHas("profile", function ($q) {
                $q->whereHas("transfers", function ($qtransfer) {
                    $qtransfer->where("transfer_date_relocated", null)
                        ->whereHas("community", function ($qtransfer) {
                            $qtransfer->where("pastoral_id", request('pastoral'));
                        });
                });
            });
        }


        if (request('perProvince')) {
            $query->whereHas("profile", function ($q) {
                $address = Address::whereHasMorph(
                    'addressable',
                    [Profile::class],
                    function (Builder $query) {
                        return   $query->where('political_division_id', 'LIKE', request('perProvince') . '%');
                    }
                )->get();

                $index = array();
                foreach ($address as $ob) {
                    $ob->addressable_id;
                    $index[] = $ob->addressable_id;
                }
                $q->whereIn('id', $index);
            });
        }

        $query->whereHas("roles", function ($q) {
            $q->where("name", "daughter");
        })->get();

        if (request('status')) {
            $query->whereHas("profile", function ($q) {
                if (request('dateStart')) {
                    $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                        'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d'],
                        'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d'],
                    ]);
                    if ($validatorData->fails()) {
                        $q->where("status", request('status'));
                        return $this->sendError('Los errores son los siguientes.', $validatorData->errors());
                    } else {
                        if (request('status') == 1) {
                            if (request('typeActive')) {
                                if (request('typeActive') == 1) {
                                    $q->where("date_birth", '!=', null)
                                        ->where("date_vocation", '!=', null)
                                        ->where("date_admission", '!=', null)
                                        ->where("date_send", null)
                                        ->where("date_vote", null);
                                }
                                if (request('typeActive') == 2) {
                                    $q->where("date_birth", '!=', null)
                                        ->where("date_vocation", '!=', null)
                                        ->where("date_admission", '!=', null)
                                        ->where("date_send", '!=', null)
                                        ->where("date_vote", null);
                                }
                                if (request('typeActive') == 3) {
                                    $q->where("date_birth", '!=', null)
                                        ->where("date_vocation", '!=', null)
                                        ->where("date_admission", '!=', null)
                                        ->where("date_send", '!=', null)
                                        ->where("date_vote",  '!=', null);
                                }
                            }
                            $q->whereBetween('date_admission', [request('dateStart'), request('dateEnd')]);
                            $q->orderBy('date_admission', 'desc');
                        }
                        if (request('status') == 2) {
                            $q->whereBetween('date_death', [request('dateStart'), request('dateEnd')]);
                            $q->orderBy('date_death', 'desc');
                        }
                        if (request('status') == 3) {
                            $q->whereBetween('date_exit', [request('dateStart'), request('dateEnd')]);
                            $q->orderBy('date_exit', 'desc');
                        }
                        if (request('status') == 4) {
                            $q->whereBetween('date_retirement', [request('dateStart'), request('dateEnd')]);
                            $q->orderBy('date_retirement', 'desc');
                        }
                        if (request('status') == 5) {
                            $q->whereBetween('date_other_country', [request('dateStart'), request('dateEnd')]);
                            $q->orderBy('date_other_country', 'desc');
                        }
                    }
                }
                if (request('status') == 1) {
                    if (request('typeActive')) {
                        if (request('typeActive') == 1) {
                            $q->where("date_birth", '!=', null)
                                ->where("date_vocation", '!=', null)
                                ->where("date_admission", '!=', null)
                                ->where("date_send", null)
                                ->where("date_vote", null);
                        }
                        if (request('typeActive') == 2) {
                            $q->where("date_birth", '!=', null)
                                ->where("date_vocation", '!=', null)
                                ->where("date_admission", '!=', null)
                                ->where("date_send", '!=', null)
                                ->where("date_vote", null);
                        }
                        if (request('typeActive') == 3) {
                            $q->where("date_birth", '!=', null)
                                ->where("date_vocation", '!=', null)
                                ->where("date_admission", '!=', null)
                                ->where("date_send", '!=', null)
                                ->where("date_vote",  '!=', null);
                        }
                    }
                    $q->where("status", request('status'))->orderBy('date_admission', 'desc');
                }
                if (request('status') == 2) {
                    $q->where("status", request('status'))->orderBy('date_death', 'desc');
                }
                if (request('status') == 3) {
                    $q->where("status", request('status'))->orderBy('date_exit', 'desc');
                }
                if (request('status') == 4) {
                    $q->where('date_retirement', '!=', null)->orderBy('date_retirement', 'desc');
                }
                if (request('status') == 5) {
                    $q->where('date_other_country', '!=', null)->orderBy('date_other_country', 'desc');
                }
            });
        }

        $pastorals = Pastoral::all();

        return response()->json([
            'status' => true,
            'message' => 'Deta get Successfully',
            'provinces' => $provinces,
            'daughtersListResponse' => $query
                ->with('profile')
                ->with('profile.appointments.appointment_level')
                ->with('profile.book')
                ->paginate(request('perPage'))
                ->appends(request()->query()),
            'pastorals' => $pastorals,
            'filters' => request()->all([
                'search', 'field', 'direction', 'page', 'status', 'pastoral', 'dateStart', 'dateEnd', 'perProvince', 'perPage', 'typeActive'
            ])
        ], 200);
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

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:60|unique:users',
            'name' => 'required|string|max:60',
            'fullnamecomm' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'email' => 'required|string|email|max:60|unique:users',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Los errores son los siguientes.', $validator->errors());
        }

        $user = tap(User::create([
            'username' => $request->get('username'),
            'slug' => Str::slug($request->get('username') . '-' . random_int(100, 10000)),
            'name' => $request->get('name'),
            'fullnamecomm' => $request->get('fullnamecomm'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'password' => Hash::make("secret"),
        ]), function (User $user) {
            $this->createTeam($user);
        });

        $user->assignRole('daughter');

        // Input File

        if ($request->file('file')) {

            $validatorFile = Validator::make($request->all(), [
                'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($validatorFile->fails()) {
                return $this->sendError('La imagen no cumple con los requisitos.', $validatorFile->errors());
            }

            $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->id, 's3');
            Storage::disk('s3')->setVisibility($path, 'private');
            $user->image()->create([
                'filename' => $path,
                'url' => Storage::disk('s3')->url($path)
            ]);

            return $this->sendResponse($user, 'Usuario de hermana y fotos creadas correctamente.');
        }

        return $this->sendResponse($user, 'Usuario de hermana creado correctamente.');
    }



    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' Equipo de ', $user->name, 2)[0] . "",
            'personal_team' => true,
        ]));
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
    public function showImage($daughterId)
    {
        $validator = Validator::make(
            ['daughterId' => $daughterId],
            ['daughterId' => ['numeric', 'required', 'exists:users,id']]
        );

        if ($validator->fails()) {

            return null;
        } else {

            $user = User::find($daughterId);

            if ($user->image) {
                return Storage::disk('s3')->temporaryUrl(
                    $user->image->filename,
                    now()->addMinutes(5)
                );
            }
            return null;
        }


        if ($file->first()) {
            $file = $file->first();
            return Storage::disk('s3')->temporaryUrl($file->filename, now()->addMinutes(5));
        }
    }

    public function exportExcel()
    {
        return Excel::download(new DaughListExport(request()), 'HermanasHDLC.xlsx');
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
    public function update(Request $request, $daughterId, $operation)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'fullnamecomm' => 'required|string|max:60',
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($daughterId)],
            // 'file' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],

            'identity_card' => ['required', 'string', 'max:13'],
            'iess_card' => ['nullable', 'string', 'max:30'],
            'driver_license' => ['nullable', 'string', 'max:50'],
            'date_birth' => ['required', 'date_format:Y-m-d'],
            'date_vocation' => ['nullable', 'date_format:Y-m-d'],
            'date_admission' => ['nullable', 'date_format:Y-m-d'],
            'date_send' => ['nullable', 'date_format:Y-m-d'],
            'date_vote' => ['nullable', 'date_format:Y-m-d'],
            'date_retirement' => ['nullable', 'date_format:Y-m-d'],
            'cellphone' => ['nullable', 'string', 'max:15'],
            'phone' => ['nullable', 'string', 'max:15'],

            'observation' => ['nullable', 'string', 'max:4000'],
            'box' => ['nullable', 'string', 'max:15'],
            'page' => ['nullable', 'integer', 'min:1'],
            'book_id' => ['numeric', 'nullable', 'exists:books,id'],
            'ph_docs' => ['nullable', 'numeric'],
            'dg_docs' => ['nullable', 'numeric'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Los errores son los siguientes.', $validator->errors());
        }

        $user = User::find($daughterId);

        // User

        $flag = false;

        foreach ($user->roles as $role) {
            if ($role->name == "daughter") {
                $flag = true;
            } else {
                $flag = false;
            }
        }

        if (!$flag) {
            return $this->sendError('No es posible actualizar el usuario', "");
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

        // Profile

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
                'date_retirement' => $request->get('date_retirement'),
                'cellphone' => $request->get("cellphone"),
                'phone' => $request->get("phone"),
                'observation' => $request->get("observation"),


                'box' => $request->get('box'),
                'page' => $request->get('page'),
                'book_id' => $request->get('book_id'),
                'ph_docs' => $request->get('ph_docs'),
                'dg_docs' => $request->get('dg_docs'),
            ]);

            $profile->address()->create([
                'address' => 'Dir Default',
                'political_division_id' => 999999
            ]);

            return $this->sendResponse($user, 'El perfil de la hermana se ha creado correctamente.');
        } else {
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
                'observation' => $request->get("observation"),

                'box' => $request->get('box'),
                'page' => $request->get('page'),
                'book_id' => $request->get('book_id'),
                'ph_docs' => $request->get('ph_docs'),
                'dg_docs' => $request->get('dg_docs'),
            ]);

            $this->updateStatus($request, $user->profile->id, $operation);

            return $this->sendResponse($user, 'El perfil de la hermana se ha actualizado correctamente.');
        }
    }


    public function updateStatus(Request $request, $profile_id, $operation)
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

        if ($operation == 1) {
            $profile->update([
                'status' =>  1,
                'date_death' => null,
                'date_exit' => null,
                'date_other_country' => null,
                'place_other_country' => null,
            ]);
        }
        if ($operation == 2) {
            $validatorData = Validator::make($request->all(), [
                'date_death' => ['required', 'date_format:Y-m-d'],
            ]);

            if ($validatorData->fails()) {
                return $this->sendError('Los errores son los siguientes.', $validator->errors());
            }

            $profile->update([
                'status' =>  2,
                'date_death' => $request->get('date_death'),
                'date_exit' => null,
                'date_other_country' => null,
                'place_other_country' => null,
            ]);

            $transfer = $profile->transfers->where('status', 1)->first();
            if ($transfer) {
                $transfer->update([
                    'transfer_date_relocated' => $request->get('date_death'),
                    'status' => 0
                ]);
                $appointments = $transfer->appointments;
                foreach ($appointments as $appointment) {
                    $appointment->update([
                        'date_end_appointment' => $request->get('date_death'),
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
        if ($operation == 3) {
            $validatorData = Validator::make($request->all(), [
                'date_exit' => ['required', 'date_format:Y-m-d'],
            ]);

            if ($validatorData->fails()) {
                return $this->sendError('Los errores son los siguientes.', $validator->errors());
            }

            $profile->update([
                'status' =>  3,
                'date_death' => null,
                'date_exit' => $request->get('date_exit'),
                'date_other_country' => null,
                'place_other_country' => null,
            ]);

            $transfer = $profile->transfers->where('status', 1)->first();
            if ($transfer) {
                $transfer->update([
                    'transfer_date_relocated' => $request->get('date_exit'),
                    'status' => 0
                ]);
                $appointments = $transfer->appointments;
                foreach ($appointments as $appointment) {
                    $appointment->update([
                        'date_end_appointment' => $request->get('date_exit'),
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
        if ($operation == 4) {
            $validatorData = Validator::make($request->all(), [
                'date_other_country' => ['required', 'date_format:Y-m-d'],
                'place_other_country' => ['required', 'string', 'max:100'],
            ]);

            if ($validatorData->fails()) {
                return $this->sendError('Los errores son los siguientes.', $validator->errors());
            }

            $profile->update([
                'status' =>  4,
                'date_death' => null,
                'date_exit' => null,
                'date_other_country' => $request->get('date_other_country'),
                'place_other_country' => $request->get('place_other_country'),
            ]);

            $transfer = $profile->transfers->where('status', 1)->first();
            if ($transfer) {
                $transfer->update([
                    'transfer_date_relocated' => $request->get('date_other_country'),
                    'status' => 0
                ]);
                $appointments = $transfer->appointments;
                foreach ($appointments as $appointment) {
                    $appointment->update([
                        'date_end_appointment' => $request->get('date_other_country'),
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($daughterId)
    {
        $validator = Validator::make(
            ['daughterId' => $daughterId],
            ['daughterId' => ['numeric', 'required', 'exists:users,id']]
        );

        if ($validator->fails()) {
            abort(404);
        } else {

            $user = User::find($daughterId);

            if ($user->id == 1) {
                return $this->sendError('La hermana que desea eliminar no existe ', 'No se encuentra');
            }

            if ($user->profile->status !== 2) {
                return $this->sendError('La hermana no puede ser eliminada pues aún se encuentra activa, si desea eliminar este usuario por favor póngase en contacto con Secretaría.', 'No se encuentra');
            }

            if ($user->profile) {
                if ($user->profile->info_family) {
                    $user->profile->info_family()->delete();
                }
                if ($user->profile->academic_trainings) {
                    $user->profile->academic_trainings()->delete();
                }
                if ($user->profile->transfers) {
                    $user->profile->transfers()->delete();
                }
                if ($user->profile->healths) {
                    $user->profile->healths()->delete();
                }
                if ($user->profile->permits) {
                    $user->profile->permits()->delete();
                }
                if ($user->profile->appointments) {
                    $user->profile->appointments()->delete();
                }
                if ($user->profile->sacraments) {
                    $user->profile->sacraments()->delete();
                }
                if ($user->profile->address) {
                    $user->profile->address()->delete();
                }
                if ($user->profile->files) {
                    $user->profile->files()->delete();
                }
                $user->profile->delete();
            }

            $user->delete();

            return $this->sendResponse([], 'Usuario de hermana eliminado correctamente.');
        }
    }
}

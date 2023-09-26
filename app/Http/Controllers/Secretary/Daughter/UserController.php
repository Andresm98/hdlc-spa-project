<?php

namespace App\Http\Controllers\Secretary\Daughter;

use PDF;
use App\Models\Team;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Permit;
use App\Models\Address;
use App\Models\Profile;
use App\Models\Pastoral;
use App\Models\Transfer;
use App\Models\Community;

// Inject

use Illuminate\Support\Str;
use App\Exports\UsersExport;

// Reports

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Secretary\Daughter\ProfileController;
use App\Http\Controllers\Secretary\Daughter\TransferController;

class UserController extends Controller
{
    protected $from; // public, protected <-> private
    protected $to;

    public function __construct()
    {
        $this->from;
        $this->to;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function welcome()
    {
        // Communities
        $communities = count(Community::where('comm_level', 1)->get());

        // Works
        $works = count(Community::where('comm_level', 2)->get());

        // Pastorals
        $pastorals = count(Pastoral::all());

        // Daughters
        $users = User::query();

        $daughters = $users->whereHas("roles", function ($q) {
            $q->where("name", "daughter");
        })->get();
        $daughters = count($daughters);

        $acdaughters = $users->whereHas("profile", function ($q) {
            $q->where("status",  1);
        })->get();
        $acdaughters = count($acdaughters);

        $users2 = User::query();
        $dthdaughters = $users2->whereHas("profile", function ($q) {
            $q->where("status",  2);
        })->get();
        $dthdaughters = count($dthdaughters);

        $users3 = User::query();
        $rtrdaughters = $users3->whereHas("profile", function ($q) {
            $q->where("status",  3);
        })->get();
        $rtrdaughters = count($rtrdaughters);

        $activepermits = Permit::query();
        $activepermits = count($activepermits->where('status', 1)->get());

        $activechanges = Transfer::query();
        $activechanges = count($activechanges->where('status', 1)->get());

        return Inertia::render('Secretary/Welcome', compact(
            'communities',
            'works',
            'pastorals',
            //
            'daughters',
            'acdaughters',
            'dthdaughters',
            'rtrdaughters',
            'activepermits',
            'activechanges',

        ));
    }

    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email'],
            'dateStart' => ['date_format:Y-m-d H:i:s'],
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
                        'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                        'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                    ]);
                    if ($validatorData->fails()) {
                        $q->where("status", request('status'));
                        return redirect()->back()
                            ->withErrors($validatorData->errors());
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
                    $q->where('status', 4);
                }
                if (request('status') == 6) {
                    $q->where('status', 5);
                }
            });
        }

        $pastorals = Pastoral::all();
        return Inertia::render('Secretary/Users/Daughter/Index', [
            'provinces' => $provinces,
            'daughters_list' => $query
                ->with('profile')
                ->with('profile.appointments.appointment_level')
                ->paginate(request('perPage'))
                ->appends(request()->query()),
            'pastorals' => $pastorals,
            'filters' => request()->all([
                'search', 'field', 'direction', 'page', 'status', 'pastoral', 'dateStart', 'dateEnd', 'perProvince', 'perPage', 'typeActive'
            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Secretary/Users/Daughter/Create');
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
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
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
            $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->id, 's3');
            Storage::disk('s3')->setVisibility($path, 'private');
            $user->image()->create([
                'filename' => $path,
                'url' => Storage::disk('s3')->url($path)
            ]);
        }

        return redirect()->route('secretary.daughters.edit', $user->slug)->with([
            'success' => 'Hermana creada correctamente.',
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
    public function edit($slug)
    {
        $validator = Validator::make(['slug' => $slug], [
            'slug' => ['required', 'string', 'alpha_dash', 'exists:users,slug']
        ]);

        // Import Methods
        $profile_daughter = new ProfileController();

        $addressClass = new AddressController();

        if ($validator->fails()) {
            return abort(404);
        }

        $provinces =  $addressClass->getProvinces();

        $daughter_custom = User::select()
            ->where('slug', '=', [$slug])
            ->first();
        //

        $flag = false;
        foreach ($daughter_custom->roles as $role) {
            if ($role->name == "daughter") {
                $flag = true;
            } else {
                $flag = false;
            }
        }

        if (!$flag) {
            return abort(404);
        }

        //

        $user = User::find($daughter_custom->id);

        if ($user->profile) {
            if (!$user->profile->origin) {
                $user->profile->origin()->create([
                    'address' => "",
                    'political_division_id' => null
                ]);
            }
        }

        $profile_daughter = $profile_daughter->specificProfile($daughter_custom->id);

        if ($daughter_custom->image) {
            $image = Storage::disk('s3')->temporaryUrl(
                $daughter_custom->image->filename,
                now()->addMinutes(5)
            );
            return Inertia::render('Secretary/Users/Daughter/Edit', compact('daughter_custom', 'image', 'profile_daughter', 'provinces'));
        }
        return Inertia::render('Secretary/Users/Daughter/Edit', compact('daughter_custom', 'profile_daughter', 'provinces'));
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
            'file' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $user =  User::find($id);

        //

        $flag = false;
        foreach ($user->roles as $role) {
            if ($role->name == "daughter") {
                $flag = true;
            } else {
                $flag = false;
            }
        }

        if (!$flag) {
            return abort(404);
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



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $validator = Validator::make(['slug' => $slug], [
            'slug' => ['required', 'string', 'max:50', 'alpha_dash', 'exists:users,slug']
        ]);

        if ($validator->fails()) {
            abort(404);
        } else {
            $user_custom = User::select('id')
                ->where('slug', '=', [$slug])
                ->get()
                ->first();
            $user =  User::find($user_custom->id);

            if ($user->id == 1) {
                return redirect()->route('secretary.daughters.index')->with('error', 'No se puede eliminar.');
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
            return redirect()->route('secretary.daughters.index')->with('success', 'Eliminado correctamente.');
        }
    }

    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' Equipo de ', $user->name, 2)[0] . "",
            'personal_team' => true,
        ]));
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport(request()), 'HermanasHDLC.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new UsersExport(request()), 'HermanasHDLC.csv');
    }

    /**
     *
     * Report Info family
     */

    function search($value, $array)
    {
        return array_search($value, $array);
    }

    public function reportInfoProfilePDF(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            "options"    => ['nullable', 'array', 'min:0', 'max:6'],
            "options.*"    => ['nullable', 'integer', 'distinct', 'between:1,6'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', "Error al validar datos");
        }

        $user = User::find($request->get('user_id'));

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
                    $data->put('academic_trainings', $user->profile->academic_trainings);
                }
                if (is_numeric($this->search("3", $request->get('options')))) {
                    $data->put('sacraments', $user->profile->sacraments()
                        ->orderBy('sacrament_date', 'asc')
                        ->get());
                }
                if (is_numeric($this->search("4", $request->get('options')))) {
                    $data->put('permits', $user->profile->permits()
                        ->with('address')
                        ->whereBetween('date_out', [$from, $to])
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
            return  collect(['message' => true]);
        }
    }

    public function reportDaughtersPDF()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email'],
            'dateStart' => ['date_format:Y-m-d H:i:s'],
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

        $dateFromTo = new UserController();
        if (request('status')) {
            $query->whereHas("profile", function ($q) use ($dateFromTo) {
                if (request('dateStart')) {
                    $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                        'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                        'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                    ]);
                    if ($validatorData->fails()) {
                        $q->where("status", request('status'));
                        return redirect()->back()
                            ->withErrors($validatorData->errors());
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
                            $q->orderBy('date_other_country', 'desc');
                        }
                        $dateFromTo->setFrom(request('dateStart'));
                        $dateFromTo->setTo(request('dateEnd'));
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
                    $q->where('status', 4);
                }
                if (request('status') == 6) {
                    $q->where('status', 5);
                }
            });

            $from =   $dateFromTo->getFrom();
            $to =  $dateFromTo->getTo();
            if (request('status') == 1) {
                $data = $query
                    ->with('profile')
                    ->with('profile.transfers.community')
                    ->get();
                $type = request('typeActive');

                $pdf = PDF::loadView('reports.daughters.list-active', compact('data', 'from', 'to', 'type'));
                return $pdf->setPaper('a4', 'landscape')->stream('ReportesHermanasHDLCActivas.pdf');
            }
            if (request('status') == 2) {
                $data = $query
                    ->with('profile')
                    ->with('profile.transfers.community')
                    ->get();

                $pdf = PDF::loadView('reports.daughters.list-dead', compact('data', 'from', 'to'));
                return $pdf->setPaper('a4', 'landscape')->stream('ReportesHermanasHDLCFallecidas.pdf');
            }
            if (request('status') == 3) {
                $data = $query
                    ->with('profile')
                    ->with('profile.transfers.community')
                    ->get();

                $pdf = PDF::loadView('reports.daughters.list-retired', compact('data', 'from', 'to'));
                return $pdf->setPaper('a4', 'landscape')->stream('ReportesHermanasHDLCRetiradas.pdf');
            }
            if (request('status') == 4) {
                $data = $query
                    ->with('profile')
                    ->with('profile.transfers.community')
                    ->get();

                $pdf = PDF::loadView('reports.daughters.list-retirement', compact('data', 'from', 'to'));
                return $pdf->setPaper('a4', 'landscape')->stream('ReportesHermanasHDLCJubiladas.pdf');
            }
        }

        $from =   $dateFromTo->getFrom();
        $to =  $dateFromTo->getTo();
        $data = $query
            ->with('profile')
            ->get();

        $pdf = PDF::loadView('reports.daughters.list-general', compact('data', 'from', 'to'));

        return $pdf->setPaper('a4', 'landscape')->stream('ReportesHermanasHDLC.pdf');
    }
}

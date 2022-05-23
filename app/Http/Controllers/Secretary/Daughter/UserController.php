<?php

namespace App\Http\Controllers\Secretary\Daughter;

use PDF;
use App\Models\Team;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Address;
use App\Models\Profile;
use App\Models\Pastoral;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use Illuminate\Http\Request;

// Inject

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

// Reports

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Secretary\Daughter\ProfileController;
use App\Models\Transfer;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function welcome()
    {
        $users = count(User::all());
        $roles  = count(Role::all());
        $permissions = count(Permission::all());
        return Inertia::render('Secretary/Welcome', compact('users', 'roles', 'permissions'));
    }

    public function index()
    {

        //                              OBJECT
        // return  User::whereHas("roles", function ($q) {
        // $q->where("name", "daughter");
        // })->get();
        // return User::role('daughter')->get();

        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email']
        ]);

        $addressClass = new AddressController();
        $provinces =  $addressClass->getProvinces();

        $query = User::query();

        $query->whereHas("roles", function ($q) {
            $q->where("name", "daughter");
        });

        if (request('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        if (request('status')) {
            $query->whereHas("profile", function ($q) {
                $q->where("status", request('status'));
            });
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
        $pastorals = Pastoral::all();
        return Inertia::render('Secretary/Users/Daughter/Index', [
            'provinces' => $provinces,
            'daughters_list' => $query
                ->with('profile')
                ->paginate(request('perPage'))
                ->appends(request()->query()),
            'pastorals' => $pastorals,
            'filters' => request()->all(['search', 'field', 'direction', 'page', 'status', 'pastoral', 'dateStart', 'dateEnd', 'perProvince', 'perPage'])
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
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
            'password' => Str::random(233),
        ]), function (User $user) {
            $this->createTeam($user);
        });

        $user->assignRole('daughter');
        // Input File
        $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->slug, 's3');
        Storage::disk('s3')->setVisibility($path, 'private');
        $user->image()->create([
            'filename' => $path,
            'url' => Storage::disk('s3')->url($path)
        ]);
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
            return   abort(404);
        }

        $provinces =  $addressClass->getProvinces();
        $daughter_custom = User::select()
            ->where('slug', '=', [$slug])
            ->get()
            ->first();

        $user = User::find($daughter_custom->id);
        $profile_daughter =   $profile_daughter->specificProfile($daughter_custom->id);

        // return $addressClass->getSaveAddress($profile_daughter->address->political_division_id);

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
        $validatorData = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'fullnamecomm' => 'required|string|max:60',
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'roles*' => 'required|exists:roles,id',
            'file' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $validator = Validator::make([
            'id' => $id,
        ], [
            'id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $user =  User::find($id);
        if ($request->file('file')) {
            if (!$user->image) {
                $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->slug, 's3');
                Storage::disk('s3')->setVisibility($path, 'private');
                $user->image()->create([
                    'filename' => $path,
                    'url' => Storage::disk('s3')->url($path)
                ]);
            } else {
                Storage::disk('s3')->delete($user->image->filename);
                $path = $request->file('file')->store('documents/daugther-profiles/image/' . $user->slug, 's3');
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

    //  TODO: Export Excel

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }




    /**
     *
     * Report Info family
     */

    public function reportInfoProfile($user_id)
    {


        $user = User::find($user_id);
        return Inertia::render('Secretary/Users/Daughter/Reports/Profile', compact('user'));


        // Import Methods
        $profile_daughter = new ProfileController();
        $addressClass = new AddressController();
        $data =   collect(['status' => true]);

        if ($user->profile) {

            $profile = Profile::with('user')
                ->where('user_id', '=', $user->id)
                ->get();
            $data->put('profile', $profile->first());


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

            $pdf = PDF::loadView('reports.daughters.profile', compact('data'));
            // return $pdf -> download('Usuarios-OpenScience.pdf');
            return $pdf->setPaper('a4', 'portrait')->stream('Perfil Hermana ' . $user->name . '.pdf');
        } else {
            return  collect(['message' => true]);
        }
    }
}

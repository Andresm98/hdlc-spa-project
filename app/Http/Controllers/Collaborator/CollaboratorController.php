<?php

namespace App\Http\Controllers\Collaborator;

use App\Models\Team;
use App\Models\User;
use App\Models\Profile;
use Inertia\Inertia;
use App\Models\Address;
use App\Models\Pastoral;
use App\Models\Community;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Laravel\Jetstream\Features;
use App\Exports\CommunityExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;


class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexDaughters()
    {

        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email,lastname'],
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
                    $q->where("status", request('status'))->orderBy('date_death', 'asc');
                }
                if (request('status') == 3) {
                    $q->where("status", request('status'))->orderBy('date_exit', 'desc');
                }
                if (request('status') == 4) {
                    $q->where('date_retirement', '!=', null)->orderBy('date_retirement', 'desc');
                }
            });
        }

        $pastorals = Pastoral::all();
        return Inertia::render('Collaborator/Index', [
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

    //  TODO: Export Excel

    public function exportDaughtersExcel()
    {
        return Excel::download(new UsersExport(request()), 'HermanasHDLC.xlsx');
    }

    //  TODO: Export CSV

    public function exportDaughtersCSV()
    {
        return Excel::download(new UsersExport(request()), 'HermanasHDLC.csv');
    }

    //

    public function indexCommunities()
    {
        $validator = Validator::make(request()->all(), [
            'direction' => ['in:asc,desc'],
            'field' => ['in:comm_name,comm_email,pastoral_id'],
            'active' =>  ['integer', 'between:1,2'],
            'type' =>  ['integer', 'between:1,2'],
            'pastoral' =>  ['integer', 'exists:pastorals,id'],
            'dateStart' => ['date_format:Y-m-d H:i:s'],
            'perPage' =>  ['integer'],
        ]);

        $addressClass = new AddressController();
        $provinces =  $addressClass->getProvinces();

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'No se encuentran resultados.']);
        }

        $query = Community::query();

        if (request('search')) {
            $query->where('comm_name', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        if (request('pastoral')) {
            $query->where('pastoral_id', '=', request('pastoral'));
        }

        if (request('active')) {
            if (request('active') == 2) {
                if (request('dateStart') || request('dateEnd')) {
                    $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                        'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                        'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                    ]);
                    if ($validatorData->fails()) {
                        $query->orderBy('date_close', 'desc');
                        return redirect()->back()
                            ->withErrors($validatorData->errors());
                    } else {
                        $query->whereBetween('date_close', [request('dateStart'), request('dateEnd')]);
                        $query->orderBy('date_close', 'desc');
                    }
                }
                $query->where('comm_status', '=', 0);
            } else {
                if (request('dateStart') || request('dateEnd')) {
                    $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                        'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                        'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                    ]);
                    if ($validatorData->fails()) {
                        $query->orderBy('date_fndt_comm', 'desc');
                        return redirect()->back()
                            ->withErrors($validatorData->errors());
                    } else {
                        $query->whereBetween('date_fndt_comm', [request('dateStart'), request('dateEnd')]);
                        $query->orderBy('date_fndt_comm', 'desc');
                    }
                }
                $query->where('comm_status', '=', request('active'));
            }
        }

        if (request('type')) {
            $query->where('comm_level', request('type'));
        }

        if (request('perProvince')) {
            $address = Address::whereHasMorph(
                'addressable',
                [Community::class],
                function (Builder $query) {
                    return   $query->where('political_division_id', 'LIKE', request('perProvince') . '%');
                }
            )->get();

            $index = array();
            foreach ($address as $ob) {
                $ob->addressable_id;
                $index[] = $ob->addressable_id;
            }
            $query->whereIn('id', $index);
        }

        $pastorals = Pastoral::all();

        return Inertia::render('Collaborator/Communities', [
            'provinces' => $provinces,
            'communities_list' => $query
                ->with('pastoral')
                ->with('address')
                ->paginate(request('perPage'))
                ->appends(request()->query()),
            'pastorals' => $pastorals,
            'filters' => request()->all(['search', 'field', 'direction', 'page', 'active', 'type', 'pastoral', 'dateStart', 'dateEnd', 'perProvince', 'perPage'])
        ]);
    }


    //  Export Excel

    public function exportCommunitiesExcel()
    {
        return Excel::download(new CommunityExport(request()), 'ComunidadesHDLC.xlsx');
    }

    //  Export CSV

    public function exportCommunitiesCSV()
    {
        return Excel::download(new CommunityExport(request()), 'ComunidadesHDLC.csv');
    }

    public function mod()
    {

        return "metodo modificado colaborador";
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "Crear contenido colaborador (create)";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Mostrar contenido de colaborador (show)";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "Editar el contenido del colaborador (edit)";
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
        return "Eliminar el contenido del colaborador (destroy)";
    }
}

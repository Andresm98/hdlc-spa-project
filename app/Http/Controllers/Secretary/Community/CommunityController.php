<?php

namespace App\Http\Controllers\Secretary\Community;

use Inertia\Inertia;
use App\Models\Address;
use App\Models\Pastoral;
use App\Models\Community;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;
use App\Exports\CommunityExport;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        if (request('dateStart')) {
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

        if (request('active')) {
            if (request('active') == 2) {
                $query->where('comm_status', '=', 0);
            } else {
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

        return Inertia::render('Secretary/Communities/Index', [
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Secretary/Communities/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatorData = Validator::make($request->all(), [
            'comm_identity_card' => ['required', 'string', 'max:13'],
            'comm_name' => ['required', 'max:1000'],
            'comm_cellphone' =>  ['nullable', 'string', 'max:20'],
            'comm_phone' =>  ['string', 'max:20'],
            'comm_email' =>  ['required', 'string', 'email', 'max:255', 'unique:communities'],
            'date_fndt_comm' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_fndt_work' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'rn_collaborators' => ['integer', 'between:1,1000'],
            'political_division_id' => ['required', 'exists:political_divisions,id'],
            'pastoral_id' => ['required', 'exists:pastorals,id']
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $community = Community::create([
            'comm_identity_card' =>  $request->get('comm_identity_card'),
            'comm_name' =>  $request->get('comm_name'),
            'comm_slug' => Str::slug($request->get('comm_name') . ' ' . random_int(1000, 10000)),
            'comm_level' => 1,
            'comm_cellphone' =>   $request->get('comm_cellphone'),
            'comm_phone' =>   $request->get('comm_phone'),
            'comm_email' =>  $request->get('comm_email'),
            'date_fndt_comm' =>  $request->get('date_fndt_comm'),
            'date_fndt_work' => $request->get('date_fndt_work'),
            'rn_collaborators' => $request->get('rn_collaborators'),
            'pastoral_id' => $request->get('pastoral_id'),
            'comm_status' => 1,
        ]);

        $community->inventory()->create([
            'name' => 'Inventario de ' . $community->comm_name,
            'description' => 'Descripción del inventario de la comunidad ' . $community->comm_name
        ]);

        $community->address()->create([
            'address' => $request->get('address'),
            'political_division_id' => $request->get('political_division_id'),
        ]);

        $addressClass = new AddressController();
        $arrayAddress =  $addressClass->getActualAddress($request->get('political_division_id'));
        $data_province = $arrayAddress["data_province"];
        $data_canton = $arrayAddress["data_canton"];

        $community->update([
            'comm_name' => $community->comm_name . ' de ' .  $data_province . ', ' . $data_canton,
            'comm_slug' => Str::slug($community->comm_name . ' de ' . $arrayAddress["data_province"] . ' ' . $arrayAddress["data_parish"]),
        ]);

        return redirect()->route('secretary.communities.edit', $community->comm_slug)->with('success', 'Comunidad creada correctamente.');
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
            'slug' => ['required', 'string', 'alpha_dash', 'exists:communities,comm_slug']
        ]);
        if ($validator->fails()) {
            abort(404);
        }
        $addressClass = new AddressController();
        $provinces =  $addressClass->getProvinces();

        $community_custom = Community::with('address')
            ->with('pastoral')
            ->with('zone')
            ->where('comm_slug', '=', [$slug])
            ->get()
            ->first();

        if ($community_custom->comm_level != 1) {
            abort(404);
        }

        $arrayAddress =  $addressClass->getActualAddress($community_custom->address->political_division_id);
        $data_province = $arrayAddress["data_province"];
        $data_canton = $arrayAddress["data_canton"];
        $prefix = strstr($community_custom->comm_name, ' de ' .  $data_province . ', ' . $data_canton, true);
        $postfix = ' de ' .  $data_province . ', ' . $data_canton;

        return Inertia::render('Secretary/Communities/Edit', compact('community_custom', 'provinces', 'prefix', 'postfix'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $community_id)
    {
        $validator = Validator::make([
            'community_id' => $community_id,
        ], [
            'community_id' => ['required', 'exists:communities,id'],
        ]);
        $validatorData = Validator::make(
            $request->all(),
            [
                'comm_identity_card' => ['required', 'string', 'max:13'],
                'comm_name' => ['required', 'max:1000'],
                'comm_cellphone' =>  ['nullable', 'string', 'max:20'],
                'comm_phone' =>  ['string', 'max:20'],
                'comm_email' =>  ['required', 'string', 'email', 'max:255', Rule::unique('communities')->ignore($community_id)],
                'date_fndt_comm' => ['required', 'date_format:Y-m-d H:i:s'],
                'date_fndt_work' => ['nullable',  'date_format:Y-m-d H:i:s'],
                'rn_collaborators' => ['integer', 'between:1,1000'],
                'pastoral_id' => ['required', 'exists:pastorals,id'],
                'zone_id' => ['nullable', 'exists:zones,id']
            ]
        );

        if ($validator->fails()) {
            return abort(404);
        }
        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }
        $community = Community::find($community_id);

        if ($community->comm_level != 1) {
            abort(404);
        }

        $community->update([
            'comm_identity_card' =>  $request->get('comm_identity_card'),
            'comm_name' =>  $request->get('comm_name'),
            'comm_slug' => Str::slug($request->get('comm_name') . ' ' . random_int(1000, 10000)),
            'comm_cellphone' =>   $request->get('comm_cellphone'),
            'comm_phone' =>   $request->get('comm_phone'),
            'comm_email' =>  $request->get('comm_email'),
            'date_fndt_comm' =>  $request->get('date_fndt_comm'),
            'date_fndt_work' => $request->get('date_fndt_work'),
            'rn_collaborators' => $request->get('rn_collaborators'),
            'pastoral_id' => $request->get('pastoral_id'),
            'zone_id' => $request->get('zone_id'),
        ]);

        if (!$community->address) {
            $community->address()->create([
                'address' => $request->get('address'),
                'political_division_id' => $request->get('political_division_id'),
            ]);

            $addressClass = new AddressController();
            $arrayAddress =  $addressClass->getActualAddress($request->get('political_division_id'));
            $data_province = $arrayAddress["data_province"];
            $data_canton = $arrayAddress["data_canton"];

            $community->update([
                'comm_name' => $community->comm_name . ' de ' .  $data_province . ', ' . $data_canton,
                'comm_slug' => Str::slug($community->comm_name . ' de ' . $arrayAddress["data_province"] . ' ' . $arrayAddress["data_parish"]),
            ]);

            return redirect()->route('secretary.communities.edit', $community->comm_slug)->with([
                'success' => 'La comunidad fue actualizada y la dirección fue creada correctamente.',
            ]);
        } else {

            $addressClass = new AddressController();
            $arrayAddress =  $addressClass->getActualAddress($community->address->political_division_id);
            $data_province = $arrayAddress["data_province"];
            $data_canton = $arrayAddress["data_canton"];
            $nameCommunity = strstr($community->comm_name, ' de ' .  $data_province . ', ' . $data_canton, true);

            $community->address()->update([
                'address' => $request->get('address'),
                'political_division_id' => $request->get('political_division_id'),
            ]);

            $arrayAddress =  $addressClass->getActualAddress($request->get('political_division_id'));
            $data_province = $arrayAddress["data_province"];
            $data_canton = $arrayAddress["data_canton"];

            $community->update([
                'comm_name' => $nameCommunity  . ' de ' .  $data_province . ', ' . $data_canton,
                'comm_slug' => Str::slug($nameCommunity . ' de ' . $arrayAddress["data_province"] . ' ' . $arrayAddress["data_parish"]),
            ]);

            return redirect()->route('secretary.communities.edit', $community->comm_slug)->with([
                'success' => 'La comunidad fue actualizada y la dirección fue actualizada correctamente.',
            ]);
        }
    }


    public function updateStatus(Request $request, $community_id)
    {
        $validator = Validator::make([
            'community_id' => $community_id,
        ], [
            'community_id' => ['required', 'exists:communities,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $community = Community::find($community_id);

        if ($community->comm_level != 1) {
            abort(404);
        }

        if ($community->comm_status == 1) {

            $validatorData = Validator::make($request->all(), [
                'dateCloseCommunity' => ['date_format:Y-m-d H:i:s'],
            ]);

            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors())
                    ->withInput();
            }

            $community->update([
                'comm_status' =>  0,
                'date_close' =>  $request->get('dateCloseCommunity'),
            ]);
            return redirect()->back()->with(['success' => 'La comunidad fue cerrada correctamente.']);
        } else {
            $community->update([
                'comm_status' =>  1,
                'date_close' =>  null,
            ]);
            return redirect()->back()->with(['success' => 'La comunidad fue abierta nuevamente correctamente']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($community_id)
    {
        try {
            $validator = Validator::make([
                'community_id' => $community_id,
            ], [
                'community_id' => ['required', 'exists:communities,id'],
            ]);

            if ($validator->fails()) {
                return abort(404);
            }

            $community = Community::find($community_id);
            $community->inventory()->delete();
            $community->delete();

            return redirect()->back()->with(['success' => 'La comunidad fue eliminada correctamente']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with(['error' => 'Durante la acción ocurrió el siguiente error: ' . $ex->getMessage()]);
        }
    }

    //  TODO: Export Excel

    public function exportExcel()
    {
        return (new CommunityExport(request()))->download('communidades.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    //  TODO: Export CSV

    public function exportCSV()
    {
        return (new CommunityExport(request()))->download('communidades.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}

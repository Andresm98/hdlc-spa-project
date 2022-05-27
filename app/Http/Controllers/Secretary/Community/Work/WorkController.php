<?php

namespace App\Http\Controllers\Secretary\Community\Work;

use Inertia\Inertia;
use App\Models\Community;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($community_id)
    {
        $validator = Validator::make([
            'community_id' => $community_id,
        ], [
            'community_id' => ['required', 'exists:communities,id'],
        ]);
        if ($validator->fails()) {
            return abort(404);
        }
        $works_list = Community::where('comm_level', '=', 2)
            ->where('comm_id', '=', $community_id)
            ->where('comm_status', '=', 1)
            ->get();
        return $works_list;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($community_slug)
    {
        $validator = Validator::make(['slug' => $community_slug], [
            'slug' => ['required', 'string', 'alpha_dash', 'exists:communities,comm_slug']
        ]);
        if ($validator->fails()) {
            abort(404);
        }
        $community_custom = Community::select('id')
            ->where('comm_slug', '=', $community_slug)
            ->get()
            ->first();

        return Inertia::render('Secretary/Communities/Work/Create', compact('community_custom'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $community_id)
    {
        $validator = Validator::make(['id' => $community_id], [
            'id' => ['required', 'exists:communities,id']
        ]);

        $validatorData = Validator::make($request->all(), [
            'comm_identity_card' => ['required', 'string', 'max:13'],
            'comm_name' => ['required', 'max:1000'],
            'comm_cellphone' =>  ['nullable', 'string', 'max:20'],
            'comm_phone' =>  ['string', 'max:20'],
            'comm_email' =>  ['required', 'string', 'email', 'max:255', 'unique:communities'],
            'date_fndt_comm' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_fndt_work' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'rn_collaborators' => ['required', 'integer', 'between:0,1000'],
            'political_division_id' => ['required', 'exists:political_divisions,id'],
            'pastoral_id' => ['required', 'exists:pastorals,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }
        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $community = Community::create([
            'comm_identity_card' =>  $request->get('comm_identity_card'),
            'comm_name' =>  $request->get('comm_name'),
            'comm_slug' => Str::slug($request->get('comm_name') . ' ' . random_int(1000, 10000)),
            'comm_level' => 2,
            'comm_id' => $community_id,
            'comm_cellphone' =>   $request->get('comm_cellphone'),
            'comm_phone' =>   $request->get('comm_phone'),
            'comm_email' =>  $request->get('comm_email'),
            'date_fndt_comm' =>  $request->get('date_fndt_comm'),
            'date_fndt_work' => $request->get('date_fndt_work'),
            'rn_collaborators' => $request->get('rn_collaborators'),
            'pastoral_id' => $request->get('pastoral_id'),
            'comm_status' => 1,
        ]);
        $community->address()->create([
            'address' => $request->get('address'),
            'political_division_id' => $request->get('political_division_id'),
        ]);
        $community->inventory()->create([
            'name' => 'Inventario de ' . $community->comm_name,
            'description' => 'Descripción del inventario de la obra ' . $community->comm_name
        ]);

        $addressClass = new AddressController();
        $arrayAddress =  $addressClass->getActualAddress($request->get('political_division_id'));
        $data_province = $arrayAddress["data_province"];
        $data_canton = $arrayAddress["data_canton"];

        $community->update([
            'comm_name' => $community->comm_name . ' de ' .  $data_province . ', ' . $data_canton,
            'comm_slug' => Str::slug($community->comm_name . ' de ' . $arrayAddress["data_province"] . ' ' . $arrayAddress["data_parish"]),
        ]);
        return redirect()->route('secretary.works.edit', $community->comm_slug)->with('success', 'Obra creada correctamente.');
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

        if ($community_custom->comm_level != 2  || $community_custom->comm_id == null) {
            abort(404);
        }

        $community_principal = Community::where('id', '=', $community_custom->comm_id)
            ->where('comm_level', '=', 1)
            ->get()
            ->first();

        $arrayAddress =  $addressClass->getActualAddress($community_custom->address->political_division_id);
        $data_province = $arrayAddress["data_province"];
        $data_canton = $arrayAddress["data_canton"];
        $prefix = strstr($community_custom->comm_name, ' de ' .  $data_province . ', ' . $data_canton, true);
        $postfix = ' de ' .  $data_province . ', ' . $data_canton;

        return Inertia::render('Secretary/Communities/Work/Edit', compact('community_custom', 'community_principal', 'provinces', 'prefix', 'postfix'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $work_id)
    {
        $validator = Validator::make([
            'work_id' => $work_id,
        ], [
            'work_id' => ['required', 'exists:communities,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $validatorData = Validator::make(
            $request->all(),
            [
                'comm_identity_card' => ['required', 'string', 'max:13'],
                'comm_name' => ['required', 'max:1000'],
                'comm_cellphone' =>  ['nullable', 'string', 'max:20'],
                'comm_phone' =>  ['string', 'max:20'],
                'comm_email' =>  ['required', 'string', 'email', 'max:255', Rule::unique('communities')->ignore($work_id)],
                'date_fndt_comm' => ['required', 'date_format:Y-m-d H:i:s'],
                'date_fndt_work' => ['nullable',  'date_format:Y-m-d H:i:s'],
                'rn_collaborators' => ['integer', 'between:1,1000'],
                'pastoral_id' => ['required', 'exists:pastorals,id'],
                'zone_id' => ['nullable', 'exists:zones,id']
            ]
        );

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $community = Community::find($work_id);

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

            return redirect()->route('secretary.works.edit', $community->comm_slug)->with([
                'success' => 'La obra fue actualizada y la dirección fue creada correctamente.',
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

            return redirect()->route('secretary.works.edit', $community->comm_slug)->with([
                'success' => 'La obra fue actualizada y la dirección fue actualizada correctamente.',
            ]);
        }
    }

    public function updateStatus(Request $request, $work_id)
    {
        $validator = Validator::make([
            'work_id' => $work_id,
        ], [
            'work_id' => ['required', 'exists:communities,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $work = Community::find($work_id);
        if ($work->comm_status == 1) {

            $validatorData = Validator::make($request->all(), [
                'dateCloseCommunity' => ['date_format:Y-m-d H:i:s'],
            ]);

            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors())
                    ->withInput();
            }

            $work->update([
                'comm_status' =>  0,
                'date_close' =>  $request->get('dateCloseCommunity'),
            ]);
            return redirect()->back()->with(['success' => 'La comunidad fue cerrada correctamente.']);
        } else {
            $work->update([
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
    public function destroy($work_id)
    {
        try {
            $validator = Validator::make([
                'work_id' => $work_id,
            ], [
                'work_id' => ['required', 'exists:communities,id'],
            ]);

            if ($validator->fails()) {
                return abort(404);
            }

            $work = Community::find($work_id);
            $work->inventory()->delete();
            $work->delete();

            return redirect()->back()->with(['success' => 'La obra fue eliminada correctamente']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with(['error' => 'Durante la acción ocurrió el siguiente error: ' . $ex->getMessage()]);
        }
    }
}

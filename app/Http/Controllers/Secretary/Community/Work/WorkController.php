<?php

namespace App\Http\Controllers\Secretary\Community\Work;

use Inertia\Inertia;
use App\Models\Community;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
            'slug' => ['required', 'string', 'max:50', 'alpha_dash', 'exists:communities,comm_slug']
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
            'id' => ['required', 'string', 'max:50', 'alpha_dash', 'exists:communities,id']
        ]);

        $validatorData = Validator::make($request->all(), [
            'comm_identity_card' => ['required', 'string', 'max:13'],
            'comm_name' => ['required', 'max:100'],
            'comm_cellphone' =>  ['string', 'max:20'],
            'comm_phone' =>  ['string', 'max:20'],
            'comm_email' =>  ['required', 'string', 'email', 'max:255', 'unique:communities'],
            'date_fndt_comm' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_fndt_work' => ['required', 'date_format:Y-m-d H:i:s'],
            'rn_collaborators' => ['required', 'integer', 'between:1,1000'],
            'political_division_id' => ['required', 'exists:political_divisions,id']
        ]);
        if ($validator->fails() || $validatorData->fails()) {
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

        ]);
        $community->address()->create([
            'address' => $request->get('address'),
            'political_division_id' => $request->get('political_division_id'),
        ]);
        $community->inventory()->create([
            'name' => 'Inventario de ' . $community->comm_name,
            'description' => 'Descripción del inventario de la obra ' . $community->comm_name
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
            'slug' => ['required', 'string', 'max:50', 'alpha_dash', 'exists:communities,comm_slug']
        ]);
        if ($validator->fails()) {
            abort(404);
        }
        $addressClass = new AddressController();
        $provinces =  $addressClass->getProvinces();

        $community_custom = Community::with('address')
            ->where('comm_slug', '=', [$slug])
            ->get()
            ->first();

        return Inertia::render('Secretary/Communities/Work/Edit', compact('community_custom', 'provinces'));
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
        $validatorData = Validator::make(
            $request->all(),
            [
                'comm_identity_card' => ['required', 'string', 'max:13'],
                'comm_name' => ['required', 'max:100'],
                'comm_cellphone' =>  ['string', 'max:20'],
                'comm_phone' =>  ['string', 'max:20'],
                'comm_email' =>  ['email', 'max:255'],
                'date_fndt_comm' => ['required', 'date_format:Y-m-d H:i:s'],
                'date_fndt_work' => ['required', 'date_format:Y-m-d H:i:s'],
                'rn_collaborators' => ['required', 'integer', 'between:1,1000'],
            ]
        );
        if ($validator->fails() || $validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }
        $community = Community::find($work_id);

        $community->update([
            'comm_identity_card' =>  $request->get('comm_identity_card'),
            'comm_name' =>  $request->get('comm_name'),
            'comm_cellphone' =>   $request->get('comm_cellphone'),
            'comm_phone' =>   $request->get('comm_phone'),
            'comm_email' =>  $request->get('comm_email'),
            'date_fndt_comm' =>  $request->get('date_fndt_comm'),
            'date_fndt_work' => $request->get('date_fndt_work'),
            'rn_collaborators' => $request->get('rn_collaborators'),
        ]);

        if (!$community->address) {
            $community->address()->create([
                'address' => $request->get('address'),
                'political_division_id' => $request->get('political_division_id'),
            ]);
            return redirect()->route('secretary.works.edit', $community->comm_slug)->with([
                'success' => 'La obra fue actualizada y la dirección fue creada correctamente.',
            ]);
        } else {
            $community->address()->update([
                'address' => $request->get('address'),
                'political_division_id' => $request->get('political_division_id'),
            ]);
            return redirect()->route('secretary.works.edit', $community->comm_slug)->with([
                'success' => 'La obra fue actualizada y la dirección fue actualizada correctamente.',
            ]);
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
                return response()->json(['error' => 'No se encuentran datos!']);
            }

            $work = Community::find($work_id);
            $work->inventory()->delete();
            $work->delete();

            return redirect()->back()->with(['success' => 'La obra fue eliminada correctamente']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }
}

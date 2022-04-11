<?php

namespace App\Http\Controllers\Secretary\Community;

use Inertia\Inertia;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Str;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities_list = Community::where('comm_id', '=', null)
            ->where('comm_level', '=', 1)
            ->where('comm_status', '=', 1)
            ->paginate(10);
        return Inertia::render('Secretary/Communities/Index', compact('communities_list'));
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
            'comm_name' => ['required', 'max:100'],
            'comm_cellphone' =>  ['string', 'max:20'],
            'comm_phone' =>  ['string', 'max:20'],
            'comm_email' =>  ['required', 'string', 'email', 'max:255', 'unique:communities'],
            'date_fndt_comm' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_fndt_work' => ['required', 'date_format:Y-m-d H:i:s'],
            'rn_collaborators' => ['digits_between:0,1000'],
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
        $community->address()->create([
            'address' => $request->get('address'),
            'political_division_id' => $request->get('political_division_id'),
        ]);
        $community->inventory()->create([
            'name' => 'Inventario de ' . $community->comm_name,
            'description' => 'Descripción del inventario de la comunidad ' . $community->comm_name
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
            'slug' => ['required', 'string', 'max:50', 'alpha_dash', 'exists:communities,comm_slug']
        ]);
        if ($validator->fails()) {
            abort(404);
        }
        $addressClass = new AddressController();
        $provinces =  $addressClass->getProvinces();

        $community_custom = Community::with('address')
            ->with('pastoral')
            ->where('comm_slug', '=', [$slug])
            ->get()
            ->first();

        return Inertia::render('Secretary/Communities/Edit', compact('community_custom', 'provinces'));
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
                'comm_name' => ['required', 'max:100'],
                'comm_cellphone' =>  ['string', 'max:20'],
                'comm_phone' =>  ['string', 'max:20'],
                'comm_email' =>  ['required', 'string', 'email', 'max:255', Rule::unique('communities')->ignore($community_id)],
                'date_fndt_comm' => ['required', 'date_format:Y-m-d H:i:s'],
                'date_fndt_work' => ['required', 'date_format:Y-m-d H:i:s'],
                'rn_collaborators' => ['digits_between:0,1000'],
                'pastoral_id' => ['required', 'exists:pastorals,id']
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
        ]);

        if (!$community->address) {
            $community->address()->create([
                'address' => $request->get('address'),
                'political_division_id' => $request->get('political_division_id'),
            ]);
            return redirect()->route('secretary.communities.edit', $community->comm_slug)->with([
                'success' => 'La comunidad fue actualizada y la dirección fue creada correctamente.',
            ]);
        } else {
            $community->address()->update([
                'address' => $request->get('address'),
                'political_division_id' => $request->get('political_division_id'),
            ]);
            return redirect()->route('secretary.communities.edit', $community->comm_slug)->with([
                'success' => 'La comunidad fue actualizada y la dirección fue actualizada correctamente.',
            ]);
        }
    }


    public function updateStatus($community_id)
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
        if ($community->comm_status == 1) {
            $community->update([
                'comm_status' =>  0,
            ]);
            return redirect()->back()->with(['success' => 'La comunidad fue cerrada correctamente.']);
        } else {
            $community->update([
                'comm_status' =>  1,
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
}

<?php

namespace App\Http\Controllers\Secretary\Community\Inventory;

use App\Models\Section;
use App\Models\Community;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CommunitySectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($inventory_id)
    {
        $validator = Validator::make([
            'inventory_id' => $inventory_id,
        ], [
            'inventory_id' => ['required', 'exists:inventories,id'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        return  Section::where('inventory_id', '=', $inventory_id)
            ->with('articles')
            ->get();
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
    public function store(Request $request, $community_id)
    {
        $validator = Validator::make([
            'community_id' => $community_id,
        ], [
            'community_id' => ['required', 'exists:communities,id'],
        ]);

        $validatorData = Validator::make($request->all(), [
            'name' => ['required', 'max:100'],
            'description' => ['required', 'max:4000'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }
        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $commmunity = Community::find($community_id);
        $commmunity->inventory->sections()->create([
            'name' => $request->get('name'),
            'slug' => Str::slug($commmunity->comm_name . ' ' . $commmunity->id . ' ' . $request->get('name')),
            'description' => $request->get('description')
        ]);

        return redirect()->back()->with([
            'success' => 'La sección del inventario fue guardada correctamente!',
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
    public function update(Request $request, $inventory_id, $section_id, $community_id)
    {
        $validator = Validator::make([
            'inventory_id' => $inventory_id,
            'section_id' => $section_id
        ], [
            'inventory_id' => ['required', 'exists:inventories,id'],
            'section_id' => ['required', 'exists:sections,id']
        ]);
        if ($validator->fails()) {
            return abort(404);
        }

        $validatorData = Validator::make($request->all(), [
            'name' => ['required', 'max:100'],
            'description' => ['required', 'max:4000'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $section = Section::where('id', '=', $section_id)
            ->where('inventory_id', '=', $inventory_id)
            ->get()
            ->first();

        $commmunity = Community::find($community_id);

        $section->update([
            'name' => $request->get('name'),
            'slug' => Str::slug($commmunity->comm_name . ' ' . $commmunity->id . ' ' . $request->get('name')),
            'description' => $request->get('description'),
        ]);
        return redirect()->back()->with(['success' => 'Sección actualizada correctamente!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($inventory_id, $section_id)
    {
        try {
            $validator = Validator::make([
                'inventory_id' => $inventory_id,
                'section_id' => $section_id
            ], [
                'inventory_id' => ['required', 'exists:inventories,id'],
                'section_id' => ['required', 'exists:sections,id']
            ]);

            if ($validator->fails()) {
                return abort(404);
            }

            $section = Section::where('id', '=', $section_id)
                ->where('inventory_id', '=', $inventory_id)
                ->get()
                ->first();
            $section->delete();

            return redirect()->back()->with(['success' => 'Sección eliminada correctamente!']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with(['error' => 'La sección contiene artículos, no puede ser eliminada.']);
        }
    }
}

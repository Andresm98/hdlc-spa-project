<?php

namespace App\Http\Controllers\Secretary\Community\Inventory;

use App\Models\Section;
use App\Models\Community;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CommunityInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inventory::all();
    }


    /*
    * @return Specific Inventory
    */

    public function getInventory($community_id)
    {
        $validation = Validator::make(['id' => $community_id],   [
            'id' => ['required', 'exists:communities,id']
        ]);


        if ($validation->fails()) {
            return response()->json([
                'error' => 'El dato no existe'
            ]);
        }

        $community = Community::find($community_id);
        return $community->inventory;
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
        //
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
    public function update(Request $request, $inventory_id)
    {
        $validation = Validator::make(['inventory_id' => $inventory_id], [
            'inventory_id' => ['required', 'exists:inventories,id']
        ]);

        if ($validation->fails()) {
            return abort(404);
        }
        $validationData = Validator::make([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'id' => $inventory_id
        ], [
            'name' => ['required', 'max:100'],
            'description' => ['required', 'max:4000'],
            'id' => ['required', 'exists:inventories,id']
        ]);

        if ($validationData->fails()) {
            return  redirect()->back()
                ->withErrors($validationData->errors())
                ->withInput();
        }

        $inventory = Inventory::find($inventory_id);

        $inventory->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return redirect()->back()->with(['success' => 'El inventario se actualiza correctamente']);
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
}

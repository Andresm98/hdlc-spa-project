<?php

namespace App\Http\Controllers\Daughter;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InventoryGlobalController extends Controller
{
    /*
    * Prove Verified proveNewVerified
    */

    public static function proveNewVerified()
    {
        $hashedPassword = Auth::user()->getAuthPassword();

        if (Hash::check('secret', $hashedPassword)) {
            return true;
        }

        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

        $checking = $this->proveNewVerified();

        if ($checking) {
            return abort(404);
        }

        $community = Community::find($community_id);

        return $community->inventory;
    }

    public function index()
    {
        $authUser = auth()->user();

        $daughter = User::find($authUser->id);
        $daughter->profile;

        if ($daughter->profile) {

            $transferActive = $daughter->profile->transfers()->where('status', 1)->first();

            if ($transferActive) {

                $appointments = $transferActive->appointments;

                if ($appointments) {

                    $flag = true;
                    foreach ($appointments as $app) {
                        if (
                            $app->appointment_level->id == 4 || $app->appointment_level->id == 7 ||
                            $app->appointment_level->id == 10 || $app->appointment_level->id == 12 ||
                            $app->appointment_level->id == 17 || $app->appointment_level->id == 18
                        ) {
                            $flag = true;
                            break;
                        } else {
                            $flag = false;
                        }
                    }

                    if (!$flag) {
                        return abort(404);
                    }

                    $communityId = $transferActive->community_id;

                    $community = Community::find($communityId);

                    return Inertia::render('Daughter/InventoryGlobal/Component', [
                        'datac' => $community,
                        'community' => $community->inventory,
                    ]);
                }
            } else {
                return abort(404);
            }
        }
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
        //
    }
}

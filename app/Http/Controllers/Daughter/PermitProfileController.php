<?php

namespace App\Http\Controllers\Daughter;

use PDF;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Permit;
use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;
use App\Models\Appointment;
use App\Models\AppointmentLevel;

class PermitProfileController extends Controller
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
    public function index()
    {

        $authUser = auth()->user();

        $checking = $this->proveNewVerified();

        if ($checking) {
            return abort(404);
        }

        $daughter = User::find($authUser->id);

        $daughter->profile;

        if ($daughter->profile) {
            $query = Permit::query();
            $idData = $daughter->profile->id;
            $query->whereHas('profile', function ($q) use ($idData) {
                $q->where('id', $idData);
            });

            $query->with('profile.user')
                ->orderBy('date_out', 'desc')
                ->get();

            $query->whereHas("profile.user.roles", function ($q) {
                $q->where("name", "daughter");
            })->get();

            if (request('search')) {
                $query->where('reason', 'LIKE', '%' . request('search') . '%');
            }

            if (request('status')) {
                if (request('status') == 1) {
                    $query->where('status', 1);
                } else if (request('status') == 2) {
                    $query->where('status', 0);
                }
            }


            if (request('dateStart') || request('dateEnd')) {
                $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                    'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                    'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                ]);
                if ($validatorData->fails()) {
                    return redirect()->back()
                        ->withErrors($validatorData->errors());
                } else {
                    $query->whereBetween('date_out', [request('dateStart'), request('dateEnd')]);
                    $query->orderBy('date_out', 'desc');
                }
            }
            $addressClass = new AddressController();
            $provinces =  $addressClass->getProvinces();

            return Inertia::render('Daughter/Permit', [
                'allProvinces' => $provinces,
                'permits' => $query
                    ->with('address')
                    ->with('community')
                    ->paginate(10)
                    ->appends(request()->query()),
                'filters' => request()->all(['date', 'search', 'status', 'dateStart', 'dateEnd']),

            ]);
        } else {
            return abort(404);
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

    public function printPermit($permit_id)
    {
        $validator = Validator::make([
            'permit_id' => $permit_id
        ], [
            'permit_id' => ['required', 'exists:permits,id']
        ]);

        $authUser = auth()->user();

        $user = User::find($authUser->id);
        if (!$user) {
            return abort(404);
        }

        $permit = Permit::find($permit_id);

        $user->profile;

        $dVisitatorAppointment = AppointmentLevel::where('level', 2)
            ->where('id', 4)
            ->first();

        $visitator = Appointment::where('appointment_level_id', $dVisitatorAppointment->id)
            ->where('status', 1)
            ->with('profile.user')
            ->first();

        $pdf = PDF::loadView('reports.daughters.permit', compact('permit', 'user', 'visitator'));

        return $pdf->setPaper('a4', 'portrait')->stream('Permiso de la hermana ' . $user->name . '.pdf');
    }
}

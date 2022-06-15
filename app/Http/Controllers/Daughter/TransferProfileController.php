<?php

namespace App\Http\Controllers\Daughter;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Transfer;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;

class TransferProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = auth()->user();

        $daughter = User::find($authUser->id);
        $daughter->profile;

        if ($daughter->profile) {
            $query = Transfer::query();
            $idData = $daughter->profile->id;
            $query->whereHas('profile', function ($q) use ($idData) {
                $q->where('id', $idData);
            });


            $query->with('profile.user')
                ->with('community')
                ->orderBy('transfer_date_adission', 'desc')
                ->get();

            $query->whereHas("profile.user.roles", function ($q) {
                $q->where("name", "daughter");
            })->get();

            if (request('search')) {
                $query->where('transfer_reason', 'LIKE', '%' . request('search') . '%');
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
                    $query->whereBetween('transfer_date_adission', [request('dateStart'), request('dateEnd')]);
                    $query->orderBy('transfer_date_adission', 'desc');
                }
            }
            $addressClass = new AddressController();
            $provinces =  $addressClass->getProvinces();

            return Inertia::render('Daughter/Transfer', [
                'allProvinces' => $provinces,
                'transfers' => $query
                    ->paginate(10)
                    ->appends(request()->query()),
                'filters' => request()->all(['date', 'search', 'status', 'dateStart', 'dateEnd']),

            ]);
        }
    }

    public function allAppointments($transfer_id)
    {
        $appointments_list = Appointment::where('transfer_id',  $transfer_id)
            ->with('appointment_level')
            ->with('community')
            ->orderBy('appointment_level_id', 'asc')
            ->get();
        return $appointments_list;
    }

    public function transferData($transfer_id)
    {

        $transfer =  Transfer::with('community')
            ->with('office')
            ->where('id', '=', $transfer_id)
            ->get()
            ->first();

        return $transfer;
    }
    public function search()
    {
        $validator = Validator::make(['search' => request('search')], [
            'search' => ['nullable', 'string', 'max:60'],
        ]);

        if ($validator->fails()) {
            return [];
        }

        $query = User::query();

        $query->whereHas("roles", function ($q) {
            $q->where("name", "daughter");
        })->get();

        if (request('search')) {
            $search = request('search');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
                $query->orWhere('lastname', 'LIKE', '%' . $search . '%');
            });
            return $query
                ->with('profile')
                ->get();
        }
        return [];
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

<?php

namespace App\Http\Controllers\Secretary\Transfer;

use PDF;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Permit;
use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Exports\TransfersExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;

class TransferGlobalController extends Controller
{
    protected $from; // public, protected <-> private
    protected $to;

    public function __construct()
    {
        $this->from;
        $this->to;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Transfer::query();

        $query->with('profile.user')
            ->with('community')
            ->orderBy('transfer_date_adission', 'desc')
            ->get();

        $query->whereHas("profile.user.roles", function ($q) {
            $q->where("name", "daughter");
        })->get();

        if (request('search')) {
            $query->whereHas('profile.user', function ($q) {
                $q->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('lastname', 'LIKE', '%' . request('search') . '%');
            });
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

        return Inertia::render('Secretary/Changes/Index', [
            'allProvinces' => $provinces,
            'transfers' => $query
                ->paginate(10)
                ->appends(request()->query()),
            'filters' => request()->all(['date', 'search', 'status', 'dateStart', 'dateEnd']),

        ]);
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
    public function show($user_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
        ], [
            'user_id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $user = User::find($user_id);
        $transfer = $user->profile->transfers->where('status', 1)->first();

        if ($transfer) {
            return   $transfer->community->comm_name;
        }
        return null;
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

    public function printAllTransfers()
    {
        $query = Transfer::query();

        $transfers = Transfer::all();

        $query->with('profile.user')
            ->with('community')
            ->orderBy('transfer_date_adission', 'desc')
            ->get();

        $query->whereHas("profile.user.roles", function ($q) {
            $q->where("name", "daughter");
        })->get();

        if (request('search')) {
            $query->whereHas('profile.user', function ($q) {
                $q->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('lastname', 'LIKE', '%' . request('search') . '%');
            });
        }

        if (request('status')) {
            if (request('status') == 1) {
                $query->where('status', 1);
            } else if (request('status') == 2) {
                $query->where('status', 0);
            }
        }

        $dateFromTo = new TransferGlobalController();

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
                $dateFromTo->setFrom(request('dateStart'));
                $dateFromTo->setTo(request('dateEnd'));
            }
        }

        $addressClass = new AddressController();

        $provinces =  $addressClass->getProvinces();

        $data = $query
            ->get();

        $from =   $dateFromTo->getFrom();

        $to =  $dateFromTo->getTo();

        $type = request('status');

        if (count($data) >= 300) {
            return redirect()->back()->with([
                'error' => 'Los cambios superan los 300 registros, intente en formato EXCEL.'
            ]);
        }

        $pdf = PDF::loadView('reports.transfers.list-transfers', compact('data', 'from', 'to', 'type'));

        return $pdf->setPaper('a4', 'landscape')->stream('ReportesCambiosHermanas.pdf');
    }


    //  TODO: Export Excel

    public function exportExcel()
    {
        return Excel::download(new TransfersExport(request()), 'TransferenciasHDLC.xlsx');
    }

    //  TODO: Export CSV

    public function exportCSV()
    {
        return Excel::download(new TransfersExport(request()), 'TransferenciasHDLC.csv');
    }
}

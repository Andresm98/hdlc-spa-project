<?php

namespace App\Http\Controllers\Secretary\Community\Visits;

use PDF;
use Inertia\Inertia;

use App\Models\Visit;
use App\Models\Community;
use App\Exports\VisitExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\DB;

class VisitGlobalController extends Controller
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
        request()->validate([
            'dateStart' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'community' => ['nullable', 'integer', 'exists:communities,id'],
        ]);

        $query = Visit::query();

        if (request('search')) {
            $query->whereHas('community', function ($q) {
                $q->where('comm_reason_visit', 'LIKE', '%' . request('search') . '%');
            });
        }

        if (request('community')) {
            $query->where('community_id', request('community'));
        }

        if (request('status')) {
            if (request('status') == 1) {
                $query->where('comm_type_visit',  1);
            } else if (request('status') == 2) {
                $query->where('comm_type_visit', 2);
            } else if (request('status') == 3) {
                $query->where('comm_type_visit', 3);
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
                $query->whereBetween('comm_date_init_visit', [request('dateStart'), request('dateEnd')]);
                $query->orderBy('comm_date_init_visit', 'desc');
            }
        }
        $addressClass = new AddressController();
        $provinces =  $addressClass->getProvinces();

        $query->with('community')
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render('Secretary/VisitsGlobal/Index', [
            'allProvinces' => $provinces,
            'communities' => Community::all(),
            'visits' => $query
                ->paginate(10)
                ->appends(request()->query()),
            'filters' => request()->all(['date', 'search', 'community', 'status', 'dateStart', 'dateEnd']),
        ]);
    }


    public function search()
    {
        $validator = Validator::make(['search' => request('search')], [
            'search' => ['nullable', 'string', 'max:200'],
        ]);

        if ($validator->fails()) {
            return [];
        }

        $query = Community::query();

        if (request('search')) {
            return $query->where('comm_name', 'LIKE', '%' . request('search') . '%')->get();
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
    public function show($user_id) {}

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

    public function printAllVisits()
    {
        request()->validate([
            'dateStart' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'community' => ['nullable', 'integer', 'exists:communities,id'],
        ]);

        $query = Visit::query();

        if (request('search')) {
            $query->whereHas('community', function ($q) {
                $q->where('comm_reason_visit', 'LIKE', '%' . request('search') . '%');
            });
        }

        if (request('community')) {
            $query->where('community_id', request('community'));
        }

        if (request('status')) {
            if (request('status') == 1) {
                $query->where('comm_type_visit',  1);
            } else if (request('status') == 2) {
                $query->where('comm_type_visit', 2);
            } else if (request('status') == 3) {
                $query->where('comm_type_visit', 3);
            }
        }

        $dateFromTo = new VisitGlobalController();

        if (request('dateStart') || request('dateEnd')) {
            $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors());
            } else {
                $query->whereBetween('comm_date_init_visit', [request('dateStart'), request('dateEnd')]);
                $query->orderBy('comm_date_init_visit', 'desc');
                $dateFromTo->setFrom(request('dateStart'));
                $dateFromTo->setTo(request('dateEnd'));
            }
        }

        $data = $query
            ->with('community')
            ->get();

        $from = $dateFromTo->getFrom();

        $to = $dateFromTo->getTo();

        $type = request('status');

        $dataVisit = array();

        $queryCommunity = Community::query();

        $dataCommunity = $queryCommunity
            ->with('address')
            ->where('comm_level', 1)
            ->where('comm_status', 1)
            ->get();

        foreach ($dataCommunity as $comm) {

            $dataVisitPerYear = array();

            $listYears = array();

            $year = date("Y");

            for ($i = 0; $i < 10; $i++) {

                array_push($listYears, $year);

                //to get start date of previous year
                $firstDay =  date($year . "-m-d 00:00:00", strtotime("last year January 1st"));

                //to get end date of previous year
                $lastDay = date($year . "-m-d 00:00:00", strtotime("last year December 31st"));

                if (request('status')) {
                    $listVisits = Visit::where('community_id', $comm->id)
                        ->where('comm_type_visit', request('status'))
                        ->whereBetween('comm_date_init_visit', [$firstDay, $lastDay])
                        ->orderBy('comm_date_init_visit', 'asc')
                        ->get();
                } else {
                    $listVisits = Visit::where('community_id', $comm->id)
                        ->whereBetween('comm_type_visit', [2, 3])
                        ->whereBetween('comm_date_init_visit', [$firstDay, $lastDay])
                        ->orderBy('comm_date_init_visit', 'asc')
                        ->get();
                }

                array_push(
                    $dataVisitPerYear,
                    $listVisits
                );

                $year = $this->restYear($year);
            }

            $lastPastoralVisit = Visit::where('community_id', $comm->id)
                ->where('comm_type_visit', 3)
                ->orderBy('comm_date_init_visit', 'desc')
                ->first();

            array_push($dataVisit, (object)[
                'community' => $comm,
                'parish' => $comm->address->parish->name,
                'dataVisitPerYear' => array_reverse($dataVisitPerYear),
                'lastPastoralVisit' => $lastPastoralVisit
            ]);
        }

        usort($dataVisit, function ($a, $b) {
            return strcmp($a->parish, $b->parish);
        });

        $data = $dataVisit;

        $listYears = array_reverse($listYears);

        $pdf = PDF::loadView('reports.communities.visits.list-visits', compact('data', 'from', 'to', 'type', 'listYears'));

        return $pdf->setPaper('a4', 'landscape')->stream('ReportesVisitasHDLC.pdf');
    }

    public function restYear($year)
    {
        return $year - 1;
    }

    public function exportExcel()
    {
        return Excel::download(new VisitExport(request()), 'ReportesVisitasHDLC.xlsx');
    }

    //  TODO: Export CSV

    public function exportCSV()
    {
        return Excel::download(new VisitExport(request()), 'ReportesVisitasHDLC.csv');
    }
}

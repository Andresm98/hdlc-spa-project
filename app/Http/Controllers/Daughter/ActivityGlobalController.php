<?php

namespace App\Http\Controllers\Daughter;

use PDF;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Activity;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Exports\ActivityExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;

class ActivityGlobalController extends Controller
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
    public function index(Request $request)
    {
        $authUser = auth()->user();

        $checking = $this->proveNewVerified();

        if ($checking) {
            return abort(404);
        }

        $daughter = User::find($authUser->id);

        $daughter->profile;

        if ($daughter->profile) {
            // Visitadora, Secretaria Provincial, Hermana Sirvientel, Secretaria Local, Rectora  o Vicerrectora
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

                    request()->validate([
                        'dateStart' => ['nullable', 'date_format:Y-m-d H:i:s'],
                        'community' => ['nullable', 'integer', 'exists:communities,id'],
                    ]);
                    $request->merge([
                        'community' =>  $communityId,
                    ]);

                    $query = Activity::query();
                    $query->where('community_id',  request('community'));

                    if (request('search')) {
                        $query->whereHas('community', function ($q) {
                            $q->where('comm_name_activity', 'LIKE', '%' . request('search') . '%');
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
                            $query->whereBetween('comm_date_activity', [request('dateStart'), request('dateEnd')]);
                            $query->orderBy('comm_date_activity', 'desc');
                        }
                    }
                    $addressClass = new AddressController();
                    $provinces =  $addressClass->getProvinces();

                    $query->with('community')
                        ->orderBy('comm_date_activity', 'desc')
                        ->get();

                    return Inertia::render('Daughter/ActivitiesGlobal/Index', [
                        'allProvinces' => $provinces,
                        'communities' => Community::find($communityId),
                        'activities' => $query
                            ->paginate(10)
                            ->appends(request()->query()),
                        'filters' => request()->all(['date', 'search', 'community', 'status', 'dateStart', 'dateEnd']),
                    ]);
                }
            } else {
                return abort(404);
            }
        }
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
    public function show($user_id)
    {
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

    public function printAllActivities()
    {
        request()->validate([
            'dateStart' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'community' => ['nullable', 'integer', 'exists:communities,id'],
        ]);

        $query = Activity::query();


        if (request('search')) {
            $query->whereHas('community', function ($q) {
                $q->where('comm_name_activity', 'LIKE', '%' . request('search') . '%');
            });
        }

        if (request('status')) {
            if (request('status') == 1) {
                $query->where('status', 1);
            } else if (request('status') == 2) {
                $query->where('status', 0);
            }
        }
        if (request('community')) {
            $query->where('community_id', request('community'));
        }


        $dateFromTo = new ActivityGlobalController();
        if (request('dateStart') || request('dateEnd')) {
            $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors());
            } else {
                $query->whereBetween('comm_date_activity', [request('dateStart'), request('dateEnd')]);
                $query->orderBy('comm_date_activity', 'desc');
                $dateFromTo->setFrom(request('dateStart'));
                $dateFromTo->setTo(request('dateEnd'));
            }
        }

        $data = $query
            ->with('community')
            ->get();

        $from =   $dateFromTo->getFrom();
        $to =  $dateFromTo->getTo();
        $type = request('status');

        $pdf = PDF::loadView('reports.communities.activities.list-activities', compact('data', 'from', 'to', 'type'));
        return $pdf->setPaper('a4', 'landscape')->stream('ReportesActividadesHDLC.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new ActivityExport(request()), 'ReportesActividadesHDLC.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new ActivityExport(request()), 'ReportesActividadesHDLC.csv');
    }
}

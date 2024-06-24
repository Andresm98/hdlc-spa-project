<?php

namespace App\Http\Controllers\Secretary\Appointments;

use PDF;
use Inertia\Inertia;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\AppointmentLevel;
use App\Exports\AppointmentsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class AppointmentGlobalController extends Controller
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
        $query = Appointment::query();

        $query->with('profile.user')
            ->with('appointment_level')
            ->with('community')
            ->with('transfer')
            ->orderBy('date_appointment', 'desc')
            ->get();

        if (request('search')) {
            $query->whereHas('profile.user', function ($q) {
                $q->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('lastname', 'LIKE', '%' . request('search') . '%');
            });
        }
        if (request('type')) {
            $query->whereHas('appointment_level', function ($q) {
                $q->where('appointment_levelc_id', request('type'));
            });
        }

        if (request('status')) {
            if (request('status') == 1) {
                $query->where('status',  1);
            } else if (request('status') == 2) {
                $query->where('status', 0);
            }
        }

        if (request('level')) {
            $query->whereHas('appointment_level', function ($q) {
                $q->where('id', request('level'));
            });
        }

        if (request('dateStart') || request('dateEnd')) {
            $validatorData = Validator::make(['dateStart' => request('dateStart'), 'dateEnd' => request('dateEnd')], [
                'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($validatorData->fails()) {
                $query->orderBy('date_appointment', 'desc');
                return redirect()->back()
                    ->withErrors($validatorData->errors());
            } else {
                $query->whereBetween('date_appointment', [request('dateStart'), request('dateEnd')]);
                $query->orderBy('date_appointment', 'desc');
            }
        }

        $categories = AppointmentLevel::where('level', 1)
            ->get();

        $levels = AppointmentLevel::where('level', 2)
            ->where('appointment_levelc_id', request('type'))
            ->get();

        return Inertia::render('Secretary/Appointments/Index', [
            'appointments' => $query
                ->paginate(10)
                ->appends(request()->query()),
            'filters' => request()->all(['date', 'type', 'search', 'status', 'level', 'dateStart', 'dateEnd']),
            'levels' => $levels,
            'categories' => $categories,
        ]);
    }

    public function terminateServant()
    {
        $query = Appointment::query();

        $query->where('status', 1);

        $daughterServant = AppointmentLevel::where('level', 2)
            ->where('name', 'LIKE', '%Sirviente%')
            ->first();

        $query->whereHas('appointment_level', function ($q) use ($daughterServant) {
            $q->where('id', $daughterServant->id);
        });

        $start = date('Y-m-d H:i:s', strtotime('-3 years'));

        $end = date('Y-m-d H:i:s', strtotime('-3 years +3 months'));

        $query->whereBetween('date_appointment', [$start, $end]);

        return response()->json([
            'counter' => count($query->get()),
            'start' => $start,
            'end' => $end
        ]);
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
    public function destroy($appointment_id)
    {
        $validator = Validator::make([
            'appointment_id' => $appointment_id
        ], [
            'appointment_id' => ['required', 'exists:appointments,id']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'No existen los datos']);
        }

        $appointment = Appointment::find($appointment_id);
        $appointment->delete();
        return redirect()->back()->with(['success' => 'Nombramiento eliminado correctamente!!']);
    }

    public function exportPDF()
    {
        $query = Appointment::query();

        $query->with('profile.user')
            ->with('appointment_level')
            ->with('community.address')
            ->with('transfer')
            ->orderBy('date_appointment', 'desc')
            ->get();

        if (request('search')) {
            $query->whereHas('profile.user', function ($q) {
                $q->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('lastname', 'LIKE', '%' . request('search') . '%');
            });
        }
        if (request('type')) {
            $query->whereHas('appointment_level', function ($q) {
                $q->where('appointment_levelc_id', request('type'));
            });
        }

        if (request('status')) {
            if (request('status') == 1) {
                $query->where('status',  1);
            } else if (request('status') == 2) {
                $query->where('status', 0);
            }
        }

        $dateFromTo = new AppointmentGlobalController();

        if (request('dateStart') || request('dateEnd')) {
            $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($validatorData->fails()) {
                $query->orderBy('date_appointment', 'desc');
                return redirect()->back()
                    ->withErrors($validatorData->errors());
            } else {
                $query->whereBetween('date_appointment', [request('dateStart'), request('dateEnd')]);
                $query->orderBy('date_appointment', 'desc');
                $dateFromTo->setFrom(request('dateStart'));
                $dateFromTo->setTo(request('dateEnd'));
            }
        }

        if (request('level')) {
            $query->whereHas('appointment_level', function ($q) {
                $q->where('id', request('level'));
            });
        }

        $level = AppointmentLevel::where('id', request('level'))->get()->first();

        $data = $query->get();

        $from =   $dateFromTo->getFrom();

        $to =  $dateFromTo->getTo();

        $type = request('status');

        if ((int)request('level') === 10 && (int)request('status') === 1) {

            $dataServant = array();

            foreach ($data as $key => $appointment) {

                $lastAppointment = Appointment::select('date_appointment')
                    ->where('appointment_level_id', 10)
                    ->where('date_appointment', '<=', $appointment->date_appointment)
                    ->where('profile_id', $appointment->profile_id)
                    ->where('community_id', $appointment->community_id)
                    ->orderBy('date_appointment', 'asc')
                    ->take(4)
                    ->get();

                array_push($dataServant,  (object)[
                    'appsubjet' => $appointment,
                    'id' => $appointment['profile']->user->id,
                    'community' => $appointment['community'],
                    'lastname' => $appointment['profile']->user->lastname,
                    'name' => $appointment['profile']->user->name,
                    'date_birth' => $appointment['profile']->date_birth,
                    'date_vocation' => $appointment['profile']->date_vocation,
                    'presentation_thr' =>   $lastAppointment->get(0),
                    'first_thr' =>   $lastAppointment->get(1),
                    'second_thr' =>   $lastAppointment->get(2),
                    'parish' => $appointment['community']->address->parish->name,
                ]);
            }

            usort($dataServant, function ($a, $b) {
                return strcmp($a->parish, $b->parish);
            });

            $pdf = PDF::loadView('reports.appointments.list-appointments-servant', compact('dataServant', 'from', 'to', 'type', 'level'));

            return $pdf->setPaper('a4', 'landscape')->stream('ReportesNombramientosHermanas.pdf');
        }

        $dataServant = array();

        foreach ($data as $key => $appointment) {
            array_push($dataServant,  (object)[
                'appsubjet' => $appointment,
                'parish' => $appointment['community']->address->parish->name,
            ]);
        }

        usort($dataServant, function ($a, $b) {
            return strcmp($a->parish, $b->parish);
        });

        $pdf = PDF::loadView('reports.appointments.list-appointments', compact('dataServant', 'from', 'to', 'type', 'level'));

        return $pdf->setPaper('a4', 'landscape')->stream('ReportesNombramientosHermanas.pdf');
    }


    //  TODO: Export Excel

    public function exportExcel()
    {
        return Excel::download(new AppointmentsExport(request()), 'NombramientosHDLC.xlsx');
    }

    //  TODO: Export CSV

    public function exportCSV()
    {
        return Excel::download(new AppointmentsExport(request()), 'NombramientosHDLC.csv');
    }
}

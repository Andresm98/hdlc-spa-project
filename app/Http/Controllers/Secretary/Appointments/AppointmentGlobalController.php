<?php

namespace App\Http\Controllers\Secretary\Appointments;

use Inertia\Inertia;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\AppointmentLevel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AppointmentGlobalController extends Controller
{
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
        //  Data
        $levels = AppointmentLevel::where('level', 2)->get();
        $categories = AppointmentLevel::where('level', 1)->get();

        return Inertia::render('Secretary/Appointments/Index', [
            'appointments' => $query
                ->paginate(10)
                ->appends(request()->query()),
            'filters' => request()->all(['date', 'type', 'search', 'status', 'level', 'dateStart', 'dateEnd']),
            'levels' => $levels,
            'categories' => $categories,
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
}

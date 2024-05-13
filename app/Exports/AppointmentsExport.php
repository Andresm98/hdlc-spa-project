<?php

namespace App\Exports;

use App\Models\Appointment;
use App\Models\AppointmentLevel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Secretary\Appointments\AppointmentGlobalController;

class AppointmentsExport implements FromView
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

    public function view(): View
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

        //  Data
        $level = AppointmentLevel::where('id', request('level'))->get()->first();

        $data = $query
            ->get();

        $from =   $dateFromTo->getFrom();
        $to =  $dateFromTo->getTo();
        $type = request('status');

        return view('exports.appointments.list-appointments', compact('data'));
    }
}

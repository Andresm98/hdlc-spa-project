<?php

namespace App\Exports;

use App\Models\Events;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Secretary\Events\EventController;

class EventsExport implements FromView
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
        $validator = Validator::make(request()->all(), [
            'date.month' =>  ['integer', 'between:0,11'],
            'date.year' =>  ['integer', 'between:1000,200000'],
            'type' => ['integer', 'between:1,4']
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'No se encuentran resultados.']);
        }

        $query = Events::query();
        $dateFromTo = new EventController();

        if (request('date')) {
            $year = request('date')['year'];
            $month =  request('date')['month'];
            $sendMonth = (int) $month + 1;

            $codMonthYear = date($year . '-' . (string)$sendMonth . '-01');
            $dateEnd = date("Y-m-t", strtotime($codMonthYear));
            $query->whereBetween('dates', [$codMonthYear, $dateEnd])->get();
            $dateFromTo->setFrom($codMonthYear);
            $dateFromTo->setTo($dateEnd);
        } else {
            $dateInit = date('Y-m-01');
            $dateEnd = date("Y-m-t", strtotime($dateInit));
            $query->whereBetween('dates', [$dateInit, $dateEnd])->get();
            $dateFromTo->setFrom($dateInit);
            $dateFromTo->setTo($dateEnd);
        }

        if (request('type')) {
            $query->where('type', '=', request('type'));
        }
        if (request('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%');
        }

        $query->orderBy('dates', 'asc');

        $from =   $dateFromTo->getFrom();
        $to =  $dateFromTo->getTo();
        $type = request('type');
        $data = $query->get();

        return view('exports.events.list-custom', compact('data'));
    }
}

<?php

namespace App\Exports;

use App\Models\Activity;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Secretary\Community\Activities\ActivityGlobalController;


class ActivityExport implements FromView
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

        return view('exports.communities.activities.list-activities', compact('data'));
    }
}

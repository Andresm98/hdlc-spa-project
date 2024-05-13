<?php

namespace App\Exports;

use App\Models\Visit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Secretary\Community\Vehicles\VehicleGlobalController;
use App\Models\Vehicle;

class VehicleExport implements FromView
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

        $query = Vehicle::query();

        if (request('search')) {
            $query->whereHas('community', function ($q) {
                $q->where('brand', 'LIKE', '%' . request('search') . '%');
            });
        }

        if (request('community')) {
            $query->where('community_id', request('community'));
        }

        $dateFromTo = new VehicleGlobalController();
        if (request('dateStart') || request('dateEnd')) {
            $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors());
            } else {
                $query->whereBetween('year', [request('dateStart'), request('dateEnd')]);
                $query->orderBy('year', 'desc');
            }
        }

        $data = $query
            ->with('community')
            ->get();

        $from =   $dateFromTo->getFrom();
        $to =  $dateFromTo->getTo();
        $type = request('status');

        return view('exports.communities.vehicles.list-vehicles', compact('data'));
    }
}

<?php

namespace App\Exports;


use App\Models\Permit;
use App\Models\Transfer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Secretary\Transfer\TransferGlobalController;

class TransfersExport implements FromView
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


        return view('exports.transfers.list-transfers', compact('data'));
    }
}

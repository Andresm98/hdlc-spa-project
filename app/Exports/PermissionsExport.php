<?php

namespace App\Exports;


use App\Models\Permit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Secretary\Permissions\PermissionGlobalController;

class PermissionsExport implements FromView
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
        $query = Permit::query();

        $query->with('profile.user')
            ->orderBy('date_out', 'desc')
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

        $dateFromTo = new PermissionGlobalController();
        if (request('dateStart')) {
            $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors());
            } else {
                $query->whereBetween('date_out', [request('dateStart'), request('dateEnd')]);
                $query->orderBy('date_out', 'desc');
                $dateFromTo->setFrom(request('dateStart'));
                $dateFromTo->setTo(request('dateEnd'));
            }
        }
        $addressClass = new AddressController();
        $provinces =  $addressClass->getProvinces();

        $data = $query
            ->with('address')
            ->get();

        $from =   $dateFromTo->getFrom();
        $to =  $dateFromTo->getTo();
        $type = request('status');

        return view('exports.permissions.list-permissions', compact('data'));
    }
}

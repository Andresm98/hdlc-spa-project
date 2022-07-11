<?php

namespace App\Exports;

use App\Models\Address;
use App\Models\Pastoral;
use App\Models\Community;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Secretary\Community\CommunityController;


class CommunityExport implements FromView
{
    protected $from; // public, protected <-> private
    protected $to;
    protected $pastoral;

    public function __construct()
    {
        $this->from;
        $this->to;
        $this->pastoral;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getPastoral()
    {
        return $this->pastoral;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function setPastoral($pastoral)
    {
        $this->pastoral = $pastoral;
    }

    public function view(): View
    {
        $validator = Validator::make(request()->all(), [
            'direction' => ['in:asc,desc'],
            'field' => ['in:comm_name,comm_email,pastoral_id'],
            'active' =>  ['integer', 'between:1,2'],
            'type' =>  ['integer', 'between:1,2'],
            'pastoral' =>  ['integer', 'exists:pastorals,id'],
            'dateStart' => ['date_format:Y-m-d H:i:s'],
            'perPage' =>  ['integer'],
        ]);
        $dateFromTo = new CommunityController();
        $addressClass = new AddressController();
        $provinces =  $addressClass->getProvinces();

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'No se encuentran resultados.']);
        }

        $query = Community::query();

        if (request('search')) {
            $query->where('comm_name', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        if (request('pastoral')) {
            $dateFromTo->setPastoral(Pastoral::find(request('pastoral')));
            $query->where('pastoral_id', '=', request('pastoral'));
        }

        if (request('active')) {
            if (request('active') == 2) {
                if (request('dateStart') || request('dateEnd')) {
                    $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                        'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                        'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                    ]);
                    if ($validatorData->fails()) {
                        $query->orderBy('date_close', 'desc');
                        return redirect()->back()
                            ->withErrors($validatorData->errors());
                    } else {
                        $dateFromTo->setFrom(request('dateStart'));
                        $dateFromTo->setTo(request('dateEnd'));
                        $query->whereBetween('date_close', [request('dateStart'), request('dateEnd')]);
                        $query->orderBy('date_close', 'desc');
                    }
                }
                $query->where('comm_status', '=', 0);
            } else {
                if (request('dateStart') || request('dateEnd')) {
                    $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                        'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                        'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                    ]);
                    if ($validatorData->fails()) {
                        $query->orderBy('date_fndt_comm', 'desc');
                        return redirect()->back()
                            ->withErrors($validatorData->errors());
                    } else {
                        $dateFromTo->setFrom(request('dateStart'));
                        $dateFromTo->setTo(request('dateEnd'));
                        $query->whereBetween('date_fndt_comm', [request('dateStart'), request('dateEnd')]);
                        $query->orderBy('date_fndt_comm', 'desc');
                    }
                }
                $query->where('comm_status', '=', request('active'));
            }
        }

        if (request('type')) {
            $query->where('comm_level', request('type'));
        }

        if (request('perProvince')) {
            $address = Address::whereHasMorph(
                'addressable',
                [Community::class],
                function (Builder $query) {
                    return   $query->where('political_division_id', 'LIKE', request('perProvince') . '%');
                }
            )->get();

            $index = array();
            foreach ($address as $ob) {
                $ob->addressable_id;
                $index[] = $ob->addressable_id;
            }
            $query->whereIn('id', $index);
        }

        $data = $query
            ->with('pastoral')
            ->with('zone')
            ->with('address')
            ->get();

        $from =   $dateFromTo->getFrom();
        $to =  $dateFromTo->getTo();
        $pastoral =  $dateFromTo->getPastoral();

        $status =  $type = request('active');
        if (request('printOperation') == 1) {
            return view('exports.communities.list-custom', compact('data'));
        } elseif (request('printOperation') == 0) {
            return view('exports.communities.list-general', compact('data'));
        }
    }
}

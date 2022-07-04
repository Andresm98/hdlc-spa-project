<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Address;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;

class UsersExport implements FromView
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
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email'],
            'dateStart' => ['date_format:Y-m-d H:i:s'],
        ]);

        $addressClass = new AddressController();
        $provinces =  $addressClass->getProvinces();

        $query = User::query();

        if (request('search')) {
            $search = request('search');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
                $query->orWhere('lastname', 'LIKE', '%' . $search . '%');
            });
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        if (request('pastoral')) {
            $query->whereHas("profile", function ($q) {
                $q->whereHas("transfers", function ($qtransfer) {
                    $qtransfer->where("transfer_date_relocated", null)
                        ->whereHas("community", function ($qtransfer) {
                            $qtransfer->where("pastoral_id", request('pastoral'));
                        });
                });
            });
        }


        if (request('perProvince')) {
            $query->whereHas("profile", function ($q) {
                $address = Address::whereHasMorph(
                    'addressable',
                    [Profile::class],
                    function (Builder $query) {
                        return   $query->where('political_division_id', 'LIKE', request('perProvince') . '%');
                    }
                )->get();

                $index = array();
                foreach ($address as $ob) {
                    $ob->addressable_id;
                    $index[] = $ob->addressable_id;
                }
                $q->whereIn('id', $index);
            });
        }

        $query->whereHas("roles", function ($q) {
            $q->where("name", "daughter");
        })->get();


        if (request('status')) {
            $dateFromTo = new UsersExport();
            $query->whereHas("profile", function ($q) use ($dateFromTo) {
                if (request('dateStart')) {
                    $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                        'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                        'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                    ]);
                    if ($validatorData->fails()) {
                        $q->where("status", request('status'));
                        return redirect()->back()
                            ->withErrors($validatorData->errors());
                    } else {
                        if (request('status') == 1) {
                            if (request('typeActive')) {
                                if (request('typeActive') == 1) {
                                    $q->where("date_birth", '!=', null)
                                        ->where("date_vocation", '!=', null)
                                        ->where("date_admission", '!=', null)
                                        ->where("date_send", null)
                                        ->where("date_vote", null);
                                }
                                if (request('typeActive') == 2) {
                                    $q->where("date_birth", '!=', null)
                                        ->where("date_vocation", '!=', null)
                                        ->where("date_admission", '!=', null)
                                        ->where("date_send", '!=', null)
                                        ->where("date_vote", null);
                                }
                                if (request('typeActive') == 3) {
                                    $q->where("date_birth", '!=', null)
                                        ->where("date_vocation", '!=', null)
                                        ->where("date_admission", '!=', null)
                                        ->where("date_send", '!=', null)
                                        ->where("date_vote",  '!=', null);
                                }
                            }
                            $q->whereBetween('date_admission', [request('dateStart'), request('dateEnd')]);
                            $q->orderBy('date_admission', 'desc');
                        }
                        if (request('status') == 2) {
                            $q->whereBetween('date_death', [request('dateStart'), request('dateEnd')]);
                            $q->orderBy('date_death', 'desc');
                        }
                        if (request('status') == 3) {
                            $q->whereBetween('date_exit', [request('dateStart'), request('dateEnd')]);
                            $q->orderBy('date_exit', 'desc');
                        }
                        $dateFromTo->setFrom(request('dateStart'));
                        $dateFromTo->setTo(request('dateEnd'));
                    }
                }
                if (request('status') == 1) {
                    if (request('typeActive')) {
                        if (request('typeActive') == 1) {
                            $q->where("date_birth", '!=', null)
                                ->where("date_vocation", '!=', null)
                                ->where("date_admission", '!=', null)
                                ->where("date_send", null)
                                ->where("date_vote", null);
                        }
                        if (request('typeActive') == 2) {
                            $q->where("date_birth", '!=', null)
                                ->where("date_vocation", '!=', null)
                                ->where("date_admission", '!=', null)
                                ->where("date_send", '!=', null)
                                ->where("date_vote", null);
                        }
                        if (request('typeActive') == 3) {
                            $q->where("date_birth", '!=', null)
                                ->where("date_vocation", '!=', null)
                                ->where("date_admission", '!=', null)
                                ->where("date_send", '!=', null)
                                ->where("date_vote",  '!=', null);
                        }
                    }
                    $q->where("status", request('status'))->orderBy('date_admission', 'desc');
                }
                if (request('status') == 2) {
                    $q->where("status", request('status'))->orderBy('date_death', 'desc');
                }
                if (request('status') == 3) {
                    $q->where("status", request('status'))->orderBy('date_exit', 'desc');
                }
            });


            $from =   $dateFromTo->getFrom();
            $to =  $dateFromTo->getTo();
            if (request('status') == 1) {
                $data = $query
                    ->with('profile')
                    ->with('profile.transfers.community')
                    ->get();
                $type = request('typeActive');

                return view('exports.daughters.list-active', compact('data', 'from', 'to', 'type'));
            }
            if (request('status') == 2) {
                $data = $query
                    ->with('profile')
                    ->with('profile.transfers.community')
                    ->get();

                return view('exports.daughters.list-dead',  compact('data', 'from', 'to'));
            }
            if (request('status') == 3) {
                $data = $query
                    ->with('profile')
                    ->with('profile.transfers.community')
                    ->get();

                return view('exports.daughters.list-retired', compact('data', 'from', 'to'));
            }
        }

        $data = $query
            ->with('profile')
            ->get();

        return view('exports.daughters.list-general', compact('data'));
    }
}

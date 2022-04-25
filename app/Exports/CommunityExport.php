<?php

namespace App\Exports;

use App\Models\Address;
use App\Models\Community;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Http\Controllers\AddressController;
use Illuminate\Database\Eloquent\Builder;


class CommunityExport implements FromQuery
{
    use Exportable;

    public function query()
    {
        $validator = Validator::make(request()->all(), [
            'direction' => ['in:asc,desc'],
            'field' => ['in:comm_name,comm_email,pastoral_id'],
            'active' =>  ['integer', 'between:1,2'],
            'pastoral' =>  ['integer', 'exists:pastorals,id'],
            'dateStart' => ['date_format:Y-m-d H:i:s'],
            'perPage' =>  ['integer'],
        ]);

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
            $query->where('pastoral_id', '=', request('pastoral'));
        }

        if (request('dateStart')) {
            $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($validatorData->fails()) {
                $query->orderBy('date_fndt_comm', 'desc');
                return redirect()->back()
                    ->withErrors($validatorData->errors());
            } else {
                $query->whereBetween('date_fndt_comm', [request('dateStart'), request('dateEnd')]);
                $query->orderBy('date_fndt_comm', 'desc');
            }
        }

        if (request('active')) {
            if (request('active') == 2) {
                $query->where('comm_status', '=', 0);
            } else {
                $query->where('comm_status', '=', request('active'));
            }
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

        return $query->where('comm_level', '=', 1);
    }
}

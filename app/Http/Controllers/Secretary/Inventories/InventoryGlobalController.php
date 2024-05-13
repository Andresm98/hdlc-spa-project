<?php

namespace App\Http\Controllers\Secretary\Inventories;

use Inertia\Inertia;
use App\Models\Address;
use App\Models\Pastoral;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;
use Illuminate\Database\Eloquent\Builder;

class InventoryGlobalController extends Controller
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $pastorals = Pastoral::all();

        return Inertia::render('Secretary/InventoryGlobal/Index', [
            'provinces' => $provinces,
            'communities_list' => $query
                ->with('pastoral')
                ->with('address')
                ->paginate(request('perPage'))
                ->appends(request()->query()),
            'pastorals' => $pastorals,
            'filters' => request()->all(['search', 'field', 'direction', 'page', 'active', 'type', 'pastoral', 'dateStart', 'dateEnd', 'perProvince', 'perPage'])
        ]);
    }


    public function getInventory($community_id)
    {
        $validation = Validator::make(['id' => $community_id],   [
            'id' => ['required', 'exists:communities,id']
        ]);


        if ($validation->fails()) {
            return response()->json([
                'error' => 'El dato no existe'
            ]);
        }

        $community = Community::find($community_id);

        return Inertia::render('Secretary/InventoryGlobal/Component', [
            'datac' =>        $community,
            'community' =>  $community->inventory,
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
    public function destroy($id)
    {
        //
    }
}

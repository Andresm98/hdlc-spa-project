<?php

namespace App\Http\Controllers\Secretary\Community\Files;

use App\Models\File;
use Inertia\Inertia;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;

class FileCommGlobalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $query = File::query();

        $query->where('fileable_type', 'App\Models\Community');

        if (request('search')) {
            $query->where('external_filename', 'LIKE', '%' . request('search') . '%');
        }

        if (request('community')) {
            $query->where('fileable_id', request('community')['id'])
                ->where('fileable_type', 'App\Models\Community');
        }


        if (request('dateStart') || request('dateEnd')) {
            $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors());
            } else {
                $query->whereBetween('created_at', [request('dateStart'), request('dateEnd')]);
                $query->orderBy('created_at', 'desc');
            }
        }
        $addressClass = new AddressController();
        $provinces =  $addressClass->getProvinces();

        return Inertia::render('Secretary/FilesCommGlobal/Index', [
            'allProvinces' => $provinces,
            'files_list' => $query
                ->with('fileable')
                ->paginate(10)
                ->appends(request()->query()),
            'filters' => request()->all(['date', 'search', 'status', 'dateStart', 'dateEnd', 'community']),

        ]);
    }

    public function search()
    {
        $validator = Validator::make(['search' => request('search')], [
            'search' => ['nullable', 'string', 'max:60'],
        ]);

        if ($validator->fails()) {
            return [];
        }

        $query = Community::query();

        if (request('search')) {
            $search = request('search');

            $query->where('comm_name', 'LIKE', '%' . $search . '%');

            return $query
                ->get(['comm_name', 'id']);
        }
        return [];
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

<?php

namespace App\Http\Controllers\Secretary\Files;

use App\Models\File;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;

class FileGlobalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $query = File::query();

        $query->where('fileable_type', 'App\Models\Profile');

        if (request('search')) {
            $query->where('external_filename', 'LIKE', '%' . request('search') . '%');
        }

        if (request('profile')) {
            $user = request('profile');
            $user = User::find($user['id']);
            $query->where('fileable_id', $user->profile->id)
                ->where('fileable_type', 'App\Models\Profile');
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

        return Inertia::render('Secretary/Files/Index', [
            'allProvinces' => $provinces,
            'files_list' => $query
                ->with('fileable.user')
                ->paginate(10)
                ->appends(request()->query()),
            'filters' => request()->all(['date', 'search', 'status', 'dateStart', 'dateEnd', 'profile']),

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

        $query = User::query();

        $query->whereHas("roles", function ($q) {
            $q->where("name", "daughter");
        })->get();

        if (request('search')) {
            $search = request('search');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
                $query->orWhere('lastname', 'LIKE', '%' . $search . '%');
            });
            return $query
                ->get(['name', 'lastname', 'id', 'fullnamecomm']);
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

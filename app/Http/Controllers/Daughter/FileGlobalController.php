<?php

namespace App\Http\Controllers\Daughter;

use App\Models\File;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;

class FileGlobalController extends Controller
{
    public function index(Request $request)
    {
        $authUser = auth()->user();

        $daughter = User::find($authUser->id);
        $daughter->profile;

        if ($daughter->profile) {

            $transferActive = $daughter->profile->transfers()->where('status', 1)->first();

            if ($transferActive) {

                $appointments = $transferActive->appointments;

                if ($appointments) {

                    $flag = true;
                    foreach ($appointments as $app) {
                        if (
                            $app->appointment_level->id == 4 || $app->appointment_level->id == 7 ||
                            $app->appointment_level->id == 10 || $app->appointment_level->id == 12 ||
                            $app->appointment_level->id == 17 || $app->appointment_level->id == 18
                        ) {
                            $flag = true;
                            break;
                        } else {
                            $flag = false;
                        }
                    }

                    if (!$flag) {
                        return abort(404);
                    }

                    $communityId = $transferActive->community_id;

                    request()->validate([
                        'dateStart' => ['nullable', 'date_format:Y-m-d H:i:s'],
                        'community' => ['nullable', 'integer', 'exists:communities,id'],
                    ]);
                    $request->merge([
                        'community' =>  Community::find($communityId),
                    ]);

                    $query = File::query();

                    $query->where('fileable_id', request('community')['id'])
                        ->where('fileable_type', 'App\Models\Community');

                    if (request('search')) {
                        $query->where('external_filename', 'LIKE', '%' . request('search') . '%');
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

                    return Inertia::render('Daughter/FilesCommGlobal/Index', [
                        'allProvinces' => $provinces,
                        'community' => Community::find($communityId),
                        'files_list' => $query
                            ->with('fileable')
                            ->paginate(10)
                            ->appends(request()->query()),
                        'filters' => request()->all(['date', 'search', 'status', 'dateStart', 'dateEnd', 'community']),

                    ]);
                }
            } else {
                return abort(404);
            }
        }
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

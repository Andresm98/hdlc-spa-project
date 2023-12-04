<?php

namespace App\Http\Controllers\Daughter;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Health;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HealthProfileController extends Controller
{

    /*
    * Prove Verified proveNewVerified
    */

    public static function proveNewVerified()
    {
        $hashedPassword = Auth::user()->getAuthPassword();

        if (Hash::check('secret', $hashedPassword)) {
            return true;
        }

        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = auth()->user();

        $checking = $this->proveNewVerified();

        if ($checking) {
            return abort(404);
        }

        $daughter = User::find($authUser->id);

        $daughter->profile;

        if ($daughter->profile) {
            $query = Health::query();
            $query
                ->where('profile_id', $daughter->profile->id)
                ->orderBy('consult_date', 'desc');

            if (request('dateStart')) {
                $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                    'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                    'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                ]);
                if ($validatorData->fails()) {
                    $query->orderBy('consult_date', 'desc');
                    return redirect()->back()
                        ->withErrors($validatorData->errors());
                } else {
                    $query->whereBetween('consult_date', [request('dateStart'), request('dateEnd')]);
                    $query->orderBy('consult_date', 'desc');
                }
            }

            return Inertia::render(
                'Daughter/Health',
                [
                    'daughter' => $daughter,
                    'health_list' => $query
                        ->paginate(10)
                        ->appends(request()->query()),
                    'filters' => request()->all(['page', 'dateStart', 'dateEnd', 'perPage'])

                ]
            );
        } else {
            return abort(404);
        }
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
    public function store(Request $request, $user_id)
    {
        $validatorData = Validator::make($request->all(), [
            'actual_health' => ['required', 'max:4000'],
            'chronic_diseases' => ['required', 'max:4000'],
            'other_health_problems' => ['required', 'max:4000'],
            'consult_date' => ['required', 'date_format:Y-m-d H:i:s'],
        ]);

        $validator = Validator::make([
            'user_id' => $user_id,
        ], [
            'user_id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $user = User::find($user_id);
        $user->profile->healths()->create([
            'actual_health' => $request->get('actual_health'),
            'chronic_diseases' => $request->get('chronic_diseases'),
            'other_health_problems' => $request->get('other_health_problems'),
            'consult_date' => $request->get('consult_date'),
        ]);

        return redirect()->back()->with([
            'success' => 'Estado de salud guardado correctamente!'
        ]);
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
    public function update(Request $request, $user_id, $health_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
            'health_id' => $health_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'health_id' => ['required', 'exists:healths,id']
        ]);

        $validatorData = Validator::make(
            $request->all(),
            [
                'actual_health' => ['required', 'max:4000'],
                'chronic_diseases' => ['required', 'max:4000'],
                'other_health_problems' => ['required', 'max:4000'],
                'consult_date' => ['required', 'date_format:Y-m-d H:i:s'],
            ]
        );

        if ($validator->fails()) {
            return abort(404);
        }

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $health = Health::find($health_id);

        $health->update([
            'actual_health' => $request->get('actual_health'),
            'chronic_diseases' => $request->get('chronic_diseases'),
            'other_health_problems' => $request->get('other_health_problems'),
            'consult_date' => $request->get('consult_date'),
        ]);

        return redirect()->back()->with(['success' => 'Estado de salud actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $health_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
            'health_id' => $health_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'health_id' => ['required', 'exists:healths,id']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'No existen los datos']);
        }

        $health = Health::find($health_id);
        $health->delete();
        return redirect()->back()->with(['success' => 'Estado de salud eliminado correctamente']);
    }
}

<?php

namespace App\Http\Controllers\Daughter;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Sacrament;
use Illuminate\Http\Request;
use App\Models\AcademicTraining;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SacramentProfileController extends Controller
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
            $query = Sacrament::query();
            $query
                ->where('profile_id', $daughter->profile->id)
                ->orderBy('sacrament_date', 'desc');

            if (request('dateStart')) {
                $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                    'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                    'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                ]);
                if ($validatorData->fails()) {
                    $query->orderBy('sacrament_date', 'desc');
                    return redirect()->back()
                        ->withErrors($validatorData->errors());
                } else {
                    $query->whereBetween('sacrament_date', [request('dateStart'), request('dateEnd')]);
                    $query->orderBy('sacrament_date', 'desc');
                }
            }
            return Inertia::render(
                'Daughter/Sacrament',
                [
                    'daughter' => $daughter,
                    'sacrament_list' => $query
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
            'sacrament_name' => ['required', 'max:100'],
            'sacrament_date' => ['required', 'date_format:Y-m-d H:i:s'],
            'observation' => ['required', 'max:4000'],
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
        $user->profile->sacraments()->create([
            'sacrament_name' => $request->get('sacrament_name'),
            'sacrament_date' => $request->get('sacrament_date'),
            'observation' => $request->get('observation'),
        ]);

        return redirect()->back()->with([
            'success' => 'Sacramento guardado correctamente!'
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
    public function update(Request $request, $user_id, $sacrament_id)
    {

        $validator = Validator::make([
            'user_id' => $user_id,
            'sacrament_id' => $sacrament_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'sacrament_id' => ['required', 'exists:sacraments,id']
        ]);

        $validatorData = Validator::make(
            $request->all(),
            [
                'sacrament_name' => ['required', 'max:100'],
                'sacrament_date' => ['required', 'date_format:Y-m-d H:i:s'],
                'observation' => ['required', 'max:4000'],
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

        $sacrament = Sacrament::find($sacrament_id);

        $sacrament->update([
            'sacrament_name' => $request->get('sacrament_name'),
            'sacrament_date' => $request->get('sacrament_date'),
            'observation' => $request->get('observation'),
        ]);

        return redirect()->back()->with(['success' => 'Sacramento actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $sacrament_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
            'sacrament_id' => $sacrament_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'sacrament_id' => ['required', 'exists:sacraments,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $sacrament = Sacrament::find($sacrament_id);
        $sacrament->delete();
        return redirect()->back()->with(['success' => 'Sacramento eliminado correctamente']);
    }
}

<?php

namespace App\Http\Controllers\Daughter;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\AcademicTraining;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RecordProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = auth()->user();

        $daughter = User::find($authUser->id);
        $daughter->profile;

        if ($daughter->profile) {
            $query = AcademicTraining::query();
            $query
                ->where('profile_id', $daughter->profile->id)
                ->orderBy('date_title', 'desc');

            if (request('dateStart')) {
                $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                    'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                    'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                ]);
                if ($validatorData->fails()) {
                    $query->orderBy('date_title', 'desc');
                    return redirect()->back()
                        ->withErrors($validatorData->errors());
                } else {
                    $query->whereBetween('date_title', [request('dateStart'), request('dateEnd')]);
                    $query->orderBy('date_title', 'desc');
                }
            }
            return Inertia::render(
                'Daughter/Academic',
                [
                    'daughter' => $daughter,
                    'academic_list' => $query
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
        $validator = Validator::make([
            'user_id' => $user_id,
        ], [
            'user_id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $validatorData = Validator::make($request->all(), [
            'name_title' => ['required', 'max:50', 'regex:/^[\pL\s\-]+$/u'],
            'institution' => ['required', 'max:50'],
            'date_title' => ['required', 'date_format:Y-m-d H:i:s'],
            'observation' => ['required', 'max:4000'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $user = User::find($user_id);
        $user->profile->academic_trainings()->create([
            'name_title' => $request->get('name_title'),
            'institution' => $request->get('institution'),
            'date_title' => $request->get('date_title'),
            'observation' => $request->get('observation'),
        ]);

        return redirect()->back()->with([
            'success' => 'Registro académico ingresado correctamente!!'
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
    public function update(Request $request, $user_id, $academic_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
            'academic_id' => $academic_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'academic_id' => ['required', 'exists:academic_trainings,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $validatorData = Validator::make($request->all(), [
            'name_title' => ['required', 'max:50', 'regex:/^[\pL\s\-]+$/u'],
            'institution' => ['required', 'max:50'],
            'date_title' => ['required', 'date_format:Y-m-d H:i:s'],
            'observation' => ['required', 'max:4000'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $academic = AcademicTraining::find($academic_id);
        $academic->update([
            'name_title' => $request->get('name_title'),
            'institution' => $request->get('institution'),
            'date_title' => $request->get('date_title'),
            'observation' => $request->get('observation'),
        ]);
        return redirect()->back()->with(['success' => 'Registro Académico actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $academic_id)
    {
        $validator = Validator::make([
            'user_id' => $user_id,
            'academic_id' => $academic_id
        ], [
            'user_id' => ['required', 'exists:users,id'],
            'academic_id' => ['required', 'exists:academic_trainings,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $academic = AcademicTraining::find($academic_id);
        $academic->delete();
        return redirect()->back()->with(['success' => 'Registro Académico eliminado correctamente']);
    }
}

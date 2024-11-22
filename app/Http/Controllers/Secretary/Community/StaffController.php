<?php

namespace App\Http\Controllers\Secretary\Community;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Resume;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index($resume_id)
    {
        $validator = Validator::make(['id' => $resume_id], [
            'id' => ['required', 'exists:resumes,id']
        ]);

        if ($validator->fails()) {
            return "error";
        }

        $resume = Resume::find($resume_id);

        $arrayStaff = $resume->staffs;

        $data = array();

        foreach ($arrayStaff as $staffKey) {
            $staff = Staff::find($staffKey->id);

            array_push($data, [
                'id' => $staff->id,
                'lastname' => $staff->transfer->profile->user->lastname,
                'fullnamecomm' => $staff->transfer->profile->user->name,
                'datebirth' =>  date('d.m.Y', strtotime($staff->transfer->profile->date_birth)),
                'datevocation' =>  date('d.m.Y', strtotime($staff->transfer->profile->date_vocation)),
                'office' => $staff->office,
                'dateinsert' =>  date('d.m.Y', strtotime($staff->transfer->transfer_date_adission)),
                'retirement' => $staff->retirement,
                //
                'resume_id' => $resume->id,
                'transfer_id' => $staff->transfer->id,
            ]);
        }

        return $data;
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
        $validator = Validator::make($request->all(), [
            'office' => ['required', 'max:500'],
            'retirement' =>  ['required', 'max:500'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        Staff::create([
            'office' => $request->get('name'),
            'retirement' => $request->get('description'),
        ]);

        return redirect()->back()->with([
            'success' => 'Actividad de la comunidad guardada correctamente!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'office' => ['nullable', 'string', 'max:500'],
            'retirement' =>  ['nullable', 'string', 'max:500'],
            'id' => ['required', 'exists:staff,id'],
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $staff = Staff::find($request->get('id'));

        $staff->update([
            'office' => $request->get('office'),
            'retirement' => $request->get('retirement'),
        ]);

        return redirect()->back()->with([
            'success' => 'Registro actualizado correctamente!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}

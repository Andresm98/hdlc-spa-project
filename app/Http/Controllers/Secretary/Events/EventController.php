<?php

namespace App\Http\Controllers\Secretary\Events;

use Inertia\Inertia;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $validator = Validator::make(request()->all(), [
            'date.month' =>  ['integer', 'between:0,11'],
            'date.year' =>  ['integer', 'between:1000,200000'],
            'type' => ['integer', 'between:1,4']
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'No se encuentran resultados.']);
        }

        $query = Events::query();

        if (request('date')) {
            $year = request('date')['year'];
            $month =  request('date')['month'];
            $sendMonth = (int) $month + 1;

            $codMonthYear = date($year . '-' . (string)$sendMonth . '-01');
            $dateEnd = date("Y-m-t", strtotime($codMonthYear));
            $query->whereBetween('dates', [$codMonthYear, $dateEnd])->get();
        } else {
            $dateInit = date('Y-m-01');
            $dateEnd = date("Y-m-t", strtotime($dateInit));
            $query->whereBetween('dates', [$dateInit, $dateEnd])->get();
        }

        if (request('type')) {
            $query->where('type', '=', request('type'));
        }
        if (request('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%');
        }

        return Inertia::render('Secretary/Events/Index', [
            'events' => $query->get(),
            'filters' => request()->all(['date', 'type', 'search'])
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

        if ($request->get('datesEnd') != null) {
            $validatorData = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:100'],
                'description' => ['required', 'max:100'],
                'dates' => ['required', 'date', 'before:dateEnds', 'date_format:Y-m-d H:i:s'],
                'datesEnd' => ['required', 'date', 'after_or_equal:dates', 'date_format:Y-m-d H:i:s'],
                "type" => ['required', 'integer', 'between:1,4'],
            ]);

            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors())
                    ->withInput();
            }
            Events::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'dates' =>  $request->get('dates'),
                'datesEnd' =>  $request->get('datesEnd'),
                'type' =>  $request->get('type'),
            ]);

            return redirect()->back()->with(['success' => 'El evento fue cerrado correctamente.']);
        } else {
            $validatorData = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:100'],
                'description' => ['required', 'max:100'],
                'dates' => ['required', 'date_format:Y-m-d H:i:s'],
                "type" => ['required', 'integer', 'between:1,4'],
            ]);
            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors())
                    ->withInput();
            }
            Events::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'dates' =>  $request->get('dates'),
                'datesEnd' =>  $request->get('dates'),
                'type' =>  $request->get('type'),
            ]);

            return redirect()->back()->with(['success' => 'El evento fue cerrado correctamente.']);
        }
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
    public function update(Request $request, $event_id)
    {

        $validator = Validator::make(
            ['id' => $event_id],
            [
                'id' => ['required', 'exists:events,id']
            ]
        );
        if ($validator->fails()) {
            return abort(404);
        }

        if ($request->get('datesEnd') != null) {
            $validatorData = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:100'],
                'description' => ['required', 'max:100'],
                'dates' => ['required', 'date', 'before:dateEnds', 'date_format:Y-m-d H:i:s'],
                'datesEnd' => ['required', 'date', 'after_or_equal:dates', 'date_format:Y-m-d H:i:s'],
                "type" => ['required', 'integer', 'between:1,4'],
            ]);

            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors())
                    ->withInput();
            }

            $event = Events::find($event_id);

            $event->update([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'dates' =>  $request->get('dates'),
                'datesEnd' =>  $request->get('datesEnd'),
                'type' =>  $request->get('type'),
            ]);
            return redirect()->back()->with(['success' => 'El evento fue actualizado correctamente.']);
        } else {
            $validatorData = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:100'],
                'description' => ['required', 'max:100'],
                'dates' => ['required', 'date_format:Y-m-d H:i:s'],
                "type" => ['required', 'integer', 'between:1,4'],
            ]);
            if ($validatorData->fails()) {
                return redirect()->back()
                    ->withErrors($validatorData->errors())
                    ->withInput();
            }

            $event = Events::find($event_id);

            $event->update([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'dates' =>  $request->get('dates'),
                'datesEnd' =>  $request->get('dates'),
                'type' =>  $request->get('type'),
            ]);
            return redirect()->back()->with(['success' => 'El evento fue actualizado correctamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id)
    {
        $validator = Validator::make(
            ['id' => $event_id],
            [
                'id' => ['required', 'exists:events,id']
            ]
        );

        if ($validator->fails()) {
            return abort(404);
        }

        $event = Events::find($event_id);

        $event->delete();

        return redirect()->back()->with(['success' => 'El evento fue eliminado correctamente.']);
    }
}

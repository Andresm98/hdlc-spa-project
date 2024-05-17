<?php

namespace App\Http\Controllers\Secretary\Documents;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use PDF;



class DocumentController extends Controller
{
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

        $query = Document::query();

        $query->with('user')
            ->get();

        if (request('type')) {
            $query->where('type', '=', request('type'));
        }

        if (request('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%');
        }

        // $query->orderBy('dates', 'asc');

        return Inertia::render('Secretary/Documents/Index', [
            'events' => $query->get(),
            'filters' => request()->all(['type', 'search'])
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
        $validatorData = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            "type" => ['nullable', 'integer'],
            'content' => ['required', 'max:40000'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        Document::create([
            'name' => $request->get('name'),
            'type' =>  $request->get('type'),
            'content' => $request->get('content'),
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with(['success' => 'El evento fue cerrado correctamente.']);
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
                'id' => ['required', 'exists:documents,id']
            ]
        );
        if ($validator->fails()) {
            return abort(404);
        }


        $validatorData = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            "type" => ['nullable', 'integer'],
            'content' => ['nullable', 'max:40000'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $event = Document::find($event_id);

        $event->update([
            'name' => $request->get('name'),
            'type' =>  $request->get('type'),
            'content' => $request->get('content'),
        ]);
        return redirect()->back()->with(['success' => 'El evento fue actualizado correctamente.']);
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
                'id' => ['required', 'exists:documents,id']
            ]
        );

        if ($validator->fails()) {
            return abort(404);
        }

        $event = Document::find($event_id);

        $event->delete();

        return redirect()->back()->with(['success' => 'El evento fue eliminado correctamente.']);
    }

    public function reportPDF($event_id)
    {
        $validator = Validator::make(
            ['id' => $event_id],
            [
                'id' => ['required', 'exists:documents,id']
            ]
        );

        $data = Document::find($event_id);

        $pdf = PDF::loadView('reports.events.event', compact('data'));

        return $pdf->setPaper('a4', 'portrait')->stream('DocumentosHDLC.pdf');
    }
}

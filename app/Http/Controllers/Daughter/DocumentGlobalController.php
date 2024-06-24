<?php

namespace App\Http\Controllers\Daughter;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Sacrament;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class DocumentGlobalController extends Controller
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

        if ($authUser->id) {
            $query = Document::query();
            $query
                ->where('user_id', $authUser->id)
                ->orderBy('created_at', 'desc')
                ->get();

            if (request('type')) {
                $query->where('type', '=', request('type'));
            }

            if (request('search')) {
                $query->where('name', 'LIKE', '%' . request('search') . '%');
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

            return Inertia::render('Daughter/Document', [
                'events' =>  $query
                    ->with('user')
                    ->paginate(10)
                    ->appends(request()->query()),
                'filters' => request()->all(['type', 'search', 'dateStart', 'dateEnd'])
            ]);
        } else {
            return abort(404);
        }
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
            "type" => ['required', 'integer'],
            'content' => ['required', 'max:60000'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $authUser = auth()->user();

        $daughter = User::find($authUser->id);

        $date = Str::slug(\Carbon\Carbon::parse(date('Y-m-d'))->locale('es')->isoFormat('D MMMM YYYY'));

        Document::create([
            'name' => $request->get('name') . "-" . $daughter->lastname . "-" . $daughter->name . "-" . $date,
            'type' =>  $request->get('type'),
            'content' => $request->get('content'),
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with(['success' => 'El documento fue creado correctamente.']);
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
            "type" => ['required', 'integer'],
            'content' => ['nullable', 'max:60000'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $authUser = auth()->user();

        $event = Document::find($event_id);

        if ($event->user_id === $authUser->id) {
            $event->update([
                'name' => $request->get('name'),
                'type' =>  $request->get('type'),
                'content' => $request->get('content'),
            ]);
            return redirect()->back()->with(['success' => 'El documento fue actualizado correctamente.']);
        } else {
            return redirect()->back()->with(['error' => 'El documento no fue actualizado correctamente.']);
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
                'id' => ['required', 'exists:documents,id']
            ]
        );

        if ($validator->fails()) {
            return abort(404);
        }

        $authUser = auth()->user();

        $event = Document::find($event_id);

        if ($event->user_id === $authUser->id) {
            $event->delete();

            return redirect()->back()->with(['success' => 'El documento fue eliminado correctamente.']);
        } else {
            return redirect()->back()->with(['error' => 'El documento no fue eliminado correctamente.']);
        }
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

        $type = (int)$data->type;

        if ($type === 1 || $type === 2 || $type === 3 || $type === 4 || $type === 5 || $type === 6 || $type === 7) {
            $pdf = PDF::loadView('reports.document.document', compact('data'));

            return $pdf->setPaper('a4', 'portrait')->stream('DocumentosHDLC.pdf');
        }
        if ($type === (8)) {
            $pdf = PDF::loadView('reports.document.document_model_5', compact('data'));

            return $pdf->setPaper('a5', 'landscape')->stream('DocumentosHDLC.pdf');
        }
        if ($type === 9 || $type === 13) {

            $pdf = PDF::loadView('reports.document.document_model_4', compact('data'));

            return $pdf->setPaper('a4', 'portrait')->stream('DocumentosHDLC.pdf');
        }
        if ($type === (10)) {
            $pdf = PDF::loadView('reports.document.document_model_3', compact('data'));

            return $pdf->setPaper('a5', 'portrait')->stream('DocumentosHDLC.pdf');
        }
        if ($type === 11) {
            $pdf = PDF::loadView('reports.document.document_permit_basic', compact('data'));

            return $pdf->setPaper('a5', 'landscape')->stream('DocumentosHDLC.pdf');
        }
        if ($type === 12) {
            $pdf = PDF::loadView('reports.document.document_vehicle_autorization', compact('data'));

            return $pdf->setPaper('a4', 'portrait')->stream('DocumentosHDLC.pdf');
        }
        return;
    }
}

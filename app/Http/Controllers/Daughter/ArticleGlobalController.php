<?php

namespace App\Http\Controllers\Daughter;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Article;
use App\Models\Section;
use App\Models\Community;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleGlobalController extends Controller
{
    protected $from; // public, protected <-> private
    protected $to;
    protected static $section;

    public function __construct()
    {
        $this->from;
        $this->to;
    }

    protected static function loadSection($section_slug)
    {
        $validator = Validator::make([
            'slug' => $section_slug
        ], [
            'slug' => ['required', 'exists:sections,slug']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $section = Section::where('slug', '=', $section_slug)
            ->get()
            ->first();

        return Section::find($section->id);
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

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
    public function index($section_slug)
    {
        $authUser = auth()->user();

        $checking = $this->proveNewVerified();

        if ($checking) {
            return abort(404);
        }

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

                    request()->validate([
                        'direction' => ['in:asc,desc'],
                        'field' => ['in:name'],
                        'status' =>  ['integer'],
                    ]);

                    $communityId = $transferActive->community_id;

                    $inventory = Inventory::where('community_id', $communityId)->first();

                    //

                    $section = ArticleGlobalController::loadSection($section_slug);

                    if ($section->inventory_id != $inventory->id) {
                        return abort(404);
                    }

                    $dataInventoryCommunity = $this->DataSection($section->inventory_id);

                    $query = Article::query()
                        ->where('section_id', '=', $section->id);

                    if (request('search')) {
                        $query->where('name', 'LIKE', '%' . request('search') . '%');
                    }

                    if (request('status')) {
                        $query->where('status', request('status'));
                    }

                    if (request('material')) {
                        $query->where('material', request('material'));
                    }

                    if (request('dateStart')) {
                        $validatorData = Validator::make(['dateEnd' => request('dateEnd'), 'dateStart' => request('dateStart')], [
                            'dateStart' => ['required', 'date', 'before:dateEnd', 'date_format:Y-m-d H:i:s'],
                            'dateEnd' => ['required', 'date', 'after:dateStart', 'date_format:Y-m-d H:i:s'],
                        ]);
                        if ($validatorData->fails()) {
                            $query->orderBy('created_at', 'desc');
                            return redirect()->back()
                                ->withErrors($validatorData->errors());
                        } else {
                            $query->whereBetween('created_at', [request('dateStart'), request('dateEnd')]);
                            $query->orderBy('created_at', 'desc');
                        }
                    }

                    if (request()->has(['field', 'direction'])) {
                        $query->orderBy(request('field'), request('direction'));
                    }
                    return Inertia::render('Daughter/InventoryGlobal/Articles/Index', [
                        'listArticles' => $query
                            ->paginate(10)
                            ->appends(request()->query()),
                        'filters' => request()->all(['search', 'field', 'direction', 'page', 'status', 'material', 'dateStart', 'dateEnd', 'perPage']),
                        'section_slug' => $section->slug,
                        'section' => $section,
                        'dataInventoryCommunity' => $dataInventoryCommunity
                    ]);
                }
            } else {
                return abort(404);
            }
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

    public function DataSection($inventory_id)
    {
        $inventory = Inventory::find($inventory_id);
        return  collect([
            'inventory' => $inventory,
            'community' => Community::find($inventory->community_id),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Secretary\Community\Inventory;

use PDF;
use Inertia\Inertia;
use App\Models\Article;
use App\Models\Section;
use App\Models\Community;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Exports\ArticlesExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CommunityArticleController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($section_slug)
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name'],
            'status' =>  ['integer'],
        ]);

        $section = CommunityArticleController::loadSection($section_slug);
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
        return Inertia::render('Secretary/Communities/Inventories/Articles/Index', [
            'listArticles' => $query
                ->paginate(10)
                ->appends(request()->query()),
            'filters' => request()->all(['search', 'field', 'direction', 'page', 'status', 'material', 'dateStart', 'dateEnd', 'perPage']),
            'section_slug' => $section->slug,
            'section' => $section,
            'dataInventoryCommunity' => $dataInventoryCommunity
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
    public function store(Request $request, $section_slug)
    {
        $validator = Validator::make(
            ['slug' => $section_slug],
            [
                'slug' => ['required', 'exists:sections,slug']
            ]
        );

        if ($validator->fails()) {
            return abort(404);
        }

        $section  = Section::where('slug', '=', $section_slug)
            ->get()
            ->first();

        $articles = Article::where('section_id', $section->id)->get();
        $countArt = count($articles->where('name', $request->get('name')));
        if ($countArt > 0) {
            return redirect()->back()->with(['error' => 'El articulo ya existe en el inventario.']);
        }

        $validatorData = Validator::make($request->all(), [
            "name" => ['required', 'string', 'max:100'],
            "description" => ['string', 'max:2000'],
            "color" => ['string', 'max:50'],
            "price" => ['required', 'numeric'],
            "material" => ['required', 'integer', 'between:1,5'],
            "status" => ['required', 'integer', 'between:1,5'],
            "size" => ['nullable', 'string', 'max:50'],
            "brand" => ['string', 'max:50'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $section->articles()->create([
            "name" =>  $request->get('name'),
            "description" => $request->get('description'),
            "color" => $request->get('color'),
            "price" => $request->get('price'),
            "material" => $request->get('material'),
            "status" => $request->get('status'),
            "size" =>  $request->get('size'),
            "brand" => $request->get('brand'),
        ]);
        return redirect()->back()->with(['success' => 'Artículo creado correctamente']);
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
    public function update(Request $request, $section_slug, $article_id)
    {
        $validator = Validator::make(
            ['slug' => $section_slug],
            ['article_id' => $article_id],
            [
                'slug' => ['required', 'exists:sections,slug'],
                'article_id' => ['required', 'exists:articles,id']
            ]
        );

        if ($validator->fails()) {
            return abort(404);
        }

        $section = Section::where('slug', '=', $section_slug)
            ->get()
            ->first();

        $article =  Article::where('id', '=', $article_id)
            ->where('section_id', '=', $section->id)
            ->get()
            ->first();

        $articles = Article::where('section_id', $section->id)->get();
        $countArt = count($articles->where('name', $request->get('name'))
            ->where('id', '!=', $article->id));
        if ($countArt > 0) {
            return redirect()->back()->with(['error' => 'El articulo ya existe en el inventario.']);
        }
        $validatorData = Validator::make($request->all(), [
            "name" => ['required', 'string', 'max:100'],
            "description" => ['string', 'max:2000'],
            "color" => ['string', 'max:50'],
            "price" => ['required', 'numeric'],
            "material" => ['required', 'integer', 'between:1,5'],
            "status" => ['required', 'integer', 'between:1,5'],
            "size" => ['nullable', 'string', 'max:50'],
            "brand" => ['string', 'max:50'],
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $article->update([
            "name" =>  $request->get('name'),
            "description" => $request->get('description'),
            "color" => $request->get('color'),
            "price" => $request->get('price'),
            "material" => $request->get('material'),
            "status" => $request->get('status'),
            "size" =>  $request->get('size'),
            "brand" => $request->get('brand'),
        ]);

        return redirect()->back()->with(['success' => 'Artículo actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($article_id)
    {

        $validator = Validator::make(['id' => $article_id], [
            'id' => ['required', 'exists:articles,id']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $article  = Article::find($article_id);
        $article->delete();

        return redirect()->back()->with(['success' => 'Artículo eliminado correctamente']);
    }

    public function exportExcel()
    {
        return Excel::download(new ArticlesExport(request()), 'ArticulosHDLC.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new ArticlesExport(request()), 'ArticulosHDLC.csv');
    }

    public function reportAllArticles()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email']
        ]);

        $section = CommunityArticleController::loadSection(request('sectionSlug'));

        $dateFromTo = new CommunityArticleController();

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
                $dateFromTo->setFrom(request('dateStart'));
                $dateFromTo->setTo(request('dateEnd'));
                $query->whereBetween('created_at', [request('dateStart'), request('dateEnd')]);
                $query->orderBy('created_at', 'desc');
            }
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        $from =   $dateFromTo->getFrom();
        $to =  $dateFromTo->getTo();
        $status =  $type = request('status');

        $data = $query
            ->get();
        $dataInventoryCommunity = $this->DataSection($section->inventory_id);

        $pdf = PDF::loadView('reports.communities.articles.list-general', compact(
            'data',
            'status',
            'section',
            'dataInventoryCommunity',
            'from',
            'to'
        ));
        // return $pdf -> download('Usuarios.pdf');
        return $pdf->setPaper('a4', 'landscape')->stream('Reportes Articulos' . $section->name . '.pdf');
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

<?php

namespace App\Http\Controllers\Secretary\Community\Inventory;

use Inertia\Inertia;
use App\Models\Article;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CommunityArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index($section_slug)
    {


        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email']
        ]);

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

        $query = Article::query()
            ->where('section_id', '=', $section->id);


        if (request('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }
        return Inertia::render('Secretary/Communities/Inventories/Articles/Index', [
            'listArticles' => $query
                ->paginate(10)
                ->appends(request()->query()),
            'filters' => request()->all(['search', 'field', 'direction', 'page']),
            'section_slug' => $section->slug
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

        $validatorData = Validator::make($request->all(), [
            "name" => ['required', 'string', 'max:100'],
            "description" => ['string', 'max:1000'],
            "color" => ['string', 'max:50'],
            "price" => ['required', 'numeric'],
            "material" => ['required', 'integer', 'between:1,5'],
            "status" => ['required', 'integer', 'between:1,5'],
            "size" => ['numeric'],
            "brand" => ['string', 'max:50'],
        ]);
        if ($validator->fails()) {
            return abort(404);
        }
        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $section  = Section::where('slug', '=', $section_slug)
            ->get()
            ->first();

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
            [
                'slug' => ['required', 'exists:sections,slug']
            ]
        );

        $validatorData = Validator::make($request->all(), [
            "name" => ['required', 'string', 'max:100'],
            "description" => ['string', 'max:1000'],
            "color" => ['string', 'max:50'],
            "price" => ['required', 'numeric'],
            "material" => ['required', 'integer', 'between:1,5'],
            "status" => ['required', 'integer', 'between:1,5'],
            "size" => ['numeric'],
            "brand" => ['string', 'max:50'],
        ]);
        if ($validator->fails()) {
            return abort(404);
        }
        if ($validatorData->fails()) {
            return redirect()->back()
                ->withErrors($validatorData->errors())
                ->withInput();
        }

        $section = Section::where('slug', '=', $section_slug)
            ->get()
            ->first();

        $article =  Article::where('id', '=', $article_id)
            ->where('section_id', '=', $section->id)
            ->get()
            ->first();

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
}

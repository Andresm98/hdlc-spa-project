<?php

namespace App\Exports;

use App\Models\Article;
use App\Models\Section;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Validator;

class ArticlesExport implements FromView
{
    protected $from; // public, protected <-> private
    protected $to;

    public function __construct()
    {
        $this->from;
        $this->to;
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

    public function view(): View
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email']
        ]);

        $validator = Validator::make([
            'slug' => request('sectionSlug')
        ], [
            'slug' => ['required', 'exists:sections,slug']
        ]);

        if ($validator->fails()) {
            return abort(404);
        }

        $section = Section::where('slug', '=', request('sectionSlug'))
            ->get()
            ->first();

        $dateFromTo = new ArticlesExport();

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
        return view('exports.communities.articles.list-general', compact('data'));
    }
}

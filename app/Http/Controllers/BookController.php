<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class BookController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return response()->json(['BooksResponse' => $books]);
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
            "name" => ['required', 'string', 'max:200', 'unique:books,name'],
            "description" => ['nullable', 'string', 'string', 'max:2000'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Los errores son los siguientes.', $validator->errors());
        }

        $book = Book::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return $this->sendResponse($book, 'El libro ha sido creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($bookId)
    {
        $validator = Validator::make(
            ['bookId' => $bookId],
            ['bookId' => 'required', 'number', 'exists:books,id']
        );

        if ($validator->fails()) {
            return $this->sendError('Validation error', 'El libro que desea mostrar no existe en los registros');
        }

        $book = Book::find($bookId);

        return $this->sendResponse($book, 'El libro fue encontrado satisfactoriamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $docBookId)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'required|string|max:200|unique:books,name,' . (int) $docBookId,
            "description" => ['nullable', 'string', 'string', 'max:2000'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Los errores son los siguientes.', $validator->errors());
        }

        $book = Book::find($docBookId);

        $book->update([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        return $this->sendResponse($book, 'El libro ha sido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($docBookId)
    {
        $validator = Validator::make(
            ['docBookId' => $docBookId],
            ['docBookId' => ['numeric', 'required', 'exists:books,id']]
        );

        if ($validator->fails()) {
            return $this->sendError('No se encuentra el libro.');
        }

        $book = Book::find($docBookId);

        $book->delete();

        return $this->sendResponse([], 'El libro fue eliminado correctamente.');
    }
}

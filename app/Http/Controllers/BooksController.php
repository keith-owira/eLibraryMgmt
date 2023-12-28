<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Books::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'publisher'=>'required',
            'isbn'=>'required',
            'category'=>'required',
            'sub_category'=>'required',
            'pages'=>'required',
            'image'=>'required',
            'added_by'=>'required',
        ]);
        return Books::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Books::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $books = Books::find($id);
        $books->update($request->all());
        return $books;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Books::destroy($id);
    }
    /**
     * Search for A book with name
     */
    public function search(string $name)
    {
        return Books::where('name', 'like' ,'%'.$name.'%')->get();
    }
}

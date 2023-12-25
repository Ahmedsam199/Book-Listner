<?php
// BookController.php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{

    public function store(Request $request)
    {
        $book = Book::create([
            'Bookname' => $request->input('Bookname'),
            'PageNumber' => $request->input('PageNumber'),
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $uniqueFilename = uniqid() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public', $uniqueFilename); // 'books' is the storage folder where files will be stored
            $book->update(['file_path' => $path]);
        }

        return response()->json($book, 201);
    }
    public function getAll(Request $request){
         $books=Book::all();
         return response()->json($books,200); 
    }
    public function getById(Request $request){
        $book = Book::findOrFail($request->route('id'));
        return response()->json($book,200);
    }
    public function deleteById(Request $request){
        $book= Book::where('id',$request->route('id'))->delete();
        return response()->json(200);
    }
}

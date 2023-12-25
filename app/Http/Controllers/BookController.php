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
        $request->validate([
            'Bookname' => 'required|string',
            'PageNumber' => 'required|integer',
            'file' => 'required|file|mimes:pdf,doc,docx', // Adjust allowed file types as needed
        ]);

        $book = Book::create([
            'Bookname' => $request->input('Bookname'),
            'PageNumber' => $request->input('PageNumber'),
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $book->storeFile($file);

            // Get the URL of the stored file
            $fileUrl = Storage::url($book->file_path);
        }

        return response()->json(['book' => $book, 'file_url' => $fileUrl], 201);
    }

}

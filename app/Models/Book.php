<?php
// Book.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    protected $fillable = ['Bookname', 'PageNumber', 'file_path'];
public function storeFile($file)
    {
        $path = $file->store('public'); // 'books' is the storage folder where files will be stored

        $this->update(['file_path' => $path]);
    }

    public function getFileUrl()
    {
        if ($this->file_path) {
            return asset('storage/app/books' . $this->file_path);
        }

        return null;
    }

}

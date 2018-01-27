<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function getFile($file)
    {
        return response()->download(storage_path('app/'. $file), null, [], null);
    }
}

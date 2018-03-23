<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * @param $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getFile($file)
    {
        if (! request()->hasValidSignature()) {
            abort(404, 'Not found');
        }
        
        return response()->download(storage_path('app/'. $file), null, [], null);
    }
}

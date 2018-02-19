<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpacesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        return view('spaces.create');
    }

    public function getFile($file)
    {
        return response()->download(storage_path('app/spaces/'. $file), null, [], null);
    }
}

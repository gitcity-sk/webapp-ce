<?php

namespace App\Http\Controllers\Spaces;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Space;
use App\Repositories\Spaces;
use Illuminate\Support\Facades\Storage;

class SpacesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Spaces $spaces)
    {
        $this->middleware('auth');

        $this->spaces = $spaces;
    }

    public function show($slug, $path = null)
    {
        $space = $this->spaces->findBySlug($slug);

        return view('spaces.show', compact(['space', 'path']));
    }
}

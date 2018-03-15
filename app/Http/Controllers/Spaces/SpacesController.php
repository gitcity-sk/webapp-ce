<?php

namespace App\Http\Controllers\Spaces;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Space;

class SpacesController extends Controller
{
    public function show(Space $space, $path = null)
    {
        return view('spaces.show', compact(['space', 'path']));
    }
}

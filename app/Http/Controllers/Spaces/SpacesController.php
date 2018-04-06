<?php

namespace App\Http\Controllers\Spaces;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Space;
use App\Repositories\Spaces;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SpacesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Spaces $spaces)
    {
        //$this->middleware('auth');

        $this->spaces = $spaces;
    }

    /**
     * @param $slug
     * @param null $path
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug, $path = null)
    {
        $space = $this->spaces->findBySlug($slug);

        // check if space is private
        if ($space->private) {
            if (!Auth::check()) abort(404);
            $project = $space->project;

            return view('spaces.private-show', compact(['space', 'path', 'project']));
        }

        return view('spaces.show', compact(['space', 'path']));
    }
}

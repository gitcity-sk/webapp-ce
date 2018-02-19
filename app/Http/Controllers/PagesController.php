<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ee\License;
use App\Setting;
use App\Page;

class PagesController extends Controller
{
    public function index()
    {
        $pages = Page::byDateDesc()->get();

        return view('pages.index', compact('pages'));
    }

    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }

    public function privacyPolicy()
    {
        return view('pages.static.privacy');
    }

    public function terms()
    {
        return view('pages.static.terms');
    }

    public function pricing()
    {
        return view('pages.static.pricing');
    }
}

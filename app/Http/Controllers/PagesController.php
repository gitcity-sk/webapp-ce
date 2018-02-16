<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ee\License;
use App\Setting;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.index');
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

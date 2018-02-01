<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ee\License;
use App\Setting;

class PagesController extends Controller
{
    public function privacyPolicy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function pricing()
    {
        return view('pages.pricing');
    }

    public function license()
    {
        return view('pages.pricing');
    }
}

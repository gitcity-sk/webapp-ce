<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfilesController extends Controller
{
    public function show(Profile $profile)
    {
        return "add view template"
    }
}

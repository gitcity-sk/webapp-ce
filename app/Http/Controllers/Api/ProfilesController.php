<?php

namespace App\Http\Controllers\Api;

use App\Profile;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return array
     */
    public function index()
    {
        $users = Profile::all();

        return compact('users');
    }
}

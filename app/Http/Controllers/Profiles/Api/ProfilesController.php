<?php

namespace App\Http\Controllers\Profiles\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Http\Resources\Profile\ProfileShowResource;
use App\Http\Resources\Profile\ProfileResource;

class ProfilesController extends Controller
{
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

        return ProfileResource::collection($users);
    }

    public function show(Profile $profile)
    {
        return new ProfileShowResource($profile);
    }
}

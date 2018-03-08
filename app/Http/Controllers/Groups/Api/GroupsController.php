<?php

namespace App\Http\Controllers\Groups\Api;

use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GroupResource;


class GroupsController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return GroupResource::collection($groups);
    }
}

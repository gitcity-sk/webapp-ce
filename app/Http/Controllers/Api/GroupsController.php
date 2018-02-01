<?php

namespace App\Http\Controllers\Api;

use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GroupResource;
use App\Http\Resources\ProjectResource;

class GroupsController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return GroupResource::collection($groups);
    }

    public function projects(Group $group)
    {
        return ProjectResource::collection($group->projects);
    }
}

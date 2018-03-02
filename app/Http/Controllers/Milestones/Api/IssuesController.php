<?php

namespace App\Http\Controllers\Milestones\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Milestone;
use App\Http\Resources\IssueResource;

class IssuesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function open(Milestone $milestone)
    {
        return IssueResource::collection($milestone->issues()->open()->get());
    }

    public function closed(Milestone $milestone)
    {
        return IssueResource::collection($milestone->issues()->closed()->get());
    }
}

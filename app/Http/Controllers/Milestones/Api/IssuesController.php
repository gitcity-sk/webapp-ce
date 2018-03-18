<?php

namespace App\Http\Controllers\Milestones\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Milestone;
use App\Http\Resources\IssueResource;

class IssuesController extends Controller
{
    /**
     * IssuesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Milestone $milestone
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function open(Milestone $milestone)
    {
        return IssueResource::collection($milestone->issues()->open()->get());
    }

    /**
     * @param Milestone $milestone
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function closed(Milestone $milestone)
    {
        return IssueResource::collection($milestone->issues()->closed()->get());
    }
}

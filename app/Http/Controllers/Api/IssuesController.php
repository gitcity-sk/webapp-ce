<?php

namespace App\Http\Controllers\Api;

use App\Issue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\IssueResource;

class IssuesController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $issues = Issue::all();

        return IssueResource::collection($issues);
    }

    /**
     * @param Issue $issue
     * @return IssueResource
     */
    public function show(Issue $issue)
    {
        return new IssueResource($issue);
    }
}

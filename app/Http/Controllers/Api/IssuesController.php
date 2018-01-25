<?php

namespace App\Http\Controllers\Api;

use App\Issue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\IssueResource;

class IssuesController extends Controller
{
    public function show(Issue $issue)
    {
        return new IssueResource($issue);
    }
}

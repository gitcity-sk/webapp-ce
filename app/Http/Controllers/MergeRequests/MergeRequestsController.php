<?php

namespace App\Http\Controllers\MergeRequests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo;
use App\Diff;
use App\MergeRequest;

class MergeRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(MergeRequest $mergeRequest)
    {
        $repo = Repo::open($mergeRequest->project->user->name, $mergeRequest->project->slug);
        $diff = Diff::getDiffBetween($mergeRequest->branch_from, $mergeRequest->branch_to, $repo);
        dd([
            'repo' => $repo,
            'diff' => $diff
        ]);
        return view('merge_requests.show', compact('mergeRequest', 'diff'));
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Commit;
use App\Project;
use App\Http\Resources\Git\CommitResource;
use Illuminate\Support\Facades\Cache;

class CommitsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Project $project
     * @return array
     * @throws \Exception
     */
    public function index(Project $project)
    {
        $gitLog = new Commit();
        $commits = $gitLog->get($project->user->name, $project->slug);

        return [
            'data' => CommitResource::collection($commits)
        ];
    }

    /**
     * @param $projectId
     * @param $sha
     * @return array
     */
    public function show($projectId, $sha)
    {
        $gitLog = new Commit();

        $key = 'commit-' . $projectId . '-' . $sha;

        // Load from Cache if key exists
        $commit = Cache::remember($key, 10, function () use ($gitLog, $projectId, $sha) {
            $project = Project::find($projectId);

            return $gitLog->getSingle($project->user->name, $project->slug, $sha);
        });

        return [
            'data' => (new CommitResource($commit))->toArray()
        ];
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use App\Project;
use App\Http\Resources\Git\TagsResource;

class TagsController extends Controller
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
     */
    public function index(Project $project)
    {
        $gitTags = new Tag();
        $tags = $gitTags->get($project->user->name, $project->slug);

        // tags returns array of gitObject
        $array = [];
        foreach ($tags as $tag) {
            $array[] = (new TagsResource($tag))->toArray();
        }

        return [
            'data' => $array
        ];
    }
}

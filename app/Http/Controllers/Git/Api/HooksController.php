<?php

namespace App\Http\Controllers\Git\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Project\ProjectResource;
use App\Git\Shell;

class HooksController extends Controller
{
    /**
     * Return project information
     */
    public function project()
    {
        if (!Shell::isAllowed(request('shell_secret_key'))) abort(404);

        if (!request()->has('project')) return response('Not Found', 404);
        if (null !== request('project')) {
            $matches = explode('/', request('project'));
        }

        $user = User::where('name', $matches[0])->firstOrFail();

        if ($user) return new ProjectResource($user->projects()->where('slug', $matches[1])->firstOrFail());
    }
}

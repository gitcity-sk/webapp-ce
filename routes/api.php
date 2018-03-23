<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Groups API
 */

Route::group(['namespace' => 'Groups\Api'], function () {
    Route::get('/groups', 'GroupsController@index');
    Route::get('/groups/{group}/projects', 'ProjectsController@index');
});

/**
 * Milestones API
 */

Route::group(['namespace' => 'Milestones\Api'], function () {
    Route::get('/milestones/{milestone}/issues/open', 'IssuesController@open');
    Route::get('/milestones/{milestone}/issues/closed', 'IssuesController@closed');
});

/**
 * Projects API
 */
Route::group(['namespace' => 'Projects\Api'], function () {
    // GET
    Route::get('/projects', 'ProjectsController@index');
    Route::get('/projects/{project}/issues', 'ProjectsController@issues');

    Route::get('/projects/{project}/milestones', 'MilestonesController@index');
    Route::get('/projects/{project}/merge-requests', 'MergeRequestsController@index');

    Route::get('/projects/{project}/spaces', 'SpacesController@index');
});

/**
 * Issues API
 */
Route::group(['namespace' => 'Issues\Api'], function () {
    // PUT
    Route::put('/issues/close', 'IssuesController@close');
    Route::put('/issues/reopen', 'IssuesController@reopen');
});

/**
 * Merge requests API
 */
Route::group(['namespace' => 'MergeRequests\Api'], function () {
    // GET
    Route::get('/diff/{project}/{sourceBranch}/{targetBranch}', 'DiffController@index');
});

/**
 * Spaces API
 */
Route::group(['namespace' => 'Spaces\Api'], function () {
    // GET
    Route::get('/spaces/size-of/{path?}', 'SpacesController@sizeOf')->where('path', '(.*)');
    Route::get('/spaces/{space}/size', 'SpacesController@getSize');
    Route::get('/spaces/{space}/files/{path?}', 'FilesController@index')->where('path', '(.*)');
    Route::get('/spaces/{space}/directories/{path?}', 'DirectoriesController@index')->where('path', '(.*)');
    Route::get('/spaces/temp-url/{path?}', 'SpacesController@temporaryUrlFor')->where('path', '(.*)');
});

/**
 * Other Api
 */

Route::group(['namespace' => 'Api'], function () {
    // GET
    Route::get('/projects/{project}/pages', 'PagesController@index');

    Route::get('/issues', 'IssuesController@index');
    Route::get('/issues/{issue}', 'IssuesController@show');

    Route::get('/profiles', 'ProfilesController@index');

    Route::get('/projects/{project}/tree/{path?}', 'TreeController@files')->where('path', '(.*)');
    Route::get('/projects/{project}/commits', 'CommitsController@index');
    Route::get('/projects/{projectId}/commits/{sha}', 'CommitsController@show');
    Route::get('/projects/{project}/branches', 'BranchesController@index');
    Route::get('/projects/{project}/tags', 'TagsController@index');

    Route::get('/users', 'UsersController@index');
    Route::get('/users/{user}', 'UsersController@show');
    Route::get('/users/{user}/projects', 'UsersController@projects');

    Route::get('/session/configure', 'TestController@configure');

    // POST
    Route::post('/test', 'TestController@index');
});

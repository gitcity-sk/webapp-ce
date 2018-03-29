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

/**
 * Standards
 * -------------------------------------------------
 * Method - action name /path controller.action
 * GET - INDEX /photo photo.index
 * GET - CREATE /photo/create photo.create
 * POST - STORE /photo photo.store
 * GET - SHOW /photo/{photo} photo.show
 * GET - EDIT /photo/{photo}/edit photo.edit
 * PUT/PATCH - UPDATE /photo/{photo} photo.update
 * DELETE - DESTROY /photo/{photo} photo.destroy
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
 * Labels API
 */

Route::group(['namespace' => 'Labels\Api'], function () {
    Route::get('/labels', 'LabelsController@index');
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

    Route::get('/projects/{project}/readme', 'ReadmeController@show')->name('api.projects.readme');
    Route::get('/projects/{project}/blob/{path?}', 'BlobController@show')->where('path', '(.*)')->name('api.projects.blob');

    Route::get('/projects/{project}/milestones', 'MilestonesController@index');
    Route::get('/projects/{project}/merge-requests', 'MergeRequestsController@index');

    Route::get('/projects/{project}/spaces', 'SpacesController@index');
});

/**
 * Issues API
 */
Route::group(['namespace' => 'Issues\Api'], function () {
    // GET
    Route::get('/issues/{issue}/labels', 'LabelsController@index');

    // POST -> CREATE
    Route::post('/issues/{issue}/labels/{id}', 'LabelsController@store');

    // PUT -> UPDATE
    Route::put('/issues/close', 'IssuesController@close');
    Route::put('/issues/reopen', 'IssuesController@reopen');

    // DELETE
    Route::delete('/issues/{issue}/labels/{id}', 'LabelsController@destroy');
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
    Route::get('/spaces/{space}', 'SpacesController@show');
    Route::get('/spaces/size-of/{path?}', 'SpacesController@sizeOf')->where('path', '(.*)');
    Route::get('/spaces/{space}/size', 'SpacesController@getSize');
    Route::get('/spaces/{space}/files/{path?}', 'FilesController@index')->where('path', '(.*)');
    Route::get('/spaces/{space}/directories/{path?}', 'DirectoriesController@index')->where('path', '(.*)');
    Route::get('/spaces/temp-url/{path?}', 'SpacesController@temporaryUrlFor')->where('path', '(.*)');
});

/**
 * Profiles
 */
Route::group(['namespace' => 'Profiles\Api'], function () {
    // GET
    Route::get('/profiles', 'ProfilesController@index');
    Route::get('/profiles/{profile}', 'ProfilesController@show');
});

/**
 * Profiles
 */
Route::group(['namespace' => 'Git\Api'], function () {
    // GET
    Route::get('/git/update', 'HooksController@update');
});

/**
 * Other Api
 */

Route::group(['namespace' => 'Api'], function () {
    // GET
    Route::get('/projects/{project}/pages', 'PagesController@index');

    Route::get('/issues', 'IssuesController@index');
    Route::get('/issues/{issue}', 'IssuesController@show');

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

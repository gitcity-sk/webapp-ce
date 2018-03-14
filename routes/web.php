<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Project;

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::get('/', function () {

    return view('home')->with('name', 'CodeOcean');
});

/**
 * Groups
 */
Route::group(['namespace' => 'Groups'], function () {
    Route::get('/groups', 'GroupsController@index');
    Route::get('/groups/create', 'GroupsController@create');
    Route::get('/groups/{group}', 'GroupsController@show');
    Route::get('/groups/{group}/milestones', 'MilestonesController@index');

    Route::post('/groups', 'GroupsController@store');
    Route::post('/groups/{group}/projects', 'ProjectsController@store');
});

/**
 * Groups API
 */

Route::group(['namespace' => 'Groups\Api'], function () {
    Route::get('/api/groups', 'GroupsController@index');
    Route::get('/api/groups/{group}/projects', 'ProjectsController@index');
});

/**
 * Milestones
 */

Route::group(['namespace' => 'Milestones'], function () {
    Route::get('/milestones/{milestone}', 'MilestonesController@show');
});

/**
 * Milestones API
 */

Route::group(['namespace' => 'Milestones\Api'], function () {
    Route::get('/api/milestones/{milestone}/issues/open', 'IssuesController@open');
    Route::get('/api/milestones/{milestone}/issues/closed', 'IssuesController@closed');
});

/**
 * Projects
 */
Route::group(['namespace' => 'Projects'], function () {
    Route::get('/projects', 'ProjectsController@index');
    Route::get('/projects/create', 'ProjectsController@create');
    Route::get('/projects/{id}', 'ProjectsController@show')->name('project');
    Route::get('/projects/{id}/files/{path?}', 'ProjectsController@show')->where('path', '(.*)')->name('project.files');
    Route::get('/projects/{id}/issues', 'IssuesController@index')->name('projectIssues');
    Route::get('/projects/{id}/issues/new', 'IssuesController@create');
    Route::get('/projects/{project}/commits', 'CommitsController@show')->name('project.commits');
    Route::get('/projects/{project}/branches', 'BranchesController@show')->name('project.branches');
    Route::get('/projects/{project}/tags', 'TagsController@show')->name('project.tags');
    Route::get('/projects/{id}/merge-requests', 'ProjectsController@mergeRequests');
    Route::get('/projects/{id}/merge-requests/new', 'ProjectsController@createMergeRequest');
    Route::get('/projects/{id}/create-on-server', 'ProjectsController@createOnServer');
    Route::get('/projects/{project}/milestones', 'MilestonesController@index')->name('projectMilestones');
    Route::get('/projects/{project}/milestones/new', 'MilestonesController@create');

    Route::post('/projects', 'ProjectsController@store');
    Route::post('/projects/{project}/issues', 'IssuesController@store');
    Route::post('/projects/{project}/merge-requests', 'MergeRequestsController@store');

    Route::post('/projects/{project}/milestones', 'MilestonesController@store');
});

/**
 * Projects API
 */
Route::group(['namespace' => 'Projects\Api'], function () {
    Route::get('/api/projects', 'ProjectsController@index');
    Route::get('/api/projects/{project}/issues', 'ProjectsController@issues');

    Route::get('/api/projects/{project}/milestones', 'MilestonesController@index');
    Route::get('/api/projects/{project}/merge-requests', 'MergeRequestsController@index');
});

/**
 * Issues
 */
Route::group(['namespace' => 'Issues'], function () {
    Route::get('/issues/{issue}', 'IssuesController@show');
    Route::post('/issues/{issue}/comments', 'CommentsController@store');
});


/**
 * Issues API
 */
Route::group(['namespace' => 'Issues\Api'], function () {
    Route::put('/issues/close', 'IssuesController@close');
    Route::put('/issues/reopen', 'IssuesController@reopen');
});

/**
 * Merge requests
 */
Route::group(['namespace' => 'MergeRequests'], function () {
    Route::get('/merge-requests/{mergeRequest}', 'MergeRequestsController@show');
});

/**
 * Merge requests API
 */
Route::group(['namespace' => 'MergeRequests\Api'], function () {
    Route::get('/api/diff/{project}/{sourceBranch}/{targetBranch}', 'DiffController@index');
});

/**
 * Labels
 */

Route::get('/labels', 'LabelsController@index');

/**
 * Authenticate
 */
Route::get('/logout', 'SessionsController@destroy');

/**
 * Pages
 */
Route::get('/privacy', 'PagesController@privacyPolicy');
Route::get('/terms', 'PagesController@terms');
Route::get('/pricing', 'PagesController@pricing');

Route::get('/pages', 'PagesController@index');
Route::get('/pages/{page}', 'PagesController@show');

/**
 * profiles
 */

Route::get('/profiles/{profile}', 'ProfilesController@show');
Route::get('/profiles/{profile}/edit', 'ProfilesController@edit');
Route::put('/profiles/{profile}', 'ProfilesController@update');

/**
 * WebIde
 */

Route::get('/-/editor', 'WebideController@index');

 /**
  * Pages
  */

 Route::get('/-/cms/{project}', 'CmsController@index');
 Route::get('/-/cms/{project}/pages/new', 'CmsController@create');
 Route::get('/-/cms/pages/{page}/edit', 'CmsController@edit');

 Route::post('/-/cms/{project}/pages', 'CmsController@store');

/**
 * ADMIN
 */
Route::get('/admin/roles', 'RolesController@index');
Route::get('/admin/roles/create', 'RolesController@create');
Route::get('/admin/roles/{role}', 'RolesController@show');

Route::get('/admin/labels', 'Admin\LabelsController@index');
Route::get('/admin/labels/create', 'Admin\LabelsController@create');

Route::get('/admin/permissions', 'PermissionsController@index');
Route::get('/admin/permissions/create', 'PermissionsController@create');

Route::get('/admin/users', 'UsersController@index');
Route::get('/admin/users/{user}', 'UsersController@show');

Route::get('/admin/license', 'ee\LicenseController@show');

Route::post('/admin/permissions', 'PermissionsController@store');
Route::post('/admin/roles', 'RolesController@store');
Route::post('/admin/roles/{role}/permissions', 'PermissionsController@assignTo');
Route::post('/admin/users/{user}/roles', 'RolesController@assignTo');

Route::post('/admin/license/upload', 'ee\LicenseController@store');
Route::post('/admin/labels', 'Admin\LabelsController@store');

Route::delete('/admin/license/delete', 'ee\LicenseController@destroy');

Route::get('/admin/api/testing', 'Admin\ApiController@testing');

/**
 * settings
 */

Route::get('/settings/authorized-keys', 'AuthorizedKeysController@index');
Route::post('/settings/authorized-keys', 'AuthorizedKeysController@store');
Route::get('/settings/authorized-keys/{authorizedKey}/delete', 'AuthorizedKeysController@destroy');

/**
 * Api
 */

Route::group(['namespace' => 'Api'], function () {
    Route::get('/api/projects/{project}/pages', 'PagesController@index');

    Route::get('/api/issues', 'IssuesController@index');
    Route::get('/api/issues/{issue}', 'IssuesController@show');

    Route::get('/api/profiles', 'ProfilesController@index');

    Route::get('/api/projects/{project}/tree/{path?}', 'TreeController@files')->where('path', '(.*)');
    Route::get('/api/projects/{project}/commits', 'CommitsController@index');
    Route::get('/api/projects/{projectId}/commits/{sha}', 'CommitsController@show');
    Route::get('/api/projects/{project}/branches', 'BranchesController@index');
    Route::get('/api/projects/{project}/tags', 'TagsController@index');

    Route::get('/api/users', 'UsersController@index');
    Route::get('/api/users/{user}', 'UsersController@show');
    Route::get('/api/users/{user}/projects', 'UsersController@projects');

    Route::get('/api/session/configure', 'TestController@configure');

    Route::post('/api/test', 'TestController@index');
});

/*Route::get('/projects', function () {
    $projects = Project::all();

    return view('projects.index', compact('projects'));
});*/

/*Route::get('/projects/{project}', function ($id) {
    $tasks = Project::find($id);

    return $tasks;

    return view('projects.show', compact('name', 'age', 'tasks'));
});*/

Route::get('/storage/{filename?}', 'FileController@getFile')->where('filename', '(.*)');

Route::get('/spaces/space-name/{filename?}', 'SpacesController@getFile')->where('filename', '(.*)');

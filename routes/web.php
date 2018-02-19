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

Route::get('/groups', 'GroupsController@index');
Route::get('/groups/create', 'GroupsController@create');
Route::get('/groups/{group}', 'GroupsController@show');

Route::post('/groups', 'GroupsController@store');
Route::post('/groups/{group}/projects', 'ProjectsController@assignTo');

/**
 * Projects
 */
Route::get('/projects', function () {
    return view('projects.index');
})->middleware('auth');
Route::get('/projects/create', 'ProjectsController@create');
Route::get('/projects/{id}', 'ProjectsController@show')->name('project');
Route::get('/projects/{id}/issues', 'ProjectsController@issues')->name('projectIssues');
Route::get('/projects/{id}/issues/new', 'ProjectsController@createIssue');
Route::get('/projects/{project}/commits', 'CommitsController@show');
Route::get('/projects/{project}/branches', 'BranchesController@show');
Route::get('/projects/{project}/tags', 'TagsController@show');
Route::get('/projects/{id}/merge-requests', 'ProjectsController@mergeRequests');
Route::get('/projects/{id}/merge-requests/new', 'ProjectsController@createMergeRequest');
Route::get('/projects/{id}/create-on-server', 'ProjectsController@createOnServer');

Route::post('/projects', 'ProjectsController@store');
Route::post('/projects/{project}/issues', 'IssuesController@store');
Route::post('/projects/{project}/merge-requests', 'MergeRequestsController@store');

/**
 * Issues
 */
Route::get('/issues/{issue}', 'IssuesController@show');
Route::get('/merge-requests/{mergeRequest}', 'MergeRequestsController@show');

Route::post('/issues/{issue}/comments', 'CommentsController@store');

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
    Route::get('/api/groups', 'GroupsController@index');
    Route::get('/api/groups/{group}/projects', 'GroupsController@projects');

    Route::get('/api/projects/{project}/pages', 'PagesController@index');

    Route::get('/api/issues', 'IssuesController@index');
    Route::get('/api/issues/{issue}', 'IssuesController@show');

    Route::get('/api/profiles', 'ProfilesController@index');

    Route::get('/api/projects', 'ProjectsController@index');
    Route::get('/api/projects/{project}/tree', 'TreeController@files');
    Route::get('/api/projects/{project}/issues', 'ProjectsController@issues');

    Route::get('/api/users', 'UsersController@index');
    Route::get('/api/users/{user}', 'UsersController@show');
    Route::get('/api/users/{user}/projects', 'UsersController@projects');
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

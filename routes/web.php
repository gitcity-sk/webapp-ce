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

use App\Project;

Auth::routes();

/**
 * Users Dashboard
 * There are users redirected after login
 */
Route::get('/dashboard', 'HomeController@index')->name('home');

/**
 * Homepage
 * You can update configu if you want redirect Homepage to another page
 */
Route::get('/', function () {
    if (config('webapp.redirect_home_page')) {
        return redirect(config('webapp.redirect_home_page'));
    }

    if (Auth::check()) {
        return redirect('/projects');
    }

    return view('home')->with('name', 'CodeOcean');
});

/**
 * Groups
 */
Route::group(['namespace' => 'Groups'], function () {
    Route::get('/groups', 'GroupsController@index');
    Route::get('/groups/create', 'GroupsController@create');
    Route::get('/groups/{group}', 'GroupsController@show')->name('groups.show');
    Route::get('/groups/{group}/milestones', 'MilestonesController@index')->name('groups.milestones');

    Route::post('/groups', 'GroupsController@store');
    Route::post('/groups/{group}/projects', 'ProjectsController@store');
    Route::post('/groups/{group}/milestones', 'MilestonesController@store');
});

/**
 * Milestones
 */

Route::group(['namespace' => 'Milestones'], function () {
    Route::get('/milestones/{milestone}', 'MilestonesController@show');
});

/**
 * Projects
 */
Route::group(['namespace' => 'Projects'], function () {
    // GET
    Route::get('/projects', 'ProjectsController@index');
    Route::get('/projects/create', 'ProjectsController@create');
    Route::get('/projects/{id}', 'ProjectsController@show')->name('project');
    Route::get('/projects/{id}/files/{path?}', 'ProjectsController@show')->where('path', '(.*)')->name('project.files');
    Route::get('/projects/{project}/blob/{path?}', 'BlobController@show')->where('path', '(.*)')->name('project.blob');
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
    Route::get('/projects/{project}/spaces', 'SpacesController@index')->name('project.spaces');

    // POST, PUT
    Route::post('/projects', 'ProjectsController@store');
    Route::post('/projects/{project}/issues', 'IssuesController@store');
    Route::post('/projects/{project}/merge-requests', 'MergeRequestsController@store');
    Route::post('/projects/{project}/milestones', 'MilestonesController@store');
    Route::post('/projects/{project}/spaces', 'SpacesController@store');
});

/**
 * Issues
 */
Route::group(['namespace' => 'Issues'], function () {
    // GET
    Route::get('/issues/{issue}', 'IssuesController@show');

    // POST
    Route::post('/issues/{issue}/comments', 'CommentsController@store');
});

/**
 * Merge requests
 */
Route::group(['namespace' => 'MergeRequests'], function () {
    // GEt
    Route::get('/merge-requests/{mergeRequest}', 'MergeRequestsController@show');
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
 * ADMIN section
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

// passport config
Route::get('/admin/passport', 'Admin\PassportController@index');

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

// Retrieving file from storage
// Show all files that are located in storage folder :)
Route::get('/storage/{filename?}', 'FileController@getFile')->where('filename', '(.*)')->name('storage.file');

Route::get('/projects/{project}/spaces/new', 'SpacesController@create');

/**
 * Spaces
 */
Route::group(['namespace' => 'Spaces'], function () {
    // GET
    Route::get('/spaces/photos/{slug}/{path?}', 'PhotosController@show')->where('path', '(.*)');
    Route::get('/spaces/{slug}/{path?}', 'SpacesController@show')->where('path', '(.*)');
});

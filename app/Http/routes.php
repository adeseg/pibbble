<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/terms', 'PagesController@terms');
Route::get('/privacy', 'PagesController@privacy');
Route::get('/help', 'PagesController@help');
Route::get('/contact', 'PagesController@contact');
Route::get('/developers', 'PagesController@developers');
Route::get('/developers/projects/{param}', 'PagesController@developerProject');
Route::get('/sort', ['uses' => 'PagesController@getLinks', 'as' => 'sort']);
Route::get('/timeframe', ['uses' => 'PagesController@getTimeframeLinks', 'as' => 'timeframe']);

Route::post('/checkName', ['uses' => 'TeamController@checkName']);
/*
|------------------------------------------------------------------------------
| Team routes
|------------------------------------------------------------------------------
*/

Route::group(['prefix' => 'teams'], function () {
    Route::get('/', 'TeamController@index');
    Route::get('/new', ['uses' => 'TeamController@create', 'middleware' => 'auth']);
    Route::get('/invites', ['uses' => 'TeamController@invites', 'middleware' => 'auth']);
    Route::get('/{team}/invite', 'TeamController@invite');
    Route::get('/{team}/invite/{id}', ['uses' => 'TeamController@sendInvite', 'middleware' => 'auth']);
    Route::post('/new', ['uses' => 'TeamController@store', 'as' => 'teams.create']);

    Route::get('/dashboard/{id}', ['uses' => 'TeamController@fromEmail']);
    Route::get('/{team}/dashboard', ['uses' => 'TeamController@show']);
    Route::get('/{team}/settings', ['uses' => 'TeamController@edit']);
    Route::post('/{team}/settings', ['uses' => 'TeamController@update']);
    Route::post('/{team}/avatar', ['uses' => 'TeamController@updateAvatar']);
    Route::get('/delete/{id}', ['uses' => 'TeamController@destroy']);
});

/*
 * Gets Events creation page
 */
Route::get('/meetup/new', [
  'uses' => 'MeetupController@index',
  'as' => 'meetup-form',
  'middleware' => ['auth'],
]);

/*
 * Creates new Events
 */
Route::post('/meetup/new', [
  'uses' => 'MeetupController@create',
  'as' => 'meetup',
  'middleware' => ['auth'],
]);

// Gets meetup FAQ page
Route::get('/meetup/faq', 'MeetupController@faq');

// Gets all approved meetups
Route::get('/meetup/all', 'MeetupController@getApprovedMeetups');

// Gets pending meetups
Route::get('/meetup/pending', 'MeetupController@getPendingMeetups');

// Gets the page to approve a meetup
Route::get('/meetup/pending/{id}', 'MeetupController@getPendingMeetup');

// Approve a meetup
Route::post('/meetup/approve/{id}', 'MeetupController@approve');

//Dashboard Route
Route::get('/dashboard', ['middleware' => 'auth', 'uses' => 'ProjectController@index']);

//Project routes using resource
Route::resource('projects', 'ProjectController');
Route::post('projects/new/{team}', 'ProjectController@storeteam');

Route::get('projects/meta/{id}', ['uses' => 'ProjectController@getMetaAsJSON', 'as' => 'getMetaAsJSON']);
// Confirm before delete
Route::get('project/confirm/{id}', 'ProjectController@confirm');

//like or unlike a project
Route::get('/project/like/{id}', [
    'uses' => 'ProjectLikesController@like',
    'middleware' => ['auth'],
]);

//update project views when a project is viewed
Route::get('/project/view/{id}', 'ProjectViewsController@view');

// Profile settings Route
Route::get('/settings/profile', [
    'uses' => 'ProfileController@getProfileSettings',
    'middleware' => ['auth'],
]);

Route::post('/avatar/setting', [
    'uses' => 'ProfileController@postAvatarSetting',
    'middleware' => ['auth'],
]);

Route::post('/settings/profile', 'ProfileController@updateProfileSettings');

Route::controllers([
    'password' => 'Auth\PasswordController',
]);

// Hire a user
Route::post('hireme', 'ProfileController@hireUser');

// Hire a team
Route::post('hireus', 'TeamController@hireTeam');

// Gets users' profile
Route::get('{username}', [
    'uses' => 'ProfileController@show',
    'as'   => 'userprofile',
]);

//Follow team route
Route::get('/follow/team/{id}', 'TeamController@follow');
Route::get('/unfollow/team/{id}', 'TeamController@unfollow');

// Follow user route
Route::get('/follow/{id}/{me}', 'ProfileController@followUser');

//Unfollow user route
Route::get('/unfollow/{id}/{me}', 'ProfileController@unfollowUser');

//Get Followers route
Route::get('/followers/{id}', 'ProfileController@getFollowers');

//Get Followers route
Route::get('/follows/{id}', 'ProfileController@getFollows');

// To reset user's password
Route::get('/password/email', 'Auth\PasswordController@getEmail');
Route::post('/password/email', 'Auth\PasswordController@postEmail');

Route::get('/password/reset', 'Auth\PasswordController@getReset');
Route::post('/password/reset', 'Auth\PasswordController@postReset');

// Authentication routes...
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('/auth/register', 'Auth\AuthController@getRegister');
Route::post('/auth/register', 'Auth\AuthController@sendMail');

// Social authentication routes...
Route::get('auth/{github}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{github}/callback', 'Auth\AuthController@handleProviderCallback');

// Route::get('auth/{twitter}', 'Auth\AuthController@redirectToProvider');
// Route::get('auth/{twitter}/callback', 'Auth\AuthController@handleProviderCallback');

// Project search
Route::post('/search', 'SearchController@search');

// OAuth form
Route::post('/errors/oauthname', 'Auth\AuthController@postOauth');
Route::get('/errors/oauthname', 'Auth\AuthController@getOauth');

// Make comments on projects
Route::post('/comment/{id}', 'CommentController@makeComment');

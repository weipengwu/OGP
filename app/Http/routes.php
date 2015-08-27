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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function(){
	Route::get('groups/{slug}/events/new', array('uses' => 'EventController@newEvent', 'as' => 'newEvent'));
	Route::get('groups/new', array('uses' => 'GroupController@newGroup', 'as' => 'newGroup'));
	Route::post('groups/{slug}/events/new', array('uses' => 'EventController@createEvent', 'as' => 'createEvent'));
	Route::post('groups/new', array('uses' => 'GroupController@createGroup', 'as' => 'createGroup'));
	Route::get('groups/{slug}/edit', array('uses' => 'GroupController@editGroup', 'as' => 'editGroup'));
	Route::post('event/like', 'EventController@eventLike');
	Route::post('event/unlike', 'EventController@eventUnlike');
	Route::post('post/like', 'PostController@postLike');
	Route::post('post/unlike', 'PostController@postUnlike');
	Route::get('groups/join', array('uses' => 'GroupController@joinGroup', 'as' => 'joinGroup'));
	Route::get('groups/leave', array('uses' => 'GroupController@leaveGroup', 'as' => 'leaveGroup'));
	Route::get('dashboard', array('uses' => 'DashboardController@index','as' => 'dashboard'));
	Route::post('dashboard', array('uses' => 'DashboardController@createProfile','as' => 'createProfile'));
	Route::get('groups/{slug}/posts/new', array('uses' => 'PostController@newPost', 'as' => 'newPost'));
	Route::post('groups/{slug}/posts/new', array('uses' => 'PostController@createPost', 'as' => 'createPost'));
	Route::post('posts/{id}', array('uses' => 'PostController@createComment', 'as' => 'createComment'));
	Route::post('groups/follow', 'GroupController@follow');
	Route::post('groups/unfollow', 'GroupController@unfollow');
	Route::get('groups/{slug}/missions/new', array('uses' => 'MissionController@newMission', 'as' => 'newMission'));
	Route::post('groups/{slug}/missions/new', array('uses' => 'MissionController@createMission', 'as' => 'createMission'));
	Route::get('missions/{id}/apply', array('uses' => 'MissionController@applyMission', 'as' => 'applyMission'));
	Route::post('missions/{id}/apply', array('uses' => 'MissionController@sendResume', 'as' => 'sendResume'));
});

Route::get('events', 'EventController@index');
Route::get('groups', 'GroupController@index');
Route::get('missions', 'MissionController@index');

Route::get('events/{id}', array('uses' => 'EventController@viewEvent', 'as' => 'viewEvent'));

Route::get('groups/{slug}', array('uses' => 'GroupController@viewGroup', 'as' => 'viewGroup'));

Route::get('profiles/{id}', array('uses' => 'ProfileController@viewUser', 'as' => 'viewUser'));

Route::get('posts/{id}', array('uses' => 'PostController@viewPost', 'as' => 'viewPost'));

Route::get('missions/{id}', array('uses' => 'MissionController@viewMission', 'as' => 'viewMission'));

Route::get('search', 'SearchController@search');

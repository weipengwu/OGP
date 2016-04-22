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
Route::get('/auth/login', 'Auth\AuthController@authenticate');
Route::get('/auth/logout', 'Auth\AuthController@logout');

Route::get('/lang/{lang}', 'LangController@switchLang');

Route::group(['middleware' => 'auth'], function(){
	Route::get('brands/{slug}/events/new', array('uses' => 'EventController@newEvent', 'as' => 'newEvent'));
	Route::get('brands/new', array('uses' => 'GroupController@newGroup', 'as' => 'newGroup'));
	//Route::post('brands/{slug}/events/new', array('uses' => 'EventController@createEvent', 'as' => 'createEvent'));
	Route::post('events/new', array('uses' => 'EventController@createEvent', 'as' => 'createEvent'));
	Route::post('brands/new', array('uses' => 'GroupController@createGroup', 'as' => 'createGroup'));
	Route::get('brands/{slug}/edit', array('uses' => 'GroupController@editGroup', 'as' => 'editGroup'));
	// Route::post('brands/{slug}/edit', array('uses' => 'GroupController@editingGroup', 'as' => 'editingGroup'));
	Route::post('brands/edit', array('uses' => 'GroupController@editingGroup', 'as' => 'editingGroup'));
	Route::post('event/like', 'EventController@eventLike');
	Route::post('event/unlike', 'EventController@eventUnlike');
	Route::post('post/like', 'PostController@postLike');
	Route::post('post/unlike', 'PostController@postUnlike');
	Route::get('posts/{id}/delete', 'GroupController@postDelete');
	Route::get('brands/join', array('uses' => 'GroupController@joinGroup', 'as' => 'joinGroup'));
	Route::get('brands/leave', array('uses' => 'GroupController@leaveGroup', 'as' => 'leaveGroup'));
	Route::get('dashboard', array('uses' => 'DashboardController@index','as' => 'dashboard'));
	Route::post('dashboard', array('uses' => 'DashboardController@updateProfile','as' => 'updateProfile'));
	Route::get('changepassword', 'ChangePwdController@changepwdindex');
	Route::post('changepassword', array('uses' => 'ChangePwdController@changePassword','as' => 'changePassword'));
	Route::get('brands/{slug}/posts/new', array('uses' => 'PostController@newPost', 'as' => 'newPost'));
	// Route::post('brands/{slug}/posts/new', array('uses' => 'PostController@createPost', 'as' => 'createPost'));
	Route::post('posts/new', array('uses' => 'PostController@createPost', 'as' => 'createPost'));
	Route::post('posts/{id}', array('uses' => 'PostController@createComment', 'as' => 'createComment'));
	Route::post('brands/follow', 'GroupController@follow');
	Route::post('brands/unfollow', 'GroupController@unfollow');
	Route::post('brands/checkBrandname/', array('uses' => 'GroupController@checkBrandname', 'as' => 'checkBrandname'));
	Route::get('events/{id}/edit', array('uses' => 'EventController@editEvent', 'as' => 'editEvent'));
	Route::get('events/{id}/delete', 'EventController@deleteEvent');
	Route::post('events/edit/{id}', array('uses' => 'EventController@editingEvent', 'as' => 'editingEvent'));
	//Route::get('brands/{slug}/missions/new', array('uses' => 'MissionController@newMission', 'as' => 'newMission'));
	//Route::post('brands/{slug}/missions/new', array('uses' => 'MissionController@createMission', 'as' => 'createMission'));
	//Route::get('missions/{id}/apply', array('uses' => 'MissionController@applyMission', 'as' => 'applyMission'));
	//Route::post('missions/{id}/apply', array('uses' => 'MissionController@sendResume', 'as' => 'sendResume'));
	Route::get('search', 'SearchController@search');
	Route::post('search', array('uses' => 'SearchController@search', 'as' => 'search'));
	Route::post('ogppay', array('uses' => 'EventController@eventCharge', 'as' => 'eventCharge'));

	Route::get('ogppay/success', array('uses' => 'EventController@paySuccess', 'as' => 'paySuccess'));

	Route::get('events/{id}', array('uses' => 'EventController@viewEvent', 'as' => 'viewEvent'));

	Route::get('brands/{slug}', array('uses' => 'GroupController@viewGroup', 'as' => 'viewGroup'));

	Route::get('posts/{id}', array('uses' => 'PostController@viewPost', 'as' => 'viewPost'));

	Route::get('posts/{id}/edit', array('uses' => 'PostController@editPost'));

	Route::post('editposts', array('uses' => 'PostController@editingPost', 'as' => 'editingPost'));

	Route::get('adminogp', 'AdminController@index');

	Route::get('adminogp/users', 'AdminController@users');

	Route::get('adminogp/brands', 'AdminController@brands');

	Route::get('adminogp/posts', 'AdminController@posts');

	Route::get('adminogp/tickets', 'AdminController@tickets');

	Route::post('brand/approve', 'AdminController@approve');

	Route::post('brand/disapprove', 'AdminController@disapprove');

	Route::post('post/feature', 'AdminController@postfeature');

	Route::post('post/unfeature', 'AdminController@postunfeature');
});

Route::get('events', 'EventController@index');
Route::get('brands', 'GroupController@index');
Route::get('brands/category/{cat}', 'GroupController@singleCateogry');
//Route::get('missions', 'MissionController@index');

//Route::get('profiles/{id}', array('uses' => 'ProfileController@viewUser', 'as' => 'viewUser'));
//Route::get('missions/{id}', array('uses' => 'MissionController@viewMission', 'as' => 'viewMission'));


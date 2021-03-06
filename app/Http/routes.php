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

// Authentication (Login/Logout) Route

Route::auth();

// Homepage Route

Route::get('/', function () { return view('home'); });
Route::get('/todo', function () { return view('todo'); });

// Account routes // Auth required

Route::get('/account', 					[ 'uses' => 'AccountController@index', 		'as' => 'account.index' ]);
Route::get('/account/edit', 			[ 'uses' => 'AccountController@edit', 		'as' => 'account.edit' ]);
Route::patch('/account/update', 		[ 'uses' => 'AccountController@update',		'as' => 'account.update' ]);
Route::post('/account/update/avatar', 	[ 'uses' => 'AccountController@update_avatar' ]);
Route::get('/account/notifications', function() { return redirect()->back(); });
Route::resource('account', 'AccountController', [
	'only' => ['index', 'edit', 'update']
]);

// Standards Routes

Route::get('standards/mpacs', [ 'uses' => 'StandardController@showMpacs', 'as' => 'standards.mpacs' ]);
Route::get('standards/big-ideas', [ 'uses' => 'StandardController@showBigIdeas', 'as' => 'standards.big-ideas' ]);
Route::resource('standards', 'StandardController', [
	'only' => ['index', 'show']
]);

Route::group(['middleware' => 'auth'], function() {

	// User Routes
	
	Route::resource('users', 'UserController', [
		'only' => ['index', 'show']
	]);

	// Channel Routes

	Route::get('channels/{channel_id}/restore', 		[ 'uses' => 'ChannelController@restore', 	'as' => 'channels.restore' ]);
	Route::resource('channels', 'ChannelController');
	
	// Discussion Routes

	Route::get('/discussions/popular', 					[ 'uses' => 'DiscussionController@showPopularDiscussions', 		'as' => 'discussions.popular' ]);
	Route::get('/discussions/mycontributions',			[ 'uses' => 'DiscussionController@showMyContributions',			'as' => 'discussions.mycontributions' ]);
	Route::get('/discussions/mine', 					[ 'uses' => 'DiscussionController@showMyDiscussions', 			'as' => 'discussions.mine' ]);
	Route::get('/discussions/channels/{channels}',	 	[ 'uses' => 'DiscussionController@showDiscussionsInChannel',	'as' => 'discussions.channel' ]);
	Route::resource('discussions', 'DiscussionController');

	// Response Routes

	Route::resource('responses', 'ResponseController', [
		'only' => ['store']
	]);

	// Question Routes

	Route::get('questions/standards/{ids}', 			[ 'uses' => 'QuestionController@showQuestionsWithStandards', 		'as' => 'questions.withstandards' ]);
	Route::get('questions/{questions}/pdf', 			[ 'uses' => 'QuestionController@getPdf', 							'as' => 'questions.pdf' ]);
	Route::get('questions/{questions}/printable', 		[ 'uses' => 'QuestionController@showPrintable', 					'as' => 'questions.showprintable' ]);
	Route::resource('questions', 'QuestionController');

	// Comment Routes

	Route::resource('comments', 'CommentController', [
		'only' => ['store']
	]);

	// Search Routes

	Route::get('/search', [
		'uses' => 'SearchController@index',
		'as' => 'search.index',
	]);
	Route::post('/search/results', [
		'uses' => 'SearchController@results',
		'as' => 'search.results',
	]);

	// (un)Like Routes

	Route::get('/questions/{questions}/like', 		[ 'uses' => 'AccountController@like',	'as' => 'questions.like' ]);
	Route::get('/questions/{questions}/unlike',		[ 'uses' => 'AccountController@unlike', 'as' => 'questions.unlike' ]);
	Route::get('/comments/{comments}/like', 		[ 'uses' => 'AccountController@like', 	'as' => 'comments.like' ]);
	Route::get('/comments/{comments}/unlike',		[ 'uses' => 'AccountController@unlike', 'as' => 'comments.unlike' ]);
	Route::get('/discussions/{discussions}/like',	[ 'uses' => 'AccountController@like', 	'as' => 'discussions.like' ]);
	Route::get('/discussions/{discussions}/unlike',	[ 'uses' => 'AccountController@unlike', 'as' => 'discussions.unlike' ]);
	Route::get('/responses/{responses}/like', 		[ 'uses' => 'AccountController@like', 	'as' => 'responses.like' ]);
	Route::get('/responses/{responses}/unlike',		[ 'uses' => 'AccountController@unlike', 'as' => 'responses.unlike' ]);

	// Favorite Route

	Route::get('favorites/toggle/{id}', [
		'uses' => 'AccountController@toggleFavorite',
		'as' => 'favorite.toggle'
	]);
});

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

Route::get('/', 'HomeController@index');


Auth::routes();

// ****************************************************************************************
// page route

Route::get('/community/create', 'PageController@createcommunity')->name('communitycreateform');

Route::get('/post/image/upload', 'PageController@post_image_upload')->name('post.image.upload');

Route::get('/post/video/upload', 'PageController@post_video_upload')->name('post.video.upload');

// ****************************************************************************************

Route::get('/signuppagetwo', 'signupTwoController@index')->name('home');

Route::post('/signuppagetwo/fetch', 'signupTwoController@fetch')->name('interest.fetch');

Route::post('/signuppagetwo/all', 'signupTwoController@all')->name('interest.all');

Route::post('/signuppagetwo/add', 'signupTwoController@add')->name('interest.add');

Route::post('/signuppagetwo/remove', 'signupTwoController@remove')->name('interest.remove');

// ****************************************************************************************

Route::get('/signuppagethree', 'SignUpCommunityJoin@index')->name('group.display');

Route::post('/signuppagethree/all', 'SignUpCommunityJoin@all')->name('group.all');

Route::post('/signuppagethree/add', 'SignUpCommunityJoin@add')->name('group.add');

Route::post('/signuppagethree/remove', 'SignUpCommunityJoin@remove')->name('group.remove');

// ****************************************************************************************
// creating community

Route::post('/community', 'CommunityController@index')->name('community.display');

Route::post('/community/create', 'CommunityController@create')->name('community.create');

Route::post('/community/edit', 'CommunityController@add')->name('community.edit');

Route::post('/community/delete', 'CommunityController@remove')->name('community.remove');

// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

Route::post('/community/form', 'CommunityController@listsubcategory')->name('community.listsubcategory');

// ****************************************************************************************
Route::post('/post/video/upload', 'VideoController@store')->name('post.video.uploadp');


// ****************************************************************************************

Route::post('/post/image/upload', 'ImageController@store')->name('post.image.uploadp');



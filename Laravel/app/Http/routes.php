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



Route::auth();
Route::get('/', function () {
    return view('welcome');

});
Route::get('/home', [
    'uses'=>'PostController@index',
    'as'=>'home'
]);

Route::post('/createpost',[
    'uses'=>'PostController@postCreatePost',
    'as'=>'post.create'
]);
Route::get('/delete-post/{post_id}', [
    'uses'=>'PostController@getDeletePost',
    'as'=>'post.delete',
    'middleware'=>'auth'
]);

Route::get('/logout', [
    'uses'=>'HomeController@getLogout',
    'as'=>'logout',
    'middleware'=>'auth'
]);

//Route::post('/edit',function(\Illuminate\Http\Request $request) {
//return response()->json(['message'=>$request['postId']]);

//})->name('edit');

Route::post('/edit',[
   'uses'=>'PostController@postEditPost',
    'as'=>'edit'
]);
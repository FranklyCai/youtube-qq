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

use App\Mail\SendEmailMailable;
use Illuminate\Support\Facades\Mail;

//Route::get('/', function () {
//    return view('index');
//});
Route::get('/upload',function(){
    return view('upload');
})->middleware('auth');

Route::post('upload'
    ,'UploadController@upload')->name('upload');


// Route::get('sendmail',function(){
// 	Mail::to('example@example.com')->send(new SendEmailMailable());
// 	return '邮件发送成功';
// });

Auth::routes();

Route::get('/','IndexController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin','AdminController@index');

Route::get('/video/{id}','VideoController@showVideo');

Route::post('/video/{id}','VideoController@comment');

Route::get('/avatar',function(){
    return view('avatar');
})->middleware('auth')->name('avatar');
Route::post('/avatar','AvatarController@process');

//Route::get('test','TestController@test');

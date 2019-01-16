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


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users','UsersController');

Route::get('/',"StaticPagesController@home")->name('home');
Route::get('/help',"StaticPagesController@help")->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('signup',"UsersController@create")->name('signup');
//账户激活
Route::get('signup/confirm/{token}',"UsersController@confirmEmail")->name('confirm_email');

//用户登录 注销
Route::get('login','SessionsController@create')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::delete('logout','SessionsController@destroy')->name('logout');
//用户找回密码操作
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');
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

Route::get('/', function () {
    return view('admin.layout.master');
});

Route::get("/dev", function () {

//    \Spatie\Permission\Models\Role::create([
//        'name' => 'admin'
//    ]);

    return request()->path() == "dev";

    $user = \App\User::all()[0];

    return $user->assignRole('admin');
});

Route::group(['prefix' => 'admin2', 'middleware' => 'role:admin', 'as' => 'admin.'], function () {

    Route::get('/', 'Admin\AdminController@dashboard')->name('dashboard');
    Route::resource('category', 'CategoryController');

});

Route::get('product');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

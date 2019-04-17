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
Route::get('/index', 'EventsController@index');

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/reports', 'ReceiptsController@reports');
Route::post('/getreports', 'ReceiptsController@getreports');
Route::get('/recpconfirm', function () {
    return view('recpconfirm');
});
Route::get('/viewdon', function () {
    return view('viewdon');
});
Route::get('/events/create', 'EventsController@create');
Route::post('/events', 'EventsController@store');

use App\Donors;
/*Route::post('/search','DonorsController@store');
Route::post('/query','DonorsController@create');
Route::get('/search/{id}', 'DonorsController@show');
Route::get('/edit/{id}', 'DonorsController@edit');*/
Route::resource('/donors','DonorsController');
use App\Receipts;
Route::resource('/receipts','ReceiptsController');
/*
Route::post('/recp', 'ReceiptsController@show');
Route::post('/recpgen', 'ReceiptsController@create');

*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;

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


Route::group(['prefix' => 'panel', 'namespace' => 'admin'], function() {	
	Route::get('login','LoginController@getLogin')->name('getLogin');
	Route::post('login','LoginController@postLogin')->name('postLogin');
	Route::get('logout','LoginController@getLogout')->name('getLogout');
});

Route::group(['middleware' => 'CheckAdminLogin','prefix' => 'panel'], function() {
	Route::get('/', function() {return view('admin.home');})->name('welcome');
});

Route::group(['middleware' => 'CheckAdminLogin','prefix' => 'panel/user', 'namespace' => 'admin'], function() {
	Route::get('/','UserController@index')->name('user.index');
	Route::get('/create','UserController@create')->name('user.create');
	Route::post('/','UserController@store')->name('user.store');
	Route::get('{id}','UserController@edit')->name('user.edit');
	Route::post('{id}','UserController@update');
	Route::get('delete/{id}','UserController@delete')->name('user.delete');
});

Route::group(['middleware' => 'CheckAdminLogin','prefix' => 'panel','namespace' => 'admin'], function() {
	Route::resource('product',ProductController::class);
	Route::resource('category',CategoryController::class);
	Route::get('category/productlist/{id}', 'CategoryController@productlist')->name('category.productlist');
	// Route::resource('categoryNews',CategoryNews::class);
});

Route::group(['prefix' => 'product', 'namespace' => 'FrontEnd'], function() {
	Route::get('/', 'ProductsController@index');
	Route::get('cart', 'ProductsController@cart');
	Route::post('add-to-cart/{id}', 'ProductsController@addToCart')->name('add-to-cart');
	Route::patch('update-cart', 'ProductsController@update')->name('update-cart');
	Route::delete('remove-from-cart-1', 'ProductsController@remove')->name('remove-from-cart');
});

Route::group(['prefix' => 'home', 'namespace' => 'FrontEnd'], function() {
	//Route::get('/', function() {return view('FrontEnd.home.home');})->name('home');
	Route::get('/', 'HomeController@index')->name('home');
});

Route::post('/order', [OrderController::class, 'store'])->name('order.create');
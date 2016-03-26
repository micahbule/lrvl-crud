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

Route::get('/', function () {
    return view('welcome');
});

Route::get('inventory', 'InventoryController@index');
Route::post('inventory', 'InventoryController@save');

Route::get('fruit/deleted', ['uses' => 'FruitController@deleted', 'as' => 'fruit.deleted']);
Route::get('store/deleted', ['uses' => 'StoreController@deleted', 'as' => 'store.deleted']);

Route::resource('fruit', 'FruitController');
Route::resource('store', 'StoreController');

Route::group(['prefix' => 'api'], function () {
	Route::get('fruit', 'FruitController@apiIndex');
	
	Route::get('store', 'StoreController@apiIndex');
	Route::get('store/{id}/details', 'StoreController@apiGetDetails');
});

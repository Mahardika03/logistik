<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);

//message-type
Route::get('message-type', [App\Http\Controllers\MessageTypeController::class, 'index'])->name('message-type');//route to page
Route::get('message-type-data', [App\Http\Controllers\MessageTypeController::class, 'show']);//get data message type
Route::post('add-message-type-data', [App\Http\Controllers\MessageTypeController::class, 'store']);//create message type data
Route::get('get-message-type-data/{id}', [App\Http\Controllers\MessageTypeController::class, 'edit']);//get select message type data
Route::put('update-message-type-data/{id}', [App\Http\Controllers\MessageTypeController::class, 'update']);//update message type data
Route::delete('delete-message-type-data/{id}', [App\Http\Controllers\MessageTypeController::class, 'destroy']);//delete message type data

//routing product
Route::get('product', [App\Http\Controllers\ProductController::class, 'index']);//access product page
Route::post('add-product-data', [App\Http\Controllers\ProductController::class, 'store']);//stored product data
Route::get('product-data', [App\Http\Controllers\ProductController::class, 'show']);//get product data
Route::delete('delete-product-data/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);//delete product data
Route::get('get-product-data/{id}', [App\Http\Controllers\ProductController::class, 'edit']);//get selected product data
Route::put('update-product-data/{id}', [App\Http\Controllers\ProductController::class, 'update']);//update selected product data

//routing addresses
Route::get('addresses', [App\Http\Controllers\AddressesController::class, 'index']);//access addresses page
Route::get('addresses-data', [App\Http\Controllers\AddressesController::class, 'show']);//get addresses data
Route::post('add-address-data', [App\Http\Controllers\AddressesController::class, 'store']);//store address data
Route::delete('delete-address-data/{id}', [App\Http\Controllers\AddressesController::class, 'destroy']);//delete address data
Route::get('get-address-data/{id}', [App\Http\Controllers\AddressesController::class, 'edit']);//get selected address data
Route::put('update-address-data/{id}', [App\Http\Controllers\AddressesController::class, 'update']);//update selected address data

//routing location type
Route::get('location-type', [App\Http\Controllers\LocationTypeController::class, 'index']);//access location type page
Route::get('location-type-data', [App\Http\Controllers\LocationTypeController::class, 'show']);//get location type data
Route::post('add-location-type-data', [App\Http\Controllers\LocationTypeController::class, 'store']);//store location type data
Route::delete('delete-location-type-data/{id}', [App\Http\Controllers\LocationTypeController::class, 'destroy']);//delete location type data
Route::get('get-location-type-data/{id}', [App\Http\Controllers\LocationTypeController::class, 'edit']);//get selected location type data
Route::put('update-location-type-data/{id}', [App\Http\Controllers\LocationTypeController::class, 'update']);//update selected location type data
Auth::routes();

//routing location
Route::get('location', [App\Http\Controllers\LocationController::class, 'index']);//access location page
Route::get('location-data', [App\Http\Controllers\LocationController::class, 'show']);//get location data
Route::post('add-location-data', [App\Http\Controllers\LocationController::class, 'store']);//store location data
Route::delete('delete-location-data/{id}', [App\Http\Controllers\LocationController::class, 'destroy']);//delete location data
Route::get('get-location-data/{id}', [App\Http\Controllers\LocationController::class, 'edit']);//get selected location data
Route::put('update-location-data/{id}', [App\Http\Controllers\LocationController::class, 'update']);//update selected location data

//routing shipment
Route::get('shipments', [App\Http\Controllers\ShipmentController::class, 'index']);//access shipment page
Route::get('shipments-data', [App\Http\Controllers\ShipmentController::class, 'show']);//get shipment data
Route::post('add-shipments-data', [App\Http\Controllers\ShipmentController::class, 'store']);//create shipment data
Route::delete('delete-shipments-data/{id}', [App\Http\Controllers\ShipmentController::class, 'destroy']);//delete shipment data

//routing message
Route::get('message', [App\Http\Controllers\MessageController::class, 'index']);//access message page
Route::get('message-data', [App\Http\Controllers\MessageController::class, 'show']);//get message data
Route::post('add-message-data', [App\Http\Controllers\MessageController::class, 'store']);//create message data
Route::get('get-message-data/{id}', [App\Http\Controllers\MessageController::class, 'edit']);//get specified message data
Route::put('update-message-data/{id}', [App\Http\Controllers\MessageController::class, 'update']);//update message data
Route::delete('delete-message-data/{id}', [App\Http\Controllers\MessageController::class, 'destroy']);//delete message data


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

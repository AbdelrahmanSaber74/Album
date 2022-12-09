<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

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

// Start AlbumController Route

Route::controller(AlbumController::class)->group(function () {

route::get('/' , 'index')->name('index');
route::get('images_album/{id}' ,  'imagesAlbum')->name('images_album');
route::get('store' , 'store')->name('album_store');
route::post('update' , 'update')->name('album_update');
route::post('album/destory' , 'destory')->name('album_destory');
route::post('album/destory' , 'destory')->name('album_destory');
route::post('album/transfer' , 'transfer')->name('transfer');

});

// End AlbumController Route

route::post('store_img' , [ImageController::class, 'storeImg'])->name('store_img');


route::get('{page}' , [AdminController::class ,'index']);


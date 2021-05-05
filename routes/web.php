<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\todayflight;
use \App\Http\Controllers\putshelf;

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
    return view('welcome');
});

Route::get('/today',[todayflight::class,'index'])->name('today');

Route::get('/putshelf',[putshelf::class,'index'])->name('putshelf');

Route::get('/flight',[\App\Http\Controllers\buyticket::class,'buyticket']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('flights', todayflight::class)->only('index');

Route::resource('putshelfs', putshelf::class);


//Route::resource("visitororder",\App\Http\Controllers\VisitorOrder::class);

// Route::get($uri, $callback);
// Route::post($uri, $callback);
// Route::put($uri, $callback);
// Route::patch($uri, $callback);
// Route::delete($uri, $callback);
// Route::options($uri, $callback);
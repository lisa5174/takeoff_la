<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\todayflight;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[todayflight::class,'index'])->name('today');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/flight',[\App\Http\Controllers\buyticket::class,'buyticket']);

Route::resource('flights', todayflight::class);

//Route::resource("visitororder",\App\Http\Controllers\VisitorOrder::class);

// Route::get($uri, $callback);
// Route::post($uri, $callback);
// Route::put($uri, $callback);
// Route::patch($uri, $callback);
// Route::delete($uri, $callback);
// Route::options($uri, $callback);
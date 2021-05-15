<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\todayflight;
use \App\Http\Controllers\putshelf;
use \App\Http\Controllers\offshelf;
use \App\Http\Controllers\search;
use \App\Http\Controllers\updateflight;

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
Route::get('/offshelf',[offshelf::class,'index'])->name('offshelf');
// Route::post('/putshelf/date',[putshelf::class,'date']);
// Route::get('/putshelf/date',[putshelf::class,'date']);

Route::get('/search',[search::class,'index']);
Route::post('/search',[search::class,'store']);

Route::get('/updateflights',[updateflight::class,'index']);
Route::post('/updateflights',[updateflight::class,'store']);
Route::get('/updateflights/{updateflight}/edit',[updateflight::class,'edit'])
->where('updateflight', '[0-9]+')->name('updateflight.edit');
Route::put('/updateflights/{updateflight}',[updateflight::class,'update'])
->name('updateflight.update');
//這裡有命名，就可以在view用route('updateflight.update',$aaa)

Route::get('/flight',[\App\Http\Controllers\buyticket::class,'buyticket']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('flights', todayflight::class)->only('index');
Route::resource('putshelfs', putshelf::class)->only('index','store');
Route::resource('offshelfs', offshelf::class)->only('index','store');



// Route::get($uri, $callback);
// Route::post($uri, $callback);
// Route::put($uri, $callback);
// Route::patch($uri, $callback);
// Route::delete($uri, $callback);
// Route::options($uri, $callback);
<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\todayflight;
use \App\Http\Controllers\putshelf;
use \App\Http\Controllers\offshelf;
use \App\Http\Controllers\search;
use \App\Http\Controllers\updateflight;

use \App\Http\Controllers\be_homepage;
use \App\Http\Controllers\be_choose;
use \App\Http\Controllers\be_order;
use \App\Http\Controllers\be_pay;
use \App\Http\Controllers\be_finish;
use \App\Http\Controllers\be_register;
use \App\Http\Controllers\be_login;
use \App\Http\Controllers\be_member;
use \App\Http\Controllers\be_service_introdution;
use \App\Http\Controllers\be_team_introdution;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/today',[todayflight::class,'index'])->name('today');
Route::get('/putshelf',[putshelf::class,'index'])->name('putshelf');
Route::get('/offshelf',[offshelf::class,'index'])->name('offshelf');
Route::post('/offshelf',[offshelf::class,'off'])->name('offshelfs.off');
// Route::post('/putshelf/date',[putshelf::class,'date']);
// Route::get('/putshelf/date',[putshelf::class,'date']);

Route::get('/search',[search::class,'index']);
Route::post('/search',[search::class,'store']);

Route::get('/updateflights',[updateflight::class,'index'])->name('updateflight.index');
Route::post('/updateflights',[updateflight::class,'store']);
Route::get('/updateflights/{editflight}/edit',[updateflight::class,'edit'])
->where('editflight', '[0-9]+')->name('updateflight.edit');
Route::put('/updateflights/{updateflight}',[updateflight::class,'update'])
->where('updateflight', '[0-9]+')->name('updateflight.update');
//這裡有命名，就可以在view用route('updateflight.update',$aaa)


Route::resource('flights', todayflight::class)->only('index');
Route::resource('putshelfs', putshelf::class)->only('index','store');
Route::resource('offshelfs', offshelf::class)->only('index','store','off');


Route::get('/flight',[\App\Http\Controllers\buyticket::class,'buyticket']);


Route::resource('homepage', be_homepage::class)->only('index','store');
Route::resource('choose', be_choose::class)->only('index','edit');
Route::resource('order', be_order::class)->only('index');
Route::resource('pay', be_pay::class)->only('index');
Route::resource('finish', be_finish::class)->only('index');
Route::resource('register', be_register::class)->only('index');
Route::resource('login', be_login::class)->only('index');
Route::resource('member', be_member::class)->only('index');
Route::resource('serviceIntroduction', be_service_introdution::class)->only('index');
Route::resource('teamIntroduction', be_team_introdution::class)->only('index');


// Route::get($uri, $callback);
// Route::post($uri, $callback);
// Route::put($uri, $callback);
// Route::patch($uri, $callback);
// Route::delete($uri, $callback);
// Route::options($uri, $callback);
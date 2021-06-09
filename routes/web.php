<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\login;
use \App\Http\Controllers\todayflight;
use \App\Http\Controllers\putshelf;
use \App\Http\Controllers\offshelf;
use \App\Http\Controllers\search;
use \App\Http\Controllers\updateflight;
use \App\Http\Controllers\updateticket;

use \App\Http\Controllers\be_homepage;
use \App\Http\Controllers\be_choose;
use \App\Http\Controllers\be_order;
use \App\Http\Controllers\be_pay;
use \App\Http\Controllers\be_finish;
use \App\Http\Controllers\be_register;
use \App\Http\Controllers\be_login;
use \App\Http\Controllers\be_member;
use \App\Http\Controllers\be_membersearch;
use \App\Http\Controllers\be_resetpw;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


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

Route::resource('aflogin', login::class)->only('index');
Route::resource('flights', todayflight::class)->only('index');
Route::resource('putshelfs', putshelf::class)->only('index','store');
Route::resource('offshelfs', offshelf::class)->only('index','store','off');
Route::resource('updateticket', updateticket::class)->only('index');


// Route::get('/flight',[\App\Http\Controllers\buyticket::class,'buyticket']);//沒用到



Route::resource('homepage', be_homepage::class)->only('index','store');
Route::get('/choose2',[be_choose::class,'index2'])->name('choose.index2'); //有回程
// Route::get('/choose2',[be_choose::class,'index2'])->name('choose.index2'); //有回程

Route::resource('choose', be_choose::class)->only('index','index2');
Route::get('/order2',[be_order::class,'index2'])->name('order.index2'); //有回程

Route::resource('order', be_order::class)->only('index','index2');
Route::resource('pay', be_pay::class)->only('index');
Route::resource('finish', be_finish::class)->only('index');
Route::resource('register', be_register::class)->only('index');

Route::resource('login', be_login::class)->only('index','login','logout');
Route::post('/login',[be_login::class,'login'])->name('login.login');
Route::get('/logout',[be_login::class,'logout'])->name('login.logout');


Route::resource('member', be_member::class)->only('index','editmember','editpassenger','editcontact','editpay',
'updatemember','updatepassenger','updatecontact','updatepay')->middleware('userAuth');

Route::get('/editmember',[be_member::class,'editmember'])->name('member.editmember');
Route::get('/editpassenger',[be_member::class,'editpassenger'])->name('member.editpassenger');
Route::get('/editcontact',[be_member::class,'editcontact'])->name('member.editcontact');
Route::get('/editpay',[be_member::class,'editpay'])->name('member.editpay');
Route::post('/updatemember',[be_member::class,'updatemember'])->name('member.updatemember');
Route::post('/updatepassenger',[be_member::class,'updatepassenger'])->name('member.updatepassenger');
Route::post('/updatecontact',[be_member::class,'updatecontact'])->name('member.updatecontact');
Route::post('/updatepay',[be_member::class,'updatepay'])->name('member.updatepay');


Route::resource('membersearch', be_membersearch::class)->only('index');
Route::resource('resetpw', be_resetpw::class)->only('index');
Route::resource('serviceIntroduction', be_service_introdution::class)->only('index');
Route::resource('teamIntroduction', be_team_introdution::class)->only('index');

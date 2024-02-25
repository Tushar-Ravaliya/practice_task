<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Blogcontroller;
use App\Http\Controllers\Homecontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(session()->has('email')){
        return redirect()->route('home');
    }
    return view('login');
});
Route::view('admin.userlist','admin.userlist');
Route::get('showdata',[Admincontroller::class,'showdata']);
Route::view('register','register');
Route::get('home',[Homecontroller::class,'show_blogs'])->name('home');
// Route::view('addblogs','addblogs');
Route::get('feth_cat',[Admincontroller::class,'feth_cat']);
Route::post('addcat_action',[Admincontroller::class,'add_catagories']);
Route::post('register_data',[Authcontroller::class,'register']);
Route::post('login_action',[Authcontroller::class,'login']);
Route::get('logout', [Authcontroller::class,'logout']);
Route::get('account_activation/{email}', [Authcontroller::class, 'account_activation']);

Route::resource('blogs',Blogcontroller::class);

<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
//use App\Http\Controllers\LoginController;

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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/',[HomeController::class,'index'])->name('home');


Route::group(['account'], function(){
    //Guest Routes
    Route::group(['middleware' => 'guest'], function(){
        Route::get('/account/register',[AccountController::class,'registration'])->name('account.register');
        Route::post('/account/process-process',[AccountController::class,'processRegistration'])->name('account.processRegistration');
        Route::get('/account/login',[AccountController::class,'login'])->name('account.login');
        Route::post('/account/authenticate',[AccountController::class,'authenticate'])-> name('account.authenticate');
    });

    //Authenticated Routes
    Route::group(['middleware' => 'auth'], function(){
        Route::get('account/profile', [AccountController::class,'profile'])->name('account.profile');
        Route::get('account/logout', [AccountController::class,'logout'])->name('account.logout');
    });
});
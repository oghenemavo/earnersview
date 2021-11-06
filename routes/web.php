<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\User\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('how-it-works', function () {
    return view('how-it-works');
});
Route::get('faq', function () {
    return view('faq');
});
Route::get('contact', function () {
    return view('contact');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/**
 * User Routes
 */
Route::name('user.')->group(function() {
    Route::middleware(['guest'])->group(function() {

    });

    Route::middleware(['auth'])->group(function() {
        Route::view('home', 'user.dashboard.index')->name('dashboard');

        Route::get('settings', [UserController::class, 'settings'])->name('settings');
        Route::put('change/settings', [UserController::class, 'changeSettings'])->name('change.settings');
        
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::put('update/profile', [UserController::class, 'updateProfile'])->name('update.profile');
        Route::get('edit/account', [UserController::class, 'account'])->name('account');
        Route::put('update/account', [UserController::class, 'updateAccount'])->name('update.account');
    });

});


Route::prefix('ajax')->name('ajax.')->group(function() {
    Route::get('validate/email', [AjaxController::class, 'unique_email'])->name('validate.email');
});
<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Models\Video;
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
    $data['page_title'] = 'Home - Earner\'s View';
    $data['videos'] = Video::all();
    return view('welcome', $data);
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
    Route::middleware(['guest:web', 'prevent_cached_history'])->group(function() {

    });

    Route::middleware(['auth:web', 'prevent_cached_history'])->group(function() {
        Route::view('home', 'user.dashboard.index')->name('dashboard');

        Route::get('settings', [UserController::class, 'settings'])->name('settings');
        Route::put('change/settings', [UserController::class, 'changeSettings'])->name('change.settings');
        
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::put('update/profile', [UserController::class, 'updateProfile'])->name('update.profile');
        Route::get('edit/account', [UserController::class, 'account'])->name('account');
        Route::put('update/account', [UserController::class, 'updateAccount'])->name('update.account');
    });

});


/**
 * Admin Routes
 */
Route::prefix('admin')->group(function() {
    Route::name('admin.')->group(function() {
        Route::middleware(['guest:admin', 'prevent_cached_history'])->group(function() {
            Route::get('/login', [AuthController::class, 'login'])->name('login');
            Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
        });
    
        Route::middleware(['auth:admin', 'prevent_cached_history'])->group(function() {
            Route::get('logout', [AuthController::class, 'logout'])->name('logout');
            Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
            Route::get('settings', [AdminController::class, 'settings'])->name('settings');
            Route::put('update/password', [AdminController::class, 'updatePassword'])->name('update.password');
            Route::put('update/email', [AdminController::class, 'emailPassword'])->name('update.email');
            
            Route::get('manage/users', [AdminController::class, 'users'])->name('users');
            Route::put('suspend/user', [AdminController::class, 'suspendUser'])->name('suspend.user');
            Route::put('activate/user', [AdminController::class, 'activateUser'])->name('activate.user');
            
            // Media
            Route::prefix('media')->name('media.')->group(function() {
                Route::get('categories', [MediaController::class, 'categories'])->name('categories');
                Route::post('create/category', [MediaController::class, 'createCategory'])->name('create.category');
                Route::put('edit/category/{category?}', [MediaController::class, 'editCategory'])->name('edit.category');

                // videos
                Route::get('videos', [MediaController::class, 'videos'])->name('videos');
                Route::post('create/video', [MediaController::class, 'createVideo'])->name('create.video');
                Route::get('edit/video/{video?}', [MediaController::class, 'editVideo'])->name('edit.video');
                Route::put('update/video/{video}', [MediaController::class, 'updateVideo'])->name('update.video');
                Route::put('block/video', [MediaController::class, 'blockVideo'])->name('block.video');
                Route::put('unblock/video', [MediaController::class, 'unblockVideo'])->name('unblock.video');
                
                // promotion
                Route::get('promotions', [PromotionController::class, 'index'])->name('promotions');
                Route::post('create/promotion', [PromotionController::class, 'createPromotion'])->name('create.promotion');
                Route::get('edit/promotion/{promotion?}', [PromotionController::class, 'editPromotion'])->name('edit.promotion');
                Route::put('update/promotion/{promotion}', [PromotionController::class, 'updatePromotion'])->name('update.promotion');
                Route::put('block/promotion', [PromotionController::class, 'blockPromotion'])->name('block.promotion');
                Route::put('unblock/promotion', [PromotionController::class, 'unblockPromotion'])->name('unblock.promotion');
            });

        });
    });
});


Route::prefix('ajax')->name('ajax.')->group(function() {
    Route::get('validate/email', [AjaxController::class, 'uniqueEmail'])->name('validate.email');
    Route::post('validate/bank_account', [AjaxController::class, 'checkAccount'])->name('validate.bank_account');
    Route::get('validate/category', [AjaxController::class, 'uniqueCategory'])->name('validate.media.category');

    Route::prefix('get')->group(function() {
        Route::get('all/users', [AjaxController::class, 'allUsers'])->name('get.all.users');
        Route::get('all/categories', [AjaxController::class, 'allCategories'])->name('get.all.categories');
        Route::get('all/videos', [AjaxController::class, 'allVideos'])->name('get.all.videos');
        Route::get('all/promotions', [AjaxController::class, 'allPromotions'])->name('get.all.promotions');
    });
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\SourceController as AdminSourceController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\YandexSocialController;
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

//auth
Route::group(['middleware' => 'auth'], function() {
    Route::get('/account', AccountController::class)
        ->name('account');
    Route::get('/logout', function (){
        \Auth::logout();
        return redirect()->route('login');
    })
        ->name('logout');

    //admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('/', AdminController::class)
            ->name('index');
        Route::get('/parser', ParserController::class)
            ->name('parser');
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('sources', AdminSourceController::class);
        Route::resource('news', AdminNewsController::class);
        Route::resource('orders', AdminOrderController::class);
        Route::resource('feedback', AdminFeedbackController::class);
        Route::resource('users', AdminUserController::class);
    });
});



//news
Route::get('/news', [NewsController::class, 'index'])
	->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])
	->where('id', '\d+')
	->name('news.show');

//order
Route::resource('order', OrderController::class);

//feedback
Route::resource('feedback', FeedbackController::class);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/vk/start', [SocialController::class, 'start'])
        ->name('vk.start');
    Route::get('/vk/callback', [SocialController::class, 'callback'])
        ->name('vk.callback');

    Route::get('/yandex/start', [YandexSocialController::class, 'start'])
        ->name('yandex.start');
    Route::get('/yandex/callback', [YandexSocialController::class, 'callback'])
        ->name('yandex.callback');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

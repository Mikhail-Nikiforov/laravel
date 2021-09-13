<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
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

//admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
   Route::resource('categories', AdminCategoryController::class);
   Route::resource('news', AdminNewsController::class);
});

//news
Route::get('/news', [NewsController::class, 'index'])
	->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])
	->where('id', '\d+')
	->name('news.show');
Route::post('/feedback', function () {
    return redirect('news')->with('status', 'Форма успешно отправлена!');
})
    ->name('feedback');

Route::get('/order', [OrderController::class, 'index'])
    ->name('order');
Route::post('/order/new', [OrderController::class, 'doOrder'])
    ->name('order.new');



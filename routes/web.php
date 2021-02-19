<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;

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
    return view('pages.public.login');
});
Route::post('/login-auth', [PublicController::class, 'loginAuth']);
Route::get('/logout', [PublicController::class, 'logout']);


Route::group(['middleware' => 'auth:admin' ], function(){
    Route::get('/dashboard', function () {
        return view('pages.dashboard.dashboard');
    });
    Route::get('/admin-list', [AdminController::class, 'getAllAdmin']);
    Route::get('/status-change/{id}/{status}', [AdminController::class, 'changeStatus']);
    Route::get('/super-change/{id}/{status}', [AdminController::class, 'changeSuper']);

    /* Product */

    Route::prefix('product')->group(function () {
        Route::get('/add-new', [ProductController::class, 'addNew']);
        Route::post('/save-product', [ProductController::class, 'saveProduct']);
        Route::get('/add-images', [ProductController::class, 'addImages'])->middleware('isproductsaved');
    });

    Route::prefix('brand')->group(function () {
        Route::post('/save-brand', [SettingController::class, 'saveBrand']);
        Route::post('/save-type', [SettingController::class, 'saveType']);
        Route::post('/save-subtype', [SettingController::class, 'saveSubType']);
    });

});



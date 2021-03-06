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

    /* Admin */

    Route::get('/admin-list', [AdminController::class, 'getAllAdmin']);
    Route::get('/status-change/{id}/{status}', [AdminController::class, 'changeStatus']);
    Route::get('/super-change/{id}/{status}', [AdminController::class, 'changeSuper']);
    Route::post('/save-admin', [AdminController::class, 'saveAdmin']);

    /* Product */

    Route::prefix('product')->group(function () {
        Route::get('/add-new', [ProductController::class, 'addNew']);
        Route::post('/save-product', [ProductController::class, 'saveProduct']);
        Route::get('/add-images', [ProductController::class, 'addImages'])->middleware('isproductsaved');
        Route::post('/save-images', [ProductController::class, 'saveImages']);
        Route::get('/all-active-products', [ProductController::class, 'getAllActiveProducts']);
    });

    /* Seeting*/

    Route::prefix('setting')->group(function () {
        Route::post('/save-brand', [SettingController::class, 'saveBrand']);
        Route::post('/save-type', [SettingController::class, 'saveType']);
        Route::post('/save-subtype', [SettingController::class, 'saveSubType']);
        Route::post('/save-color', [SettingController::class, 'saveColor']);
        Route::post('/save-size', [SettingController::class, 'saveSize']);
        Route::get('/brand', [SettingController::class, 'getAllBrands']);
        Route::get('/delete-brand/{id}', [SettingController::class, 'deleteBrand']);
        Route::get('/statuschange-brand/{id}/{status}', [SettingController::class, 'brandStatusChange']);
        Route::get('/type', [SettingController::class, 'getAllTypes']);
        Route::get('/delete-type/{id}', [SettingController::class, 'deleteType']);
        Route::get('/statuschange-type/{id}/{status}', [SettingController::class, 'typeStatusChange']);
        Route::get('/subtype', [SettingController::class, 'getAllSubTypes']);
        Route::get('/delete-subtype/{id}', [SettingController::class, 'deleteSubType']);
        Route::get('/statuschange-subtype/{id}/{status}', [SettingController::class, 'subTypeStatusChange']);
        Route::get('/color', [SettingController::class, 'getAllColors']);
        Route::get('/delete-color/{id}', [SettingController::class, 'deleteColor']);
        Route::get('/statuschange-color/{id}/{status}', [SettingController::class, 'colorStatusChange']);
        Route::get('/size', [SettingController::class, 'getAllSizes']);
        Route::get('/delete-size/{id}', [SettingController::class, 'deleteSize']);
        Route::get('/statuschange-size/{id}/{status}', [SettingController::class, 'sizeStatusChange']);
    });

});



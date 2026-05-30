<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('user')->controller(UserController::class)->group(function () {

    Route::post('/register', 'Register');
    Route::post('/login', 'Log_in');
    Route::post('logout', 'Log_out')->middleware('auth:sanctum');
});

Route::prefix('profile')->controller(ProfileController::class)->middleware('auth:sanctum')->group(function () {

    Route::get('/my_profile', 'display_profile');
    //Route::get('/get_Profile/{id}','show');قيد المراجعة
    Route::put('/update_profile', 'update_profile');
    Route::post('/update_image', 'update_profile_image');
    Route::delete('/delete_profile', 'distroy');
    Route::post('/addCatigory/{catigory_id}', 'attach_Catigory');
});

Route::prefix('product')->controller(ProductController::class)->middleware('auth:sanctum')->group(function () {
    
Route::post('/add_product/phone',[ProductController::class,'AddPhone']);
Route::post('/add_product/laptop',[ProductController::class,'AddLaptop']);
Route::post('/add_product/accessory',[ProductController::class,'AddAccessory']);

Route::put('/update_product/{product_id}','update_product');
Route::post('/update_image/{product_id}','update_product_image');
Route::delete('/delete_product/{product_id}','distroy');
Route::get('/my_products',[ProductController::class,'display_my_product']);
});
Route::get('/product/show',[ProductController::class,'index']);
Route::get('/product/search/{name}',[ProductController::class,'search']);

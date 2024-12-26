<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostCategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/index',[CategoryController::class,'index']);
Route::post('/category',[CategoryController::class,'store']);
Route::get('/category',[CategoryController::class,'show']);
Route::post('/create',[ProductController::class,'store']);
Route::get('/show',[ProductController::class,'show']);
Route::get('/postcategory',[PostCategoryController::class,'index']);
Route::post('/categorycreate',[PostCategoryController::class,'store']);
Route::put('/categoryupdate/{category}',[PostCategoryController::class,'update']);
Route::delete('/categorydelete/{category}',[PostCategoryController::class,'delete']);
Route::get('post',[PostController::class,'index']);
Route::post('postcreate',[PostController::class,'store']);
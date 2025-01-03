<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostCategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\VerfyUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/index', [CategoryController::class, 'index']);
    Route::get('/post', [PostController::class, 'index']);
    Route::post('taskstore', [TaskController::class, 'store']);
    Route::get('/observe', [TaskController::class, 'show']); //->middleware(Check::class.':admin');
    Route::post('comment',[TaskController::class,'comment']);
    Route::post('edituser',[AuthController::class,'edituser']);
});

Route::post('/category', [CategoryController::class, 'store']);
Route::get('/category', [CategoryController::class, 'show']);
Route::post('/create', [ProductController::class, 'store']);
Route::get('/show', [ProductController::class, 'show']);
Route::get('/postcategory', [PostCategoryController::class, 'index']);
Route::post('/categorycreate', [PostCategoryController::class, 'store']);
Route::put('/categoryupdate/{category}', [PostCategoryController::class, 'update']);
Route::delete('/categorydelete/{category}', [PostCategoryController::class, 'delete']);
Route::post('/postcreate', [PostController::class, 'store']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('resetpassword', [VerfyUserController::class, 'index']);
Route::post('newpassword',[VerfyUserController::class,'newpassword']);


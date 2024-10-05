<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// UserAPI
Route::get('users', [UserController::class, 'getAll']);
Route::get('user/{id}', [UserController::class, 'getById']);
Route::post('user/create', [UserController::class, 'store']);
Route::patch('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'destroy']);

// CompanyAPI
Route::get('companies', [CompanyController::class, 'getAll']);
Route::get('company/{id}', [CompanyController::class, 'getById']);
Route::post('company/create', [CompanyController::class, 'store']);
Route::patch('company/{id}', [CompanyController::class, 'update']);
Route::delete('company/{id}', [CompanyController::class, 'destroy']);
Route::get('company/{id}/comments', [CompanyController::class, 'getComments']);
Route::get('company/{id}/rating', [CompanyController::class, 'getRating']);
Route::get('companies/top10', [CompanyController::class, 'getTop10']);

// CommentAPI
Route::get('comments', [CommentController::class, 'getAll']);
Route::get('comment/{id}', [CommentController::class, 'getById']);
Route::post('comment/create', [CommentController::class, 'store']);
Route::patch('comment/{id}', [CommentController::class, 'update']);
Route::delete('comment/{id}', [CommentController::class, 'destroy']);

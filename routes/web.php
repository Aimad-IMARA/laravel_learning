<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'home']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/addPost', [PostController::class, 'addPost']);
Route::get('/deletePost/{post}', [PostController::class, 'deletePost']);
Route::get('/editPost/{post}', [PostController::class, 'showPost']);
Route::put('/editPost/{post}', [PostController::class, 'editPost']);
Route::post('/login', [UserController::class, 'login']);

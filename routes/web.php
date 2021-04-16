<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::get('/', [TaskController::class, 'index'])->name('index');

Route::resource('/user', UserController::class);
Route::resource('/task', TaskController::class);

Route::get('fetch_user_data', [UserController::class, 'fetch_user_data'])->name('fetch_user_data');
Route::get('fetch_task_data', [TaskController::class, 'fetch_task_data'])->name('fetch_task_data');
Route::get('fetch_user_tasks/{id}', [UserController::class, 'fetch_user_tasks'])->name('fetch_user_tasks');

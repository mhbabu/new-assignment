<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('post/details/{blog}', [PostController::class, 'postdetails'])->name('post.details');

Route::get('/login', function () {
    return auth()->id() ? redirect('dashboard') : redirect('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('blogs', BlogController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    Route::post('post/{blogId}/comments', [CommentController::class, 'comment'])->name('post.comments');
});

<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RelationController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function(){
    Route::get('user/search', [UserController::class,'searching'])->name('search');
    Route::PUT('posts/private', [PostController::class,'makePostPrivate'])->name('private');
    Route::PUT('posts/public', [PostController::class,'makePostPublic'])->name('public');
    
    Route::resources([
        'user' => UserController::class,
        'posts' => PostController::class,
        'relation' => RelationController::class,
        'like' => LikeController::class,
    ]);
    
});


// Route::resource([
//     'photos' => PhotoController::class,
//     'posts' => PostController::class,
// ]);
// Route::resource('user', UserController::class)
// ->name('user')->middleware(['auth']);

// Route::get('/dashboard', function () {
//     return view('profile');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

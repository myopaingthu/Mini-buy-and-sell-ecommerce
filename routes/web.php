<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;

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
    return view('welcome');
});

Route::group(['middleware'=>'auth'], function(){

    Route::resource('products', ProductController::class);
    Route::post('products/confirmCreate', [ProductController::class, 'confirmCreate'])->name('confirmCreate');
    Route::get('proudcts/search', [ProductController::class, 'search'])->name('search');
    Route::get('proudcts/sort', [ProductController::class, 'sortProduct'])->name('sort');
    Route::post('users/confirmEdit', [UserController::class, 'confirmEdit'])->name('confirmEdit');
    Route::get('users/{user}/products', [ProductController::class, 'userProduct'])->name('userProduct');
    Route::post('products/{product}/confirmEditProduct', [ProductController::class, 'confirmEdit'])->name('confirmEditProduct');
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products.comments', CommentController::class)->shallow();
    Route::get('users/{user}/products/{product}/favourites', [FavouriteController::class, 'store'])->name('favourites.store');
    Route::get('favourites/{favourite}/delete', [FavouriteController::class, 'destroy'])->name('favourites.destroy');
    Route::get('users/{user}/favourites', [FavouriteController::class, 'index'])->name('userFavourites');
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::resource('images', ImageController::class);
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

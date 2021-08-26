<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\BackProductController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminResourceController;
use App\Http\Controllers\Admin\BackendCategoryController;

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

Route::get('/', [ProductController::class, 'guestProduct'])->name('guest');

Route::group(['middleware'=>['auth']], function() {
    Route::resource('products', ProductController::class);
    Route::post('products/confirmCreate', [ProductController::class, 'confirmCreate'])->name('confirmCreate');
    Route::get('proudcts/search', [ProductController::class, 'search'])->name('search');
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
    });

Route::prefix('admin')->middleware('admin', 'auth')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('adminusers', AdminUserController::class);
    Route::resource('admins', AdminResourceController::class);
    Route::resource('backend-products', BackProductController::class);
    Route::resource('backend-categories', BackendCategoryController::class);
    Route::get('export', [BackProductController::class, 'export'])->name('export');
    Route::post('import', [BackProductController::class, 'import'])->name('import');
    
});

Route::get('adminusers/data', [AdminUserController::class, 'ajaxData'])->name('adminusers.datas');
Route::get('admins/data', [AdminResourceController::class, 'ajaxData'])->name('admins.datas');
Route::get('backend/products/data', [BackProductController::class, 'ajaxData'])->name('backend.datas');
Route::get('backend/categories/data', [BackendCategoryController::class, 'ajaxData'])->name('categories.datas');

require __DIR__.'/auth.php';

// [ProductController::class, 'dateSearch'])->name('dateSearch');
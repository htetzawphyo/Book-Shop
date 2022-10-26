<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Book\SeachController;
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\DatatablesController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\User\UserController;

Auth::routes();

Route::group(['middleware' => 'auth' ], function() {

    Route::get('/admin', [DashboardController::class, 'index']);
    
    Route::resource('authors', AuthorController::class);
    Route::get('/authors/datas', [AuthorController::class, 'anyData']);
    
    Route::resource('books', BookController::class);
    Route::get('/boooks/datas', [BookController::class, 'getData'])->name('books.datas');
    
    Route::resource('users', UserController::class);
    Route::get('/users/datas', [UserController::class, 'getData'])->name('users.datas');   
    
    Route::controller(CartController::class)->group(function() {
        Route::get('/cart', 'cartList')->name('cart.list');
        Route::post('/cart', 'addToCart')->name('cart.store');
        Route::post('/update-cart', 'updateCart')->name('cart.update');
        Route::post('/remove', 'removeCart')->name('cart.remove');
        Route::post('clear', 'clearAllCart')->name('cart.clear');
    });
    
});
    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(MenuController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
    Route::get('/authors/{author}/books', 'author')->name('author');
    Route::get('/books/detail/{book}', 'bookDetail');
    Route::get('/cart-detail', 'cartDetail')->middleware('auth');
});
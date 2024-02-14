<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NormalUserController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return  "all cleared ...";

});

Route::controller(HomeController::class)->group(function () {
    Route::get('/','index');
    Route::get('/welcome','checkUser');
    // Route::post('/search','search')->name('search');
    Route::get('/t', 't'); //search
    Route::get('/book/{book}','show');
    Route::get('/author/{authorName}','showAuthorBooks');
    Route::post('/downloadBook/book/{book}/user/{user}','downloadBook');
    Route::get('/categories','showCategories')->name('a');
    Route::get('/category/{category}','showRelatedBookCategory');
});

Route::post('/book/{book}/CreateComment', [CommentController::class,'store']);
Route::patch('/book/{book}/edit',[BookController::class,'updateRateBook']);

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('/users',UserController::class);
    Route::resource('/books',BookController::class);
    Route::resource('/categories',CategoryController::class);
    Route::controller(AdminController::class)->group(function (){
        Route::get('/dashboard','index');
        Route::get('/profile','profileIndex');
        Route::patch('/profile','update');
    });
    Route::get('/books/{book}/mail',[BookController::class,'sendSpecificInfoBook']);
    Route::prefix('notifications')->group(function () {
        Route::resource('/comments',CommentController::class);
        Route::get('/mails',[AdminController::class,'sendSpecificMail']);
        Route::post('/sendMail', [AdminController::class,'sendMail'])->name('sendMail');
    });
});

Route::prefix('nUser')->middleware('auth')->controller(NormalUserController::class)->group(function(){
    Route::get('/dashboard','index');
    Route::get('/profile','profileIndex');
    Route::patch('/profile','update')->name('profile');
    Route::delete('/user/{user}','destroy')->name('delete');
    Route::get('/mydownloads','showDownloads');
});

//search
Route::get('/t',[HomeController::class,'t']);

Route::prefix('cart')->middleware('auth')->controller(CartController::class)->group(function(){
    Route::get('/','index');
    Route::post('/book/{book}','store');
    Route::post('/downloadBooks/user/{user}','downloadBooks');
    Route::delete('/book/{book}','removeBookFromCart');
    Route::get('/checkout','creditCheckout')->name('credit.checkout');
    Route::post('/checkout', 'purchase')->name('products.purchase');
});

//Route::get('/gz',[CartController::class,'gz']);

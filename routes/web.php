<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\ProductCategoriesController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Middleware\Roles;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;




Route::get('/', [FrontendController::class , 'index'])->name('frontend.index');
Route::get('/blank', [FrontendController::class , 'blank'])->name('frontend.blank');
Route::get('/checkout', [FrontendController::class , 'checkout'])->name('frontend.checkout');
Route::get('/product', [FrontendController::class , 'product'])->name('frontend.product');
Route::get('/store', [FrontendController::class , 'store'])->name('frontend.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'admin' , 'as' =>'admin.'] , function(){
    Route::group(['middleware' => 'guest'] , function(){
        Route::get('/login', [BackendController::class , 'login'])->name('login');
        Route::get('/forgot-password', [BackendController::class , 'forgot_password'])->name('forgot_password');
    });    
    Route::group(['middleware' => Roles::class , 'role:admin|supervisor'] , function(){
        Route::get('/', [BackendController::class , 'index'])->name('index_route');
        Route::get('/index', [BackendController::class , 'index'])->name('index');
        
        Route::resource('product_categories', ProductCategoriesController::class);
        Route::resource('products', ProductController::class);
        Route::resource('tags', TagController::class);
    });        
});
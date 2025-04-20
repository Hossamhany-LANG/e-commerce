<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [FrontendController::class , 'index'])->name('frontend.index');
Route::get('/blank', [FrontendController::class , 'blank'])->name('frontend.blank');
Route::get('/checkout', [FrontendController::class , 'checkout'])->name('frontend.checkout');
Route::get('/product', [FrontendController::class , 'product'])->name('frontend.product');
Route::get('/store', [FrontendController::class , 'store'])->name('frontend.store');

Route::get('/admin/login', [BackendController::class , 'login'])->name('backend.login');
Route::get('/admin/forgot-password', [BackendController::class , 'forgot_password'])->name('backend.forgot_password');
Route::get('/admin/index', [BackendController::class , 'index'])->name('backend.index');

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(!empty((Auth::user()))){
        if(Auth::user()->role == 'user'){
            return redirect()->route('user.dashboard');
        } elseif(Auth::user()->role == 'admin'){
            return redirect()->intended(route('dashboard', absolute: false));
        }
    } else{
        return view('welcome');
    }

});

Route::middleware(['auth', 'user'])
    ->prefix('user')
    ->group(function () {

        Route::get('/profile', [ProfileController::class, 'edit'])->name('user.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('user.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('user.destroy');
    });


Route::middleware(['auth', 'admin'])
    ->prefix('admins')
    ->group(function () {

        Route::get('', [AdminController::class, 'index'])->name('admins.index');
        Route::get('/users', [AdminController::class, 'adminUsers'])->name('admins.users.list');

        Route::post('/users/create', [RegisteredUserController::class, 'store'])
            ->name('admins.users.create');

        Route::post('/users/{id}', [AdminController::class, 'update'])
            ->name('admins.users.update');

        Route::delete('/users/{id}', [AdminController::class, 'destroy'])
            ->name('admins.destroy');
    });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','admin'])->name('dashboard');

Route::get('/user/dashboard', function () {
    return view('profile.partials.delete-user-form');
})->middleware(['auth','user'])->name('user.dashboard');
//
//Route::middleware('auth')->prefix('user')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('user.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('user.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('user.destroy');
//});
//
//Route::prefix('admins')->group(function () {
//
//    Route::get('', [AdminController::class, 'index'])->name('admins.index');
//    Route::get('/users', [AdminController::class, 'adminUsers'])->name('admins.users.list');
//
//    Route::post('/users/create', [RegisteredUserController::class, 'store'])
//        ->name('admins.users.create');
//
//    Route::post('/users/{id}', [AdminController::class, 'update'])
//        ->name('admins.users.update');
//
//    Route::delete('/users/{id}', [AdminController::class, 'destroy'])
//        ->name('admins.destroy');
//});

require __DIR__.'/auth.php';

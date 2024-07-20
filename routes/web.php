<?php

use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowTimesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/events/all', [EventController::class, 'getEvents'])->name('events.getEvents');
Route::post('/book/create', [BookingController::class, 'store'])->name('book.create');

Route::middleware('auth')->group(function () {
    Route::prefix('show_times')->group(function (){
        Route::get('/', [ShowTimesController::class, 'index'])->name('show_times.index');
        Route::post('/create', [ShowTimesController::class, 'store'])->name('show_times.create');
        Route::post('/update', [ShowTimesController::class, 'update'])->name('show_times.update');
        Route::post('/delete', [ShowTimesController::class, 'destroy'])->name('show_times.delete');
    });

    Route::prefix('movies')->group(function (){
        Route::get('/', [MovieController::class, 'index'])->name('movies.index');
        Route::post('/create', [MovieController::class, 'store'])->name('movies.create');
        Route::post('/update', [MovieController::class, 'update'])->name('movies.update');
        Route::post('/delete', [MovieController::class, 'destroy'])->name('movies.delete');
    });

    Route::prefix('events')->group(function (){
        Route::get('/', [EventController::class, 'index'])->name('events.index');
        Route::post('/create', [EventController::class, 'store'])->name('events.create');
        Route::post('/update', [EventController::class, 'update'])->name('events.update');
        Route::post('/delete', [EventController::class, 'destroy'])->name('events.delete');
    });
    Route::prefix('booking')->group(function (){
        Route::get('/', [BookingController::class, 'index'])->name('booking.index');
//        Route::post('/create', [AttendeeController::class, 'store'])->name('booking.create');
        Route::post('/update', [BookingController::class, 'update'])->name('booking.update');
        Route::post('/delete', [BookingController::class, 'destroy'])->name('booking.delete');

    });

});

require __DIR__.'/auth.php';

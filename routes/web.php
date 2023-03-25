<?php

use App\Events\MessageCreated;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('layouts.admin');
})->name('dashboard')->middleware('auth');

Route::get('/send/messages', function () {
    MessageCreated::dispatch("hai", 30);
});

Route::controller(UserController::class)->group(function () {
    Route::get("/signup", "signup")->name('auth.signup')->middleware('guest');
    Route::post("/signup", "attemptSignin")->name('auth.attempt_signup')->middleware('guest');
    Route::get("/signin", "signin")->name('auth.signin')->middleware('guest');
    Route::get("/signout", "signout")->name('auth.signout')->middleware('auth');
});

<?php

use App\Events\MessageCreated;
use App\Http\Controllers\RoomChatController;
use App\Http\Controllers\UserController;
use App\Mail\RequestService;
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

Route::get('/test-mail', function () {
    return (new RequestService("febryntarabagus@gmail.com", "Bagus Febryntara", "2015323078", "Teknik Elektro"))->render();
});

Route::controller(UserController::class)->group(function () {
    Route::get("/signup", "signup")->name('auth.signup')->middleware('guest');
    Route::post("/signup", "attemptSignin")->name('auth.attempt_signup')->middleware('guest');
    Route::get("/signin", "signin")->name('auth.signin')->middleware('guest');
    Route::get("/signout", "signout")->name('auth.signout')->middleware('auth');
    Route::get("/enter", "enter")->name('auth.enter')->middleware('guest');
    Route::post("/enter", "attemptEnter")->name('auth.attempt_enter')->middleware('guest');
});

Route::controller(RoomChatController::class)->group(function () {
    Route::get('/room-{room:code}', "open")->name("room.open");
});

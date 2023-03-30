<?php

use App\Events\MessageCreated;
use App\Http\Controllers\DepartmentController;
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
    return (new RequestService("Bagus Febryntara", "2015323078", "Teknik Elektro"))->render();
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

Route::controller(DepartmentController::class)->group(function () {
    Route::get('/department', 'index')->name('department.all')->middleware('auth');
    Route::get('/department/tambah', 'create')->name('department.create')->middleware('auth');
    Route::post('/department/tambah', 'store')->name('department.store')->middleware('auth');
    Route::get('/department/{department:code}', 'detail')->name('department.detail')->middleware('auth');
    Route::patch('/department/{department:code}/switch', 'switch')->name('department.switch')->middleware('auth');
    Route::get('/department/{department:code}/ubah', 'update')->name('department.update')->middleware('auth');
    Route::patch('/department/{department:code}/ubah', 'patch')->name('department.patch')->middleware('auth');
    Route::delete('/department/{department:code}/hapus', 'delete')->name('department.delete')->middleware('auth');
});

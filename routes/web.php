<?php

use App\Events\MessageCreated;
use App\Http\Controllers\CSController;
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

Route::get('test', function () {
    $data = response()->json(view('fragments.chat_cs', ['message' => "anjay"])->render());
    return $data;
});

Route::get('/send/messages', function () {
    MessageCreated::dispatch("hai", 4, 1, 2);
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
    Route::get('/room-{room:code}', "open")->name("room.open")->middleware('customer');
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

Route::controller(CSController::class)->group(function () {
    Route::get('/cs', 'index')->name('cs.all')->middleware('auth');
    Route::get('/cs/tambah', 'create')->name('cs.create')->middleware('auth');
    Route::post('/cs/tambah', 'store')->name('cs.store')->middleware('auth');
    Route::get('/cs/{user:code}', 'detail')->name('cs.detail')->middleware('auth');
    Route::get('/cs/{user:code}/ubah', 'update')->name('cs.update')->middleware('auth');
    Route::patch('/cs/{user:code}/ubah', 'patch')->name('cs.patch')->middleware('auth');
    Route::delete('/cs/{user:code}/hapus', 'delete')->name('cs.delete')->middleware('auth');
});

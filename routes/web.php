<?php

use App\Events\MessageCreated;
use App\Http\Controllers\CSController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoomChatController;
use App\Http\Controllers\UserController;
use App\Mail\RequestService;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Message;
use App\Models\MessageEncryption;
use App\Models\Rating;
use App\Models\RoomChat;
use App\Models\StringComparison;
use Illuminate\Http\Request;
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
    $role_as = auth()->user()->role;
    $department = auth()->user()->department;
    $done_customers = $role_as == 'admin' ? Customer::all() : $department->rooms->where('status', 'ended')->map(function ($data) {
        return $data->customer;
    })->unique('code');
    $still_customers = $role_as == 'admin' ? Customer::all() : $department->rooms->where('status', 'active')->map(function ($data) {
        return $data->customer;
    })->unique('code');
    $customers = $role_as == 'admin' ? Customer::latest()->get() : $department->rooms->map(function ($data) {
        return $data->customer;
    })->unique('code')->sortByDesc('last_visit');
    $ratings = $role_as == 'admin' ? Rating::latest()->get() : Rating::department($department->code)->get();
    $rating = $ratings->sum('stars') / $ratings->count();
    $messages = $role_as == 'admin' ? collect([]) : Message::whereIn('room_code', $department->rooms->map(fn ($item) => $item->code))->whereNotIn('sender', $department->cs->map(fn ($item) => $item->code))->get();

    $data = [
        'done_customers' => $done_customers,
        'still_customers' => $still_customers,
        'customers' => $customers,
        'department' => $department,
        'departments' => Department::latest()->get(),
        'ratings' => $ratings,
        'rating' => $rating,
        'messages' => $messages
    ];

    // return dd($data);
    return view('pages.dashboard.index', $data);
})->name('dashboard')->middleware('auth');

Route::get('test', function (Request $request) {
    dd(RoomChat::first()->department);
});

Route::get('/send/messages', function () {
    MessageCreated::dispatch("hai", 4, 1, 2);
});

Route::get('/test-mail', function () {
    // return (new RequestService("Bagus Febryntara", "2015323078", "Teknik Elektro"))->render();
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
    Route::get('/room-{room:code}', "openForC")->name("room.open")->middleware('customer');
    Route::get('/chat/stack', 'chatStack')->name("chat.stack")->middleware('auth');
    Route::get('/chat/active', 'chatActive')->name("chat.active")->middleware('auth');
    Route::get('/chat/ended', 'chatEnded')->name("chat.ended")->middleware('auth');
    Route::get('/chat/{room:code}', 'openForCS')->name("chat.open")->middleware('auth');
    Route::post('/chat/{room:code}/end-chat', 'endChat')->name("chat.end"); //logic middleware ada di controller
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

Route::controller(CustomerController::class)->group(function () {
    Route::get('/customer/{jurusan}', 'index')->name('customer.index')->middleware('auth');
    Route::get('/customer/detail/{customer:code}', 'detail')->name('customer.detail')->middleware('auth');
});

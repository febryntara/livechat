<?php

namespace App\Http\Controllers;

use App\Events\RoomAppear;
use App\Mail\RequestService;
use App\Models\Customer;
use App\Models\Department;
use App\Models\StringComparison;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function signin()
    {
        $data = [
            'title' => "Live Chat | Sign In",
        ];

        return view('pages.authentication.signin', $data);
    }

    public function signup()
    {
        $data = [
            'title' => "Live Chat | Sign Up",
        ];

        return $data;
    }

    public function attemptSignin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'string|required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', "email atau Password Salah!");
        }

        $validated = $validator->validate();
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return redirect()->route('dashboard')->with("success", "Sign In Berhasil<br>Selamat Datang " . auth()->user()->name);
        }
        return redirect()->back()->withInput()->with("error", "Sign In Gagal<br>Coba Lagi!");
    }

    public function attemptSignup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:8|max:16',
            'password' => 'required|string',
            'email' => 'required|email:dns|unique:users,email'
            // nanti diisi data admin
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', "Data Yang Diinput Tidak Tepat!");
        }

        $validated = $validator->validate();
        if (User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'email' => $validated['email'],
        ])) {
            // redirect ke halaman login kasi alert berhasil buat akun
            $this->attemptSignin($request);
        }
        // redirect ke halaman login kasi alert gagal buat akun
        return redirect()->back()->withInput()->with("error", "Sign Up Gagal<br>Coba Lagi!");
    }

    public function signout()
    {
        Session::flush();
        session()->invalidate();
        Auth::logout();

        return redirect()->route('auth.signin');
        // redirect ke halaman login
    }

    public function enter()
    {
        $data = [
            'title' => 'Live Chat | Minta Layanan',
            'departments' => Department::get(),

        ];

        return view('pages.authentication.enter', $data);
    }

    public function attemptEnter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nim' => 'required|numeric',
            'email' => 'required|email:dns',
            'jurusan' => 'required|string',
            'department' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', "Terjadi Kesalahan Pada Data yang Diberikan!");
        }

        $validated = $validator->validate();
        // return (new RequestService($validated['email'], $validated['nama'], $validated['nim'], $validated['jurusan']))->render();
        $similarity = StringComparison::calculate($validated['nama'], $validated['email']);
        if ($similarity > 0.6) {
            $customer = Customer::addOrUpdate($validated['nama'], $validated['email'], $validated['nim'], $validated['jurusan']);
            $department = Department::where('code', $validated['department'])->get()->first();
            Mail::to($validated['email'])->send(new RequestService($customer, $department));
            return redirect()->back()->with('success', "Layanan Berhasil Diminta!<br>Silahkan Cek Pesan Yang Kami Kirim Lewat Email Anda!");
        }
        return redirect()->back()->with('error', "Terjadi Ketidakcocokan Data Antara Email dan Nama Anda!<br>Gunakan Email Asli yang Berhubungan dengan Nama Anda!");
    }
}

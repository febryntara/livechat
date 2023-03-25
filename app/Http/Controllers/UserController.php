<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
}

<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CSController extends Controller
{
    private $rules = [
        'name' => 'required|string',
        'email' => 'required|email:dns',
        'password' => 'required|string|min:8',
        'department_id' => 'nullable|numeric'
    ];

    public function index(Request $request)
    {
        $data = [
            'title' => 'Daftar Customer Service',
            'use_search' => true,
            'cs' => User::role('cs')->search($request->get('keyword'))->paginate(10)->withQueryString(),
            'number' => $request->has('page') ? ($request->get('page') != 1 ? ($request->get('page') - 1) * 10 + 1 : 1) : 1
        ];

        return view('pages.crud.customer_service.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => "Tambah CS Baru",
            'departments' => Department::all(),
        ];

        return view('pages.crud.customer_service.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validated = $validator->validate();
        $validated['password'] = Hash::make($validated['password']);
        $is_created = User::create($validated);
        if ($is_created) {
            return redirect()->route('cs.all')->with('success', "CS Baru Berhasil Ditambahkan!");
        }

        return redirect()->back()->with('error', 'Terjadi Sebuah Kesalahan!<br>Silahkan Coba Lagi!')->withInput();
    }

    public function detail(User $user)
    {
        $data = [
            'title' => "Detail CS| $user->name",
            'cs' => $user
        ];

        return view('pages.crud.customer_service.detail', $data);
    }

    public function update(User $user)
    {
        $data = [
            'title' => "Ubah CS| $user->name",
            'cs' => $user,
            'departments' => Department::all()
        ];

        return view('pages.crud.customer_service.update', $data);
    }

    public function patch(Request $request, User $user)
    {
        $this->rules['password'] = "nullable|string|min:8";
        $validator = Validator::make($request->all(), $this->rules);
        $validated = $validator->validate();
        if ($request->has('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', "Terjadi Kesalahan Pada Input!");
        }

        $is_updated = $user->update($validated);
        if ($is_updated) {
            return redirect()->route('cs.detail', ['user' => $user])->with('success', "CS $user->name Berhasil Di Update!");
        }
        return redirect()->back()->withInput()->with('error', "CS $user->name Gagal Di Update!<br>Coba Lagi!");
    }

    public function delete(User $user)
    {
        $is_deleted = $user->delete();
        if ($is_deleted) {
            return redirect()->route('cs.all')->with('success', "CS $user->name Berhasil Dihapus!");
        }
        return redirect()->route('cs.all')->with('error', "CS $user->name Gagal Dihapus!");
    }
}

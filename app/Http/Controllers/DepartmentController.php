<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Data Department",
            'departments' => Department::paginate(10)->withQueryString()
        ];

        return view('pages.crud.department.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Department'
        ];

        return view('pages.crud.department.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|in:availlable,unavaillable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Terjadi Kesalahan Pada Input!');
        }

        $is_created = Department::create($validator->validate());

        if ($is_created) {
            return redirect()->route('department.all')->with('success', sprintf("Department %s Berhasil Ditambah", $is_created->name));
        }

        return redirect()->back()->withInput()->with('error', 'Terjadi Kesalahan!<br>Silahkan Coba Lagi!');
    }

    public function update(Department $department)
    {
        $data = [
            'title' => sprintf("Update Departemen %s", $department->name),
            'department' => $department
        ];

        return view('pages.crud.department.update', $data);
    }

    public function patch(Department $department, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|in:availlable,unavaillable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Terjadi Kesalahan Pada Input!');
        }

        $is_updated = $department->update($validator->validate());
        if ($is_updated) {
            return redirect()->route('department.detail', ['department' => $department])->with('success', sprintf("Departement %s Berhasil Diupdate!", $department->name));
        }

        return redirect()->back()->withInput()->with(sprintf("Department %s Gagal Diupdate!", $department->name));
    }

    public function detail(Department $department)
    {
        $data = [
            'title' => sprintf("Detail Department %s", $department->name)
        ];

        return $data;
    }

    public function delete(Department $department)
    {
        $is_deleted = $department->delete();
        if ($is_deleted) {
            return redirect()->route('department.all')->with('success', "Department $department->name Berhasil Dihapus!");
        }
        return redirect()->back()->with('error', "Terjadi Kesalahan Saat Menghapus $department->name");
    }

    // additional method
    public function switch(Department $department)
    {
        $department->switchStatus();
    }
}

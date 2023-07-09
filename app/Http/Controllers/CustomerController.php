<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request, $jurusan)
    {
        $data = [
            'title' => "Mahasiswa Jurusan " . $jurusan,
            'use_search' => true,
            'customers' => Customer::jurusan($jurusan)->search($request->get('keyword'))->paginate(10)->withQueryString(),
            'department' => auth()->user()->department,
            'number' => $request->has('page') ? ($request->get('page') != 1 ? ($request->get('page') - 1) * 10 + 1 : 1) : 1
        ];

        return view('pages.crud.customer.index', $data);
    }
    public function detail(Request $request, Customer $customer)
    {
        $data = [
            'title' => "Detail " . $customer->name,
            'customer' => $customer,
            'department' => auth()->user()->department
        ];

        return view('pages.crud.customer.detail', $data);
    }
}

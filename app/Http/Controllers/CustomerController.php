<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => "Mahasiswa Jurusan " . $request->jurusan,
            'customers' => Customer::where('jurusan', $request->jurusan)->paginate(10)->withQueryString(),
            'department' => auth()->user()->department
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

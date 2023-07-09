@extends('layouts.admin')

@section('body')
    <h2 class="intro-y text-lg font-medium mt-10">
        Data List Mahasiswa
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">NO</th>
                        <th class="whitespace-nowrap">NAMA</th>
                        <th class="text-center">EMAIL</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">PENGGUNAAN</th>
                        <th class="text-center">PENGGUNAAN TERAKHIR</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $item)
                        <tr class="intro-x">
                            <td class="w-40">
                                {{ $number++ }}
                            </td>
                            <td>
                                <a href="{{ route('customer.detail', ['customer' => $item]) }}"
                                    class="font-medium whitespace-nowrap">{{ $item->name }}</a>
                            </td>
                            <td class="text-center">{{ $item->email }}</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center">
                                    {{ $item->nim }}
                                </div>
                            </td>
                            <td class="text-center">{{ $item->visit }}</td>
                            <td class="text-center">{{ $item->last_visited->diffForHumans() }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 text-primary"
                                        href="{{ route('customer.detail', ['customer' => $item]) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Detail </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevrons-left"></i> </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevron-left"></i> </a>
                    </li>
                    <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                    <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                    <li class="page-item active"> <a class="page-link" href="#">2</a> </li>
                    <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                    <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                    <li class="page-item">
                        <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevron-right"></i> </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevrons-right"></i> </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- END: Pagination -->
    </div>
@endsection

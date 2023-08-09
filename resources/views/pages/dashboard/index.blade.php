@extends('layouts.admin')

@section('body')
    <!-- BEGIN: General Report -->
    <div class="col-span-12 mt-8">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Ringkasan Umum
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="user" class="report-box__icon text-primary"></i>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $done_customers->count() }}</div>
                        <div class="text-base text-slate-500 mt-1">Telah Dilayani</div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="user" class="report-box__icon text-primary"></i>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $still_customers->count() }}</div>
                        <div class="text-base text-slate-500 mt-1">Sedang Dilayani</div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="star" class="report-box__icon text-pending"></i>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6 flex">
                            <span>{{ number_format($rating, 2) }}</span>
                        </div>
                        <div class="text-base text-slate-500 mt-1">Index Penilaian</div>
                    </div>
                </div>
            </div>
            @can('admin', auth()->user())
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-lucide="home" class="report-box__icon text-pending"></i>
                            </div>
                            <div class="text-3xl font-medium leading-8 mt-6 flex">
                                <span>{{ $departments->count() }}</span>
                            </div>
                            <div class="text-base text-slate-500 mt-1">Department Dimiliki</div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-lucide="message-circle" class="report-box__icon text-pending"></i>
                            </div>
                            <div class="text-3xl font-medium leading-8 mt-6 flex">
                                <span>{{ $messages->count() }}</span>
                            </div>
                            <div class="text-base text-slate-500 mt-1">Pesan Diterima</div>
                        </div>
                    </div>
                </div>
            @endcannot
        </div>
    </div>
    <!-- END: General Report -->
    <!-- BEGIN: Weekly Top Products -->
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Customer Terbaru
            </h2>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
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
                                {{ $loop->iteration }}
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
    </div>
    <!-- END: Weekly Top Products -->
@endsection

@extends('layouts.base')

@section('base_head')
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/my.css') }}" />
    <title>{{ $title }}</title>
    <!-- END: CSS Assets-->
@endsection
@section('base_body')
    <div class="login container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                    <span class="text-white text-lg ml-3"> PNB - Live Chat </span>
                </a>
                <div class="my-auto">
                    <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                        src="{{ asset('dist/images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        Lakukan Registrasi
                        <br>
                        Untuk Mengakses Layanan Livechat.
                    </div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <form class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0" action="{{ route('auth.attempt_enter') }}"
                method="post">
                @csrf
                <div
                    class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Ajukan Layanan
                    </h2>
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your
                        account. Manage all your e-commerce accounts in one place</div>
                    <div class="intro-x mt-8">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input type="text" name="email" class="intro-x login__input form-control py-3 px-4 block"
                            placeholder="Email">
                        @error('nama')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input type="text" name="nama" class="intro-x login__input form-control py-3 px-4 block mt-4"
                            placeholder="Nama Lengkap">
                        @error('nim')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input type="text" name="nim" class="intro-x login__input form-control py-3 px-4 block mt-4"
                            placeholder="NIM">
                        @error('jurusan')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <select class="form-select form-select-lg mt-4 sm:mt-2 sm:mr-2" name="jurusan"
                            aria-label=".form-select-lg example">
                            <option class="capitalize" value="">Jurusan</option>
                            @foreach (json_decode(env('APP_JURUSAN')) as $item)
                                <option class="capitalize" value="{{ $item->code }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <select class="form-select form-select-lg mt-4 sm:mt-2 sm:mr-2" name="department"
                            aria-label=".form-select-lg example">
                            <option class="capitalize" value="">Pilih Department</option>
                            @forelse ($departments as $item)
                                <option class="capitalize" value="{{ $item->code }}">{{ $item->name }}</option>
                            @empty
                                <option class="capitalize" value="">Tidak Ada Department Yang Tersedia</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left w-full flex justify-center">
                        <button type="submit"
                            class="btn btn-primary text-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Minta
                            Layanan</button>
                        <a href="{{ route('auth.signin') }}"
                            class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login CS</a>
                    </div>
                </div>
            </form>
            <!-- END: Login Form -->
        </div>
    </div>
@endsection
@section('base_script')
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="{{ asset('build/assets/app-b09f75ac.js') }}"></script>
    <script src="{{ asset('js/function_lib.js') }}"></script>
@endsection

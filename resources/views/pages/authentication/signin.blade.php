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
                    <div class="-intro-x text-white font-medium text-3xl leading-tight mt-10">
                        Login Sebagai CS / Administrator
                        <br>
                        Untuk Melayani Customer.
                    </div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <form class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0" action="{{ route('auth.attempt_signup') }}"
                method="post">
                @csrf
                <div
                    class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Sign In
                    </h2>
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your
                        account. Manage all your e-commerce accounts in one place</div>
                    <div class="intro-x mt-8">
                        <input type="text" name="email" class="intro-x login__input form-control py-3 px-4 block"
                            placeholder="Email">
                        <input type="password" name="password"
                            class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password">
                    </div>
                    {{-- <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                            <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                        </div>
                        <a href="">Forgot Password?</a>
                    </div> --}}
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <input type="submit" value="Login"
                            class="btn btn-primary bg-primary text-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">
                        <a href="{{ route('auth.enter') }}"
                            class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Kembali</a>
                    </div>
                    {{-- <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left"> By
                        signin up, you agree to our <a class="text-primary dark:text-slate-200" href="">Terms and
                            Conditions</a> & <a class="text-primary dark:text-slate-200" href="">Privacy Policy</a>
                    </div> --}}
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

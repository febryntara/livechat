@extends('layouts.base')
@section('base_head')
    <title>Dashboard - Enigma - Tailwind HTML Admin Template</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/my.css') }}" />
    <!-- END: CSS Assets-->
    @yield('head')
@endsection

@section('base_body')
    <!-- BEGIN: Mobile Menu -->
    @include('fragments.mobile_menu')
    <!-- END: Mobile Menu -->
    <!-- BEGIN: Top Bar -->
    @include('fragments.top_bar')
    <!-- END: Top Bar -->
    <div class="flex overflow-hidden">
        <!-- BEGIN: Side Menu -->
        @include('fragments.side_nav')
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 2xl:col-span-9">
                    @yield('body')
                </div>
                <div class="col-span-12 2xl:col-span-3">
                    <div class="2xl:border-l -mb-10 pb-10">
                        <div class="2xl:pl-6 grid grid-cols-12 gap-x-6 2xl:gap-x-0 gap-y-6">
                            @yield('sencondary_body')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
@endsection

@section('base_script')
    <!-- BEGIN: JS Assets-->
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="{{ asset('build/assets/app-b09f75ac.js') }}"></script>

    <script>
        window.Echo.channel("messages.30").listen("MessageCreated", (event) => {
            console.log(event);
        });
    </script>
    @yield('script')
    <!-- END: JS Assets-->
@endsection

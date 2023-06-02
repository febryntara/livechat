@extends('layouts.base')
@section('base_head')
    <title>Dashboard - Enigma - Tailwind HTML Admin Template</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/my.css') }}" />
    @can('chat-access')
        {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"> --}}
    @endcan
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

    <!-- BEGIN: Notification Content -->
    <div id="new-roomchat-appear" class="toastify-content hidden flex">
        <div class="font-medium">Ada Room Chat Masuk! Cek Chat Stack Segera!</div>
    </div>
@endsection

@section('base_script')
    @can('chat-access')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>
            var audio = new Audio("{{ asset('dist/sounds/discord.mp3') }}");
            window.Echo.channel("{{ $department->code }}").listen("RoomAppear", (event) => {
                Toastify({
                    node: $("#new-roomchat-appear").clone().removeClass("hidden")[0],
                    duration: 5000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "white",
                    stopOnFocus: true,
                }).showToast();
                audio.play().catch(function(error) {
                    if (error.name === 'NotAllowedError') {
                        audio.play();
                    }
                });
            });
        </script>
    @endcan
    <!-- BEGIN: JS Assets-->
    @yield('script')
    <!-- END: JS Assets-->
@endsection

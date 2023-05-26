<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="febryntara">
    @yield('meta')
    {{-- START:Dynamic Asset --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
    @yield('base_head')
    {{-- END:Dynamic Asset --}}
</head>
<!-- END: Head -->

<body class="py-5 md:py-0">
    @yield('base_body')
    @if (session('error'))
        <div id="alert-message"
            class="fixed w-[70vw] lg:w-96 p-3 rounded-2xl top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 text-center bg-white shadow-md z-[9999] border-y-2 border-danger">
            <i data-lucide="alert-triangle" class="text-danger w-10 h-10 mx-auto"></i>
            <h1 class="text-danger text-xl text-center">GAGAL!</h1>
            <p class="text-md text-center">{!! session()->get('error') !!}</p>
        </div>
    @endif
    @if (session('success'))
        <div id="alert-message"
            class="fixed w-[70vw] lg:w-96 p-3 rounded-2xl top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 text-center bg-white shadow-md z-[9999] border-y-2 border-primary">
            <i data-lucide="check-circle" class="text-pm w-10 h-10 mx-auto"></i>
            <h1 class="text-pm text-xl text-center">BERHASIL!</h1>
            <p class="text-md text-center">{!! session()->get('success') !!}</p>
        </div>
    @endif
    {{-- ================================================ --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="{{ asset('build/assets/app-b09f75ac.js') }}"></script>
    <script src="{{ asset('dist/js/jquery-3.6.1.min.js') }}"></script>
    <script>
        $('#alert-message').ready(function() {
            setTimeout(() => {
                $('#alert-message').fadeOut()
            }, 2000);
            setTimeout(() => {
                $('#alert-message').remove()
            }, 2500);
        })
    </script>

    @yield('base_script')
</body>

</html>

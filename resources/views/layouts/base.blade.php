<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="febryntara">
    @yield('meta')
    {{-- START:Dynamic Asset --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" /> --}}
    @yield('base_head')
    {{-- END:Dynamic Asset --}}
</head>
<!-- END: Head -->

<body class="py-5 md:py-0">
    @yield('base_body')
    @if (session('error'))
        {{ session()->get('error') }}
    @endif
    @if (session('success'))
        {{ session()->get('success') }}
    @endif
    {{-- ================================================ --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script> --}}
    @yield('base_script')
</body>

</html>

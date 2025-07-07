<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>@yield('title') | EVENT KMEANS</title>

    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    @stack('style')
    <style>
        .badge-bronze {
            background-color: #cd7f32;
            color: #fff;
        }
    </style>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon//site.webmanifest') }}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">

            @include('components.user-header')

            <div class="main-content">
                @yield('main')
            </div>

            @include('components.user-footer')

        </div>
    </div>

    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    @stack('scripts')

</body>

</html>

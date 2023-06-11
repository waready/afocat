<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link data-default-icon="https://static.xx.fbcdn.net/rsrc.php/yD/r/d4ZIVX-5C-b.ico?_nc_eui2=AeEOObd8nl1PfbcvM31PN7v8aBWfmC2eGbdoFZ-YLZ4Zt-0cnhYPBcREU_lphgZEB7_OfVzZqzqGjRKnI4pvF9Th" data-badged-icon="https://static.xx.fbcdn.net/rsrc.php/ye/r/Ta8_J_nYekI.ico?_nc_eui2=AeGcls9fwKZJN23UdySI6GeAt1HapB1ZKpK3UdqkHVkqkmUQz37ExxaoXRfGC2hOM6gdih1sipLN9XYrY_lVMPwG" rel="shortcut icon" href="https://static.xx.fbcdn.net/rsrc.php/yD/r/d4ZIVX-5C-b.ico?_nc_eui2=AeEOObd8nl1PfbcvM31PN7v8aBWfmC2eGbdoFZ-YLZ4Zt-0cnhYPBcREU_lphgZEB7_OfVzZqzqGjRKnI4pvF9Th">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    @yield('third_party_stylesheets')

    @stack('styles')
</head>

<body class="c-app">
@include('layouts.sidebar')

<div class="c-wrapper" id="app">
    <header class="c-header c-header-light c-header-fixed">
        @include('layouts.header')
    </header>

    <div class="c-body">
        <main class="c-main">
            @yield('content')
        </main>
    </div>
    <footer class="c-footer">
        <div><a href="https://coreui.io">CoreUI</a> © 2022 creativeLabs.</div>
        <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.0/dist/umd/popper.min.js"></script>
<script src="{{ mix('js/app.js') }}" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.js"></script>
@yield('third_party_scripts')

@stack('scripts')
</body>
</html>

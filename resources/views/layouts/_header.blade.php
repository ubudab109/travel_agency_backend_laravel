<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>test</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('Admin/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('Admin/demo/demo.css') }}" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{ asset('Dropzone/image-uploader.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @yield('style')
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
</head>

<body class="">
    @include('sweetalert::alert')
    <div class="wrapper">
        @include('layouts._sidebar')
        <div class="main-panel">
            @include('layouts._navbar')
            <div class="content">
                @yield('content')
            </div>
            @include('layouts._footer')
        </div>
    </div>
    <div class="fixed-plugin">
        @include('layouts._sidebar-filter')
    </div>
    @include('layouts._script')
</body>


</html>

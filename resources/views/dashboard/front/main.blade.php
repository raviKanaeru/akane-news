<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} - Akane News</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin/css/fontawesome-free/css/all.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />

    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/css/adminlte.min.css" />
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/admin/css/overlayScrollbars/css/OverlayScrollbars.min.css" />
    <!-- DataTables -->
    <link rel="stylesheet" href="/admin/css/datatables-bs4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="/admin/css/datatables-responsive/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="/admin/css/datatables-buttons/css/buttons.bootstrap4.min.css" />
    <!-- Toastr -->
    <link rel="stylesheet" href="/admin/css/toastr/toastr.min.css">
    {{-- icon --}}
    <link rel="icon" href="{{ url('img/icon/icon-black.png') }}" />
    <!-- ckeditor -->

    <!-- jQuery -->
    <script src="/admin/js/jquery/jquery.min.js"></script>
    <!-- Toastr -->
    <script src="/admin/js/toastr/toastr.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="/admin/js/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin/js/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/admin/js/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/admin/js/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/admin/js/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/admin/js/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <!-- ckeditor -->
    <script src="/admin/js/ckeditor/ckeditor.js"></script>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('dashboard.front.navbar')
        @include('dashboard.front.sidebar')
        @yield('container')
        @yield('script')
        @include('dashboard.front.footer')
    </div>


    <!-- jQuery UI 1.11.4 -->
    <script src="/admin/js/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="/admin/js/bootstrap.bundle.min.js"></script>

    <!-- overlayScrollbars -->
    <script src="/admin/js/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <!-- AdminLTE App -->
    <script src="/admin/js/adminlte.js"></script>

    <!-- bs-custom-file-input -->
    <script src="/admin/js/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>



</body>

</html>

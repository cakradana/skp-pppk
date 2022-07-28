<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <!-- favicon -->
    <link rel="icon" href="/eskp-icon.ico">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
    {{-- Data Table --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="/assets/plugins/toastr/toastr.min.css">
    {{-- Date Range Picker --}}
    <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
    {{--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- My CSS -->
    <link rel="stylesheet" href="/assets/dist/css/style.css">
    {{-- Select2 --}}
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <?php $user = auth()->user(); ?>

    <div class="wrapper">
        {{-- SweetAlert2 --}}
        @include('sweetalert::alert')
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="/assets/dist/img/eskp-icon.png" alt="AdminLTELogo" height="60"
                width="60">
        </div>
        {{-- Header --}}
        @include('layouts.header')
        {{-- Sidebar --}}
        @include('layouts.sidebar')
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1>
                                @yield('judul')
                            </h1>
                        </div>
                    </div>
                </div>
            </section>
            {{-- Isi --}}
            <section class="content">
                <div class="container-fluid">
                    @yield('isi')
                </div>
            </section>
        </div>
        {{-- Footer --}}
        @include('layouts.footer')
    </div>
    {{------------------------------------- SCRIPT -------------------------------------}}
    <!-- jQuery -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/assets/dist/js/demo.js"></script>
    <!-- SweetAlert2 -->
    <script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Data Tables -->
    <script src="/assets/dist/js/dataTables.js"></script>
    <script src="/assets/dist/js/dataTables.min.js"></script>
    <script src="/assets/dist/js/dataTables.bs4.min.js"></script>
    {{-- Date Range Picker --}}
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>
    <script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
    {{-- Select2 --}}
    <script src="/assets/plugins/select2/js/select2.full.min.js"></script>
    {{-- My Script --}}
    <script type="text/javascript" src="/assets/dist/js/myscript.js"></script>
    @stack('script')
</body>

</html>
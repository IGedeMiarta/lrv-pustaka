<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $title }} - Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A premium admin dashboard template by Mannatthemes" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('') }}images/logo.ico">

    <!-- select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{ asset('') }}css/select2.css"> --}}
    <link rel="stylesheet" href="{{ asset('') }}css/select2-bootstrap.css">
    <!-- App css -->
    <link href="{{ asset('') }}css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('') }}css/icons.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('') }}css/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('') }}css/style.css" rel="stylesheet" type="text/css" />

    {{-- datatable --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">


</head>

<body class="account-body accountbg">
    @include('layouts.sidebar')
    @include('layouts.topbar')
    @yield('content')


    <footer class="footer text-center text-sm-left bg-white">
        <div class="container ">
            &copy; 2021 Perpustakaan<span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i
                    class="mdi mdi-heart text-danger"></i></span>
        </div>
    </footer>


    <!-- End Log In page -->
    <!-- jQuery  -->
    <script src="{{ asset('') }}js/jquery.min.js"></script>
    <script src="{{ asset('') }}js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('') }}js/metisMenu.min.js"></script>
    <script src="{{ asset('') }}js/waves.min.js"></script>
    <script src="{{ asset('') }}js/jquery.slimscroll.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('') }}js/app.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

    <!-- select 2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />


    <!-- sweetalert -->
    <script src="{{ asset('') }}sweetalert/sweetalert2.all.min.js"></script>
    <script src="{{ asset('') }}js/myscript.js"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
        $(document).ready(function() {
            $('#datatable2').DataTable();
        });
        $(function() {
            $.extend($.fn.select2.defaults, {
                formatSelectionTooBig: function(limit) {

                    // Callback

                    return 'Too many selected items';
                }
            });

            $('.select2').select2({
                maximumSelectionLength: 3,
                width: "100%"
            });
        });
    </script>

    @yield('script')

</body>

</html>

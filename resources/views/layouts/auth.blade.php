<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $title }} - Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A premium admin dashboard template by Mannatthemes" name="description" />
    <meta content="Mannatthemes" name="author" />

    <!-- App favicon -->

    <!-- App css -->
    <link href="{{ asset('') }}css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('') }}css/icons.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('') }}css/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('') }}css/style.css" rel="stylesheet" type="text/css" />

</head>

<body class="account-body accountbg">

    @yield('content');


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

</body>

</html>

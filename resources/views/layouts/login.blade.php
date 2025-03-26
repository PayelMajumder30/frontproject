<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title')</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet">

        @yield('stylesheets')

        <!-- Custom Fonts -->
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div id="wrapper">

            <div id="page-wrapper">
                @yield('content')
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{ asset('js/metisMenu.min.js')}}"></script>

        @yield('script')
        
        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('js/startmin.js')}}"></script>
    </body>

</html>
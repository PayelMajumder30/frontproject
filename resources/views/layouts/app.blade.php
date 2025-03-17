<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Startmin - Bootstrap Admin Theme</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('css/startmin.css') }}" rel="stylesheet">

        <!-- Morris Charts CSS -->
        {{-- <link href="{{ asset ('css/morris.css')}}" rel="stylesheet"> --}}

        
        <!-- DataTables CSS -->
        <link href="{{ asset('css/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="{{ asset('css/dataTables/dataTables.responsive.css')}}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div id="wrapper">
            @include('layouts.navbar')

            @include('layouts.sidebar')
            <!-- /.sidebar -->

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

        {{-- <!-- Morris Charts JavaScript -->
        <script src="{{ asset('js/raphael.min.js')}}"></script>
        <script src="{{ asset('js/morris.min.js')}}"></script>
        <script src="{{ asset('js/morris-data.js')}}"></script>

        <!-- Flot Charts JavaScript -->
        <script src="{{ asset('js/flot/excanvas.min.js')}}"></script>
        <script src="{{ asset('js/flot/jquery.flot.js')}}"></script>
        <script src="{{ asset('js/flot/jquery.flot.pie.js')}}"></script>
        <script src="{{ asset('js/flot/jquery.flot.resize.js')}}"></script>
        <script src="{{ asset('js/flot/jquery.flot.time.js')}}"></script>
        <script src="{{ asset('js/flot/jquery.flot.tooltip.min.js')}}"></script>
        <script src="{{ asset('js/flot-data.js')}}"></script> --}}
        
        <!-- DataTables JavaScript -->
        <script src="{{ asset('js/dataTables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('js/dataTables/dataTables.bootstrap.min.js')}}"></script>
      

        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('js/startmin.js')}}"></script>
        @yield('script')
    </body>

</html>
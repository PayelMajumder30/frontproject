@extends('layouts.app')

@section('stylesheets')

    <!-- Custom CSS -->
    <link href="{{ asset('css/startmin.css') }}" rel="stylesheet">

    
    <!-- DataTables CSS -->
    <link href="{{ asset('css/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('css/dataTables/dataTables.responsive.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/userchat.css')}}">
@endsection

@section('content')
 
 <!-- Page-Level Demo Scripts - Tables - Use for reference -->

 <div class="container">
    <h3>My Teams</h3>

    @foreach($teams as $team)
        <div class="card mt-3">
            <div class="card-header">
                <strong>{{ $team->team_name }}</strong> (Team Leader)
            </div>
            <div class="card-body">
                <h5>Team Members:</h5>
                <ul>
                    @foreach($team->members as $member)
                        <li>{{ $member->user->name }} ({{ $member->user->email }})</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach

 @endsection

@section('script')

    <!-- DataTables JavaScript -->
    <script src="{{ asset('js/dataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
    
@endsection

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

    {{-- @foreach($teams as $team)
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
    @endforeach --}}

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Team Name</th>
                <th>Team Members</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teams as $index =>  $team)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{ $team->team_name}}</td>
                <td>
                    <ul class="mb-0">
                        @foreach($team->members as $member)
                            <li>{{ $member->user->name}} ({{ $member->user->email}})</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
       
    </table>

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

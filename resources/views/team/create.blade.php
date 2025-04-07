@extends('layouts.app')

@section('stylesheets')

    <!-- Custom CSS -->
    <link href="{{ asset('css/startmin.css') }}" rel="stylesheet">

    
    <!-- DataTables CSS -->
    {{-- <link href="{{ asset('css/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet"> --}}

    <!-- DataTables Responsive CSS -->
    {{-- <link href="{{ asset('css/dataTables/dataTables.responsive.css')}}" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ asset('css/userchat.css')}}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css')}}">
@endsection

@section('content')
 
 <!-- Page-Level Demo Scripts - Tables - Use for reference -->

<div class="container dummystyle">
    <h3>Create a Team</h3>
    <form action="{{ route('team.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label>Team Name:</label>
            <input type="text" name="team_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Select Members:</label>
            <select name="members[]" id="select_members" class="form-control" multiple="multiple">
                @foreach($users as $user)
                    <option value="{{ $user->id}}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Team</button>
    </form>
</div>

@endsection

@section('script')

    <!-- DataTables JavaScript -->
    {{-- <script src="{{ asset('js/dataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables/dataTables.bootstrap.min.js')}}"></script> --}}
    <script src="{{ asset('js/select2.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#select_members').select2({
                placeholder: "Select member",
                allowClear: true
            });
        });
    
    </script>
    
@endsection

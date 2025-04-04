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

<div class="container header-gap">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h3>User Profile</h3>
                </div>
                <div class="card-body text-center">

                    <div class="mb-3">
                        <img src="{{ auth()->user()->image ? asset(auth()->user()->image) : asset('default-profile-png')}}" alt="Profile Picture" class="rounded-circle" width="150" height="150">
                    </div>

                    {{-- User details --}}
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ auth()->user()->name }}
                                @if(auth()->user()->is_team_leader)
                                    <span class="badge bg-success">Team Leader</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ auth()->user()->phone }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ ucfirst(auth()->user()->gender) }}</td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>{{ auth()->user()->designation ? auth()->user()->designation->title : 'N/A'}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ auth()->user()->address }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('profile.edit')}}" class="btn btn-sm btn-success">
                        <i class="fa fa-edit"></i> Update Profile
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>



@endsection

@section('script')

    <!-- DataTables JavaScript -->
    <script src="{{ asset('js/dataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true;
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var chatBox = document.getElementById("chat-box");
            chatBox.scrollTop = chatBox.scrollHeight;
        });
    </script>
@endsection

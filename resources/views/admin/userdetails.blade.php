@extends('layouts.app')

@section('stylesheets')

    <!-- Custom CSS -->
    <link href="{{ asset('css/startmin.css') }}" rel="stylesheet">

    
    <!-- DataTables CSS -->
    <link href="{{ asset('css/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('css/dataTables/dataTables.responsive.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/adminchat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   
@endsection


@section('content')
 
 <!-- Page-Level Demo Scripts - Tables - Use for reference -->

 <div class="container dummystyle">
    <h2>User Details</h2>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('admin.userdetails')}}" class="d-flex justify-content-end">
        <div class="form-group ml-2">
            <input type="search" class="form-control form-control-sm" name="keyword" id="keyword" value="{{ request()->input('keyword') }}" placeholder="Search something...">
        </div>
        <div class="form-group ml-2">
            <div class="btn-group">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fa fa-filter"></i>
                </button>
                <a href="{{ url()->current() }}" class="btn btn-sm btn-light" data-toggle="tooltip" title="Clear filter">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
    </form>
    
    <div class="row">
        @foreach($users as $user)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header head_detail">
                    <h4>{{ $user->name }}'s Profile</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset($user->image ?? 'default-profile.png') }}" class="img-fluid img-circle" alt="Profile Image" height="130" width="130">
                        </div>
                        <div class="col-md-8">
                            <p><strong>Name:</strong> {{ ucfirst($user->name) }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                            <p><strong>Gender:</strong> {{ ucfirst($user->gender) ?? 'N/A' }}</p>
                            <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                            <p><strong>Designation:</strong> {{ $user->designation ? $user->designation->title : 'N/A' }}</p>
                            <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>
                        </div>
                    </div>
                  
                        <a href="{{ route('admin.adminchat', $user->id) }}" class="btn btn-primary w-50 me-2">Chat with User</a>
                        {{-- <a href="" class="btn btn-secondary w-50">View Profile</a> --}}
                        <a href="{{ route('admin.useredit', $user->id)}}" class="btn btn-primary w-50 me-2">Edit User Details</a>
               
                </div>
            </div>
        </div>
        @endforeach
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
                responsive: true
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
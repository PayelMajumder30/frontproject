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
        <h2>Update Profile</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success')}}
            </div>
        @endif

        <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name"  value="{{ auth()->user()->name }}" class="form-control">
                @error('name') <small class="text-danger">{{$message}}</small> @enderror
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="{{ auth()->user()->email}}" class="form-control">
                @error('email') <small class="text-danger">{{$message}}</small> @enderror
            </div>
            
            <div class="form-group">
                <label>Phone Number:</label>
                <input type="text" name="phone" value="{{ auth()->user()->phone}}" class="form-control">
                @error('phone') <small class="text-danger">{{$message}}</small> @enderror
            </div>

            <div class="form-group">
                <label>Profile Image:</label>
                <input type="file" name="image" value="" class="form-control">
                @error('image') <small class="text-danger">{{$message}}</small> @enderror
                @if(auth()->user()->image)
                    <img src="{{ asset(auth()->user()->image)}}" width="100" class="mt-2">
                @endif
            </div>

            <div class="form-group">
                <label>Address:</label>
                <input type="text" name="address" value="{{ auth()->user()->address}}" class="form-control">
                @error('address') <small class="text-danger">{{$message}}</small> @enderror
            </div>

            <div class="form-group">
                <label>New Password:</label>
                <input type="password" name="password" class="form-control">
                @error('password') <small class="text-danger">{{$message}}</small> @enderror
            </div>

            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
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

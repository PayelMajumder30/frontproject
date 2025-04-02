@extends('layouts.app')

@section('stylesheets')

    <!-- Custom CSS -->
    <link href="{{ asset('css/startmin.css') }}" rel="stylesheet">

    
    <!-- DataTables CSS -->
    <link href="{{ asset('css/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('css/dataTables/dataTables.responsive.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/adminchat.css') }}">
   
@endsection

@section('content')

<div class="container dummystyle">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2>Edit User Details</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.userupdate', $user->id) }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">Name <span style="color: red;">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span style="color: red;">*</span></label>
                            <input type="text" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone <span style="color: red;">*</span></label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
                        </div>

                        
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" name="gender">
                                <option value="" {{ !$user->gender ? 'selected' : '' }}>Select Gender</option>
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address">Phone <span style="color: red;">*</span></label>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="designation_id">Designation</label>
                            <select class="form-control" name="designation_id">
                                <option value="">Select Designation</option>
                                @foreach($designations as $designation)
                                    <option value="{{ $designation->id}}" {{$user->designation_id == $designation->id ? 'selected' : ''}}>
                                        {{ $designation->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Update User</button>
                        <a href="{{ route('admin.userdetails')}}" class="btn btn-sm btn-danger">Back</a>
                    </form>
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
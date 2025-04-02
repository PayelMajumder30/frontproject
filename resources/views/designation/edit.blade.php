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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-3">
                        <div class="col-md-12 text-right">
                            <a href="{{route('designation.list.all')}}" class="btn btn-sm btn-primary"><i class="fa fa-chevron-left"></i>Back</a>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('designation.update')}}" method="POST">
                    @csrf
                    @method('POST')
                        <div class="row form-group">
                            <div class="col-md-6" style="margin-top: 50px;">
                                <label for="title">Title <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter social title.." value="{{ old('title') ? old('title') : $data->title }}">
                                @error('title') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <button type="submit" class="btn btn-primary ">Update</button>
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
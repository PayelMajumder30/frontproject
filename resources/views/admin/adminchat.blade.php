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
 
 <!-- Page-Level Demo Scripts - Tables - Use for reference -->

<div class="container mt-4">
    <h3 class="text-center">Chat with {{ $user->name}}</h3>
    <div class="chat-box p-3 rounded" id="chat-box">
        @foreach($chats as $chat)
            <div class="chat-message {{ $chat->sender == 'admin' ? 'admin' : 'user'}}">
                <div class="message-content">
                    <strong>
                        @if($chat->sender == 'admin')
                            Admin:
                        @else
                            {{ $user->name}}
                        @endif
                    </strong>
                    <p>{{$chat->message}}</p>
                    <small class="time">
                        {{ date('d-m-Y h:i A',strtotime($chat->created_at))}}
                    </small>
                </div>
            </div>
        @endforeach
    </div>
    <form action="{{ route('admin.adminchat.send', $userId)}}" method="POST" class="mt-3">
    @csrf
        <div class="d-flex">
            <textarea name="message" class="form-control me-2" placeholder="Type your message..." style="height: 50px; resize: none;"></textarea>
            <button type="submit" class="btn btn-primary adminsend">Send</button>
            <a href="{{route('users')}}" class="btn btn-danger adminsend">Back</a>
        </div>
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
 
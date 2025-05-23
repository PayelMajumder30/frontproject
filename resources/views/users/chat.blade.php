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
 
<div class="container mt-4">
    <h3 class="text-center heading">Chat with Admin</h3>
    <div class="chat-box p-3 border-rounded" id="chat-box">
        @foreach($chats as $chat)
            <div class="chat-message {{ $chat->sender == 'admin' ? 'admin' : 'user' }}">
                <strong>
                    @if($chat->sender == 'admin')
                        Admin:
                    @else
                        {{$user->name}}:
                    @endif    
                </strong> 
                <p>{{ $chat->message }}</p>
                <small class="time">
                    {{ date('d-m-Y h:i A',strtotime($chat->created_at))}}
                </small>
            </div>
        @endforeach
    </div>
    <form action="{{route('users.chat.send', ['userId' => auth()->id()])}}" method="POST">
        @csrf
        <div class="d-flex">
            <textarea name="message" class="form-control me-2 usersend shrink-textarea" placeholder="Type your message..."></textarea>
            <button type="submit" class="btn btn-sm btn-success usersend">Send</button>
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
    
@endsection
 
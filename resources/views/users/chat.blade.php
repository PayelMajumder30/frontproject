@extends('layouts.app')

@section('stylesheets')

    <!-- Custom CSS -->
    <link href="{{ asset('css/startmin.css') }}" rel="stylesheet">

    
    <!-- DataTables CSS -->
    <link href="{{ asset('css/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('css/dataTables/dataTables.responsive.css')}}" rel="stylesheet">
@endsection

@section('content')
 
 <!-- Page-Level Demo Scripts - Tables - Use for reference -->
 
   <div class="container">
        <h3>Chat with Admin</h3>
        <div class="chat-box">
            @foreach($chats as $chat)
                <div class="chat-message {{ $chat->sender == 'admin' ? 'admin' : 'user' }}">
                    <strong>
                        @if($chat->sender == 'admin')
                            Admin:
                        @else
                            {{$user->name}}:
                        @endif    
                    </strong> {{ $chat->message }}
                </div>
            @endforeach
        </div>
        <form action="{{route('users.chat.send', ['userId' => auth()->id()])}}" method="POST">
            @csrf
            <textarea name="message" class="form-control" placeholder="Type your message..." required></textarea>
            <button type="submit" class="btn btn-sm btn-primary">Send</button>
         
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
 
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
 
    <div class="container dummystyle">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User List</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List of all registered users
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr class="success">
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{strtoupper($user->role)}}</td>
                                        <td>  
                                            <a href="{{ route('admin.adminchat', $user->id)}}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-comment"></i> Chat
                                            </a> 
                                            
                                            <form action="{{ route('admin.makeTeamleader', $user->id)}}" method="post" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm {{ $user->is_team_leader ? 'btn-success' : 'btn-warning'}}">
                                                    <i class="fa {{ $user->is_team_leader ? 'fa-user-check' : 'fa-user-plus'}}"></i>
                                                    {{ $user->is_team_leader ? 'Change Team Leader' : 'Make Team Leader'}}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
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
 
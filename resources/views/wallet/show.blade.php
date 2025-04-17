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

<div class="container">
    <h2>My Wallet</h2>

    @if($totalBalance > 0)
        <p><strong>Wallet Balance:</strong> {{env('CURRENCY')}}{{ number_format($totalBalance, 2)}}</p>
        <a href="{{ route('wallet.create') }}" class="btn btn-secondary">Add More</a>
    @else
        <p>No Wallet Balance Yet.</p>
        <a href="{{ route('wallet.create')}}" class="btn btn-primary">Recharge Wallet</a>
    @endif

    <hr>

    {{-- <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th> 
                <th>Last Recharge amount</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $sl = 0;
            @endphp
            @forelse($wallet as $index => $item)
            @php 
                $sl++;
            @endphp
                <tr>
                    <td>{{ $sl }}</td>
                    <td>{{ env('CURRENCY')}}{{ number_format($item->wallet_balance, 2) }}</td>
                    <td>{{date('d-m-Y h:i A', strtotime($item->created_at))}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No wallet transactions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table> --}}
    
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
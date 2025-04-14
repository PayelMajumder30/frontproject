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

    @if($wallet && $wallet->wallet_balance > 0)
        <p><strong>Wallet Balance:</strong> {{env('CURRENCY')}}{{ number_format($wallet->wallet_balance, 2)}}</p>
        <a href="{{ route('wallet.create') }}" class="btn btn-secondary">Add More</a>
    @else
        <p>No Wallet Balance Yet.</p>
        <a href="{{ route('wallet.create')}}" class="btn btn-primary">Recharge Wallet</a>
    @endif

    <hr>

    <h2>Wallet Deduction History</h2>
    @if($invoices->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Amount Deducted</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->invoice_number}}</td>
                        <td>{{ env('CURRENCY')}}{{number_format($invoice->total_amount, 2)}}</td>
                        <td>{{date('d-m-Y h:i A', strtotime($invoice->created_at))}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No transactions found.</p>
    @endif
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
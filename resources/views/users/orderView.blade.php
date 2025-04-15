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

<div class="container dummystyle">
    <h4 class="mb-4"><strong>Invoice: {{ $invoice->invoice_number}}</strong></h4>

    <table class="table table-bordered shadow-sm">
        <thead class="table-secondary text-center">
            <tr>
                <th class="text-end">Product</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Item Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
                <tr>
                    <td class="text-end">{{ $item->product->name ?? 'N/A'}}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-center">{{env('CURRENCY')}} {{ number_format($item->amount, 2)}}</td>
                </tr>
            @endforeach
            <tr class="table-light fw-bold">
                <td colspan="2" class="text-right">Total Amount</td>
                <td>₹ {{ number_format($invoice->total_amount, 2) }}</td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('users.orderHistory')}}" class="btn btn-sm btn-info">Back</a>
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
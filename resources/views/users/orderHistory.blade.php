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
    <h3 class="mb-4">My Orders</h3>

    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-3">
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>

        <div class="col-md-3">
            {{-- <input type="text" id="search" class="form-control" placeholder="Search by product name, price, or invoice no"> --}}
            <input type="text" id="search" name="keyword" class="form-control" placeholder="Search here" value="{{ request('keyword') }}">
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fa fa-filter"></i>
            </button>
            <a href="{{ url()->current()}}" data-toggle="tooltip" title="clear filter">
                <i class="fa fa-times"></i>
            </a>
        </div>
       
    </form>

    <div class="container dummystyle">
        <table class="table table-striped table-bordered align-middle shadow-sm">
            <thead class="table-primary text-center">
                <tr>
                    <th class="text-center">Invoice No</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Order Date</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                    <tr class="text-center">
                        <td>{{ $invoice->invoice_number }}</td>
                        <td>{{ $invoice->total_qty}}</td>                        
                        <td class="text-success fw-bold">
                            {{env('CURRENCY')}} {{ number_format($invoice->total_amount, 2) }}
                        </td>
                        <td class="text-muted small">{{ $invoice->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('users.orderView',  $invoice->id)}}" class="btn btn-sm btn-info">View Details</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-muted text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="d-flex justify-content-end">
        {{ $invoices->appends(request()->query())->links() }}
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
    
@endsection
 

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
<div class="card">
    <h1>Ledger</h1>
    <div class="card-header">
        <div class="form-row align-items-end mb-3">
            <div class="form-group col-md-3 filter">
                <label>Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request()->input('start_date') }}">
            </div>
            <div class="form-group col-md-3 filter">
                <label>End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->input('end_date') }}">
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="container">
    
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Purpose</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Transaction Number</th>
                        <th>Transaction Amount</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ledgers as $index => $ledger)
                        <tr>
                            <td>{{ $index + 1 }}</td>
        
                            {{-- User Name --}}
                            <td>{{ $ledger->user->name ?? 'Unknown User' }}</td>
        
                            {{-- Purpose Type --}}
                            <td>{{ ucfirst($ledger->purpose ?? 'N/A')}}</td>
        
                            <td>{{ $ledger->is_debit ? 'Yes' : ($ledger->is_credit ? '' : 'N/A')}}</td>
                            <td>{{ $ledger->is_credit ? 'Yes' : ($ledger->is_debit ? '' : 'N/A')}}</td>
                        
                            {{-- Transaction Number --}}
                            <td>
                                @if($ledger->is_debit && $ledger->invoice)
                                    {{ $ledger->invoice->invoice_number }}
                                @else
                                    —
                                @endif
                            </td>
        
                            {{-- Transaction Amount --}}
                            <td>
                                @if($ledger->is_credit)
                                {{env('CURRENCY')}}{{ number_format($ledger->transaction_amount, 2) }}
                                @elseif($ledger->is_debit)
                                {{env('CURRENCY')}}{{ number_format($ledger->transaction_amount, 2) }}
                                @else
                                    —
                                @endif
                            </td>
        
                            <td>
                                @if($ledger->is_credit)
                                    Wallet Recharge
                                @elseif($ledger->is_debit)
                                    Order Payment
                                @else
                                    —
                                @endif
                            </td>
        
                            {{-- Date --}}
                            <td>{{ $ledger->created_at->format('d-m-Y H:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
    
@endsection
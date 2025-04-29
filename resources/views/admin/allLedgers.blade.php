@extends('layouts.app')

@section('stylesheets')

    <!-- Custom CSS -->
    <link href="{{ asset('css/startmin.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{{ asset('css/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('css/dataTables/dataTables.responsive.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/adminchat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4 shadow-sm">
                <div class="card-header text-black align-items-center">
                    <h3 class="mb-0">All Ledgers</h3>
                </div>

                <div class="card-body">
                    <form method="GET" action="{{ url()->current() }}">
                        <div class="form-row align-items-end mb-3">
                            <div class="form-group col-md-3 filter">
                                <label>Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request()->input('start_date') }}">
                            </div>

                            <div class="form-group col-md-3 filter">
                                <label>End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->input('end_date') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="keyword">Search</label>
                                <input type="search" name="keyword" id="keyword" class="form-control" placeholder="Search by name, invoice, etc." value="{{ request()->input('keyword') }}">
                                <div id="search-suggestions" class="list-group position-absolute w-100" style="z-index:1000;"></div>
                            </div>

                            <div class="form-group col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i class="fa fa-filter"></i> 
                                </button>
                                <a href="{{ url()->current() }}" class="btn btn-secondary" data-toggle="tooltip" title="Clear filter">
                                    <i class="fa fa-times"></i> Clear
                                </a>
                            </div>
                        </div>
                    </form>

                    <div id="invoice-table">
                        <table class="table table-bordered table-sm text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 50px">#</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Transaction ID</th>
                                    <th class="text-center">User's Name</th>
                                    <th class="text-center">Transaction Amount</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Credit</th>
                                    <th class="text-center">Debit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ledgers as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td class="fiels">{{ date('d-m-Y h:i A',strtotime($item->created_at))}}</td>
                                        <td class="fiels">{{ $item->transaction_number != '0' ? $item->transaction_number : '-'}}</td>
                                        <td class="fiels">{{ $item->user ? $item->user->name : 'N/A'}}</td>
                                        <td class="fiels">{{ number_format($item->transaction_amount, 2)}}</td>
                                        <td>
                                            @if($item->is_credit)
                                                Credit
                                            @elseif($item->is_debit)
                                                Debit
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->is_credit)
                                            Wallet Recharge
                                        @elseif($item->is_debit)
                                            Order Payment
                                        @endif
                                        </td>
                                        <td>
                                            @if($item->is_credit)
                                                {{ number_format($item->transaction_amount, 2) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->is_debit)
                                                {{ number_format($item->transaction_amount, 2) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No record found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right font-weight-bold">Total</td>
                                    <td class="text-right font-weight-bold">{{ number_format($totalCredit + $totalDebit, 2)}}</td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right font-weight-bold">{{ number_format($totalCredit, 2)}}</td>
                                    <td class="text-right font-weight-bold">{{ number_format($totalDebit, 2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="8" class="text-center font-weight-bold subtotal-row">Balance</td>
                                    <td class="text-right font-weight-bold">{{ number_format($balance, 2)}}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $ledgers->appends(request()->query())->links() }}
                        </div>
                    </div>
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
    
        //search by data fields
        $('#keyword').on('keyup', function () {
            let keyword = $(this).val().toLowerCase();
            let subtotal = 0;
    
            $('table tbody tr').not('.subtotal-row').each(function () {
                let row = $(this);
                let rowText = '';
    
                row.find('.fiels').each(function () {
                    rowText += $(this).text().toLowerCase() + ' ';
                });
    
                if (rowText.includes(keyword)) {
                    row.show();
    
                    // Get amount value from the correct column (assuming it's the 3rd .fiels — adjust index if needed)
                    let amount = parseFloat(row.find('.fiels').eq(2).text().replace(/,/g, ''));
                    if (!isNaN(amount)) {
                        subtotal += amount;
                    }
                } else {
                    row.hide();
                }
            });
    
            // Update subtotal text (assuming this cell is inside the `.subtotal-row`)
            $('.subtotal-row td:last').text(subtotal.toFixed(2));
        });
    
        document.addEventListener('DOMContentLoaded', function () {
            var selects = document.getElementsByClassName('filter');
    
            Array.from(selects).forEach(function(select) {
                select.addEventListener('change', function () {
                    var form = select.closest('form');
                    if (form) {
                    form.submit();
                    }
                });
            });
        });
    
    </script>


@endsection
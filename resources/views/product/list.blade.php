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
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4 shadow-sm">
                <div class="card-header text-black align-items-center">
                    <h3 class="mb-0">Sales Generate</h3>
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
                            </div>

                            {{-- <div class="form-group col-md-3">
                                <label for="selected_name">Select Name</label>
                                <select name="selected_name" class="form-control">
                                    <option value="">-- Select Name --</option>
                                    @foreach($matchingNames as $name)
                                        <option value="{{ $name }}" {{ request()->input('selected_name') == $name ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}

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
                                <tr class="text-center">
                                    <th style="width: 50px">#</th>
                                    <th>Name</th>
                                    <th>Invoice ID</th>
                                    <th>Total Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $index => $item)
                                    <tr>
                                        <td>{{ $index + $data->firstItem() }}</td>
                                        <td class="fiels">{{ $item->user_name }}</td>
                                        <td class="fiels">{{ $item->invoice_number }}</td>
                                        <td class="fiels">{{ number_format($item->total_amount, 2) }}</td>
                                        <td class="fiels">{{ date('d-m-Y h:i A', strtotime($item->created_at)) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No records found</td>
                                    </tr>
                                @endforelse
    
                                @if($data->count() > 0)
                                    <tr class="bg-light font-weight-bold subtotal-row">
                                        <td colspan="3" class="text-right">Sub-total:</td>
                                        <td colspan="2" class="text-left">{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $data->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')

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


    <!-- DataTables JavaScript -->
    <script src="{{ asset('js/dataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables/dataTables.bootstrap.min.js')}}"></script>

        
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>company invoice - Bootdey.com</title>

    <meta name="csrf-token" content="{{ csrf_token() }}"> 

    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
      <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrapproduct.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/product.css')}}">
</head>
<body>

<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

{{-- <form action="{{ route('product.submit')}}" method="POST"> --}}
    {{-- @csrf --}}
    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Invoice
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    ID: # {{ date('Ymd'). '-' . rand(100, 999)}}
                </small>
            </h1> 
        </div>
    
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        {{-- <div class="col-12">
                            <div class="text-center text-150">
                                <i class="fa fa-book fa-2x text-success-m2 mr-1"></i>
                                <span class="text-default-d3">Bootdey.com</span>
                            </div>
                        </div> --}}
                    </div>
                    <!-- .row -->
                    
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                        <div id="invoice-area" class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span class="text-600 text-110 text-blue align-middle">{{ $user->name }}</span>
                                    <div class="text-grey-m2">
                                        <div class="my-1">
                                            <i class="fa fa-map-marker-alt text-secondary mr-1"></i>
                                            {{ $user->address ?? 'N/A' }}
                                        </div>
                                        <div class="my-1">
                                            <i class="fa fa-envelope text-secondary mr-1"></i>
                                            {{ $user->email ?? 'N/A' }}
                                        </div>
                                        <div class="my-1">
                                            <i class="fa fa-phone fa-flip-horizontal text-secondary"></i>
                                            <b class="text-600">{{ $user->phone ?? 'N/A' }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <table class="table table-bordered mt-4">
                                <thead class="text-600 text-white bgc-default-tp1 py-25 bg-dark rounded">
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 35%;">Items</th>
                                        <th style="width: 15%;">Price</th>
                                        <th style="width: 16%;">Quantity</th>
                                        <th style="width: 15%;">Total Price</th>
                                        <th class="action-col" style="width: 10%;">Action</th>
                                    </tr>
                                </thead>

                             
                                <tbody id="product-rows">
                                    <tr class="product-row align-middle text-center">
                                        <td class="row-number">1</td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control product-select" name="product_id[]">
                                                    <option value="">Select Product</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>                                  
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="price[]" class="form-control price text-center" readonly>
                                            </div>                               
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center form-group">
                                                <button type="button" class="btn btn-sm btn-danger qty-minus">-</button>
                                                <input type="text" name="quantity[]" class="form-control qty mx-1 text-center" value="1" style="width: 60px;">
                                                <button type="button" class="btn btn-sm btn-success qty-plus">+</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="total[]" class="form-control total-price text-center" readonly>
                                            </div>
                                        </td>
                                        <td class="text-center action-col">
                                            <button type="button" class="btn btn-sm btn-danger remove-row">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        
                            <div class="text-left mt-4">
                                <button type="button" id="add-more" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> Add More
                                </button>
                            </div>
                        
                            <div class="row mt-4">
                                <div class="col-sm-9 text-grey-d2 text-95">
                                    Thank you for your business
                                </div>
    
                                <div class="col-sm-3 text-right d-flex flex-column align-items-end invoice-total">
                                    <div class="d-flex w-100 align-items-center">
                                        <span class="me-2">SubTotal</span> 
                                        <input type="text" id="subtotal" class="form-control text-end">
                                    </div>
                                    <div class="mt-4 text-end text-muted bold" id="subtotal-words"></div>
                                </div>
                            </div>
                        </div>
                    
                        {{-- Print Button --}}
                        <div class="page-tools mt-3">
                            <div class="action-buttons">
                                <button type="button" class="btn bg-white btn-light mx-1px text-95" id="print-button">
                                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                                    Print
                                </button>
                                {{-- <button type="submit" class="btn bg-white btn-light mx-1px text-95 mb-0" id="submit-button">
                                    <i class="fa fa-upload text-success-m1 text-120 w-2 mr-1"></i>
                                    Submit
                                </button> --}}
                            </div>
                        </div>                     
                    <hr/>
                </div>
            </div>
        </div>
    </div>
{{-- </form> --}}

<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function () {

        function updateTotal(row) {
            let price = parseFloat(row.find('.price').val()) || 0;
            let qty = parseInt(row.find('.qty').val()) || 1;
            let total = price * qty;
            row.find('.total-price').val(total.toFixed(2));
            updateSubtotal(); // Call to refresh subtotal
        }

        function numberToWords(num){
            const a = ['', 'One', 'Two', 'Three','Four','Five','Six','Seven','Eight','Nine','Ten',
               'Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventeen','Eighteen','Nineteen'];
            const b = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

            if(num === 0)
            return 'Zero';
            function convert (n) {
                if(n < 20) return a[n];
                if(n < 100) return b[Math.floor(n/10)] + (n % 10 ? " " + a[n % 10] : "");
                if(n < 1000) return a[Math.floor(n/100)] + "Hundred" + (n % 100 ? " and " + convert(n % 100) : "");
                if(n < 100000) return convert(Math.floor(n/1000)) + "Thousand" + (n % 1000 ? " " + convert(n % 1000) : "");
                if(n < 10000000) return convert(Math.floor(n/100000)) + "Lakh" + (n % 100000 ? " " + convert(n % 100000) : "");
                return convert(Math.floor(n/10000000)) + " Crore " + (n % 10000000 ? " " + convert(n % 10000000) : "");
        }
        return convert(Math.floor(num)) + " Rupees Only ";
        }
        function updateSubtotal() {
           
            let subtotal = 0;
            $('.total-price').each(function () {
                console.log('total-price');
                let val = parseFloat($(this).val()) || 0;
                subtotal += val;
            });
            $('#subtotal').val(subtotal.toFixed(2));
            $('#subtotal-words').text(numberToWords(subtotal));
        }

        function updateRowNumbers() {
            $('.product-row').each(function(index) {
                $(this).find('.row-number').text(index + 1);
            });
        }

        //dropdown
        function selectedProductIds() {
            let selected = [];
            $('.product-select').each(function () {
                let val = $(this).val();
                if (val) selected.push(val);
            });
            return selected;
        }

        function updateProductDropdowns() {
            let selectedIds = selectedProductIds();

            $('.product-select').each(function () {
                let currentVal = $(this).val();
                $(this).find('option').each(function () {
                    let optionVal = $(this).val();
                    if (optionVal === "") return; // keep "Select Product"

                    if (selectedIds.includes(optionVal) && optionVal !== currentVal) {
                        $(this).hide(); 
                    } else {
                        $(this).show(); 
                    }
                });
            });
        }

        function bindRowEvents(row) {
            row.find('.product-select').off().on('change', function () {
                let productId = $(this).val();
                let currentRow = $(this).closest('.product-row');

                updateProductDropdowns();
                if (productId) {
                    $.ajax({
                        url: '/product/getProductPrice/' + productId,
                        type: 'GET',
                        success: function (data) {
                            currentRow.find('.price').val(data.price);
                            updateTotal(currentRow);
                        }
                    });
                } else {
                    currentRow.find('.price').val('');
                    currentRow.find('.total-price').val('');
                    updateSubtotal();
                }
            });

            row.find('.qty-plus, .qty-minus').off().on('click', function () {
                let qtyInput = row.find('.qty');
                let qty = parseInt(qtyInput.val());
                if ($(this).hasClass('qty-plus')) {
                    qtyInput.val(qty + 1);
                } else if (qty > 1) {
                    qtyInput.val(qty - 1);
                }
                updateTotal(row);
            });

            row.find('.qty').off().on('input', function () {
                updateTotal(row);
            });

            row.find('.remove-row').off().on('click', function () {
                $(this).closest('.product-row').remove();
                updateRowNumbers();
                updateSubtotal();
                updateProductDropdowns(); 
            });
        }

        // Bind existing row
        bindRowEvents($('.product-row'));

        // Add More Button
        $('#add-more').click(function () {
            
            let lastRow = $('.product-row').last();
            let newRow = lastRow.clone();

            newRow.find('select').val('');
            newRow.find('.price').val(0);
            newRow.find('.qty').val(1);
            newRow.find('.total-price').val('');

            $('#product-rows').append(newRow);
            bindRowEvents(newRow);
            updateRowNumbers();
            updateProductDropdowns(); 
        });

        updateSubtotal(); // initialize subtotal
    });
</script>

<script>
    // function printInvoice(){
    //     const selects   = document.querySelectorAll('.product-select');
    //     let allValid    = true;
        
    //     document.querySelectorAll('.product-error').forEach(el => el.remove());
    //     selects.forEach((select, index) => {
    //     if (select.value === '') {
    //         allValid = false;
            
    //         const errorDiv      = document.createElement('div');
    //         errorDiv.className  = 'text-danger product-error';
    //         errorDiv.textContent= 'Please select a product for this row.';
    //         select.parentNode.appendChild(errorDiv);
    //         }
    //     });
    //     if (!allValid) {
    //         return;
    //     }
    //     window.print();
    // }
    document.getElementById('add-more', 'print-button').addEventListener('click', function (e) {
        e.preventDefault(); // stops default form submission
        // your logic to add new row goes here...
    });

    document.getElementById('print-button').addEventListener('click', function (e) {
        e.preventDefault();

        // Remove old error messages
        document.querySelectorAll('.text-danger').forEach(el => el.remove());

        let formData = {
            product_id  : [],
            quantity    : [],
            price       : [],
            total       : [],
            _token: '{{ csrf_token() }}'
        };

        let valid = true;

        document.querySelectorAll('.product-row').forEach((row, index) => {
            let productSelect   = row.querySelector('.product-select');
            let qtyInput        = row.querySelector('.qty');
            let priceInput      = row.querySelector('.price');
            let totalInput      = row.querySelector('.total-price');

            let productId   = productSelect.value;
            let qty         = qtyInput.value;
            let price       = priceInput.value;
            let total       = totalInput.value;

            if (!productId) {
                let error   = document.createElement('div');
                error.className = 'text-danger';
                error.innerText = 'Please select a product.';
                productSelect.parentElement.appendChild(error);
                valid = false;
            }

            formData.product_id.push(productId);
            formData.quantity.push(qty);
            formData.price.push(price);
            formData.total.push(total);
        });

        if (!valid) return;

        fetch('{{ route('product.submit') }}', {
            method: 'POST',
            headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
            body: JSON.stringify(formData)
        })
        .then(res => res.json())
        // .then(response => {
        //     if (response.success) {
        //         alert('Invoice submitted successfully.');
        //         window.onafterprint = function () {
        //             location.reload();
        //         };
        //         window.print();
        //     } else if (response.errors) {
        //         // Optional: Show Laravel validation errors from backend
        //         Object.entries(response.errors).forEach(([field, messages]) => {
        //             alert(messages.join('\n')); // You can also show this inline per field
        //         });
        //     }
        // })
        .then(response => {
            if (response.success) {
                alert('Invoice submitted successfully.');
                window.onafterprint = function () {
                    location.reload();
                };
                window.print();
            } else {
                // Show custom message like "Insufficient balance..."
                if (response.message) {
                    alert(response.message || 'Something went');
                }

                // Show validation errors if available
                if (response.errors) {
                    Object.entries(response.errors).forEach(([field, messages]) => {
                        alert(messages.join('\n'));
                    });
                }
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Something went wrong!');
        });
    });


</script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
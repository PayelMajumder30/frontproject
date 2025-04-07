<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>company invoice - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
      <!-- Bootstrap Core CSS -->
      <link href="{{ asset('css/bootstrapproduct.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/product.css')}}">
</head>
<body>

<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

<div class="page-content container">
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            Invoice
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: #111-222
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
            
                <div class="row text-600 text-white bgc-default-tp1 py-25 bg-dark rounded">
                    <div class="col-1">#</div>
                    <div class="col-4">Items</div>
                    <div class="col-2">Price</div>
                    <div class="col-2">Qty</div>
                    <div class="col-2">Total Price</div>
                    <div class="col-1 action-col">Action</div>
                </div>
            
                <div id="product-rows">
                    <div class="row py-2 align-items-center product-row">
                        <div class="col-1 row-number">1</div>
                        <div class="col-4">
                            <select class="form-control product-select">
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control price" readonly>
                        </div>
                        <div class="col-2 d-flex align-items-center">
                            <button class="btn btn-sm btn-danger qty-minus">-</button>
                            <input type="text" class="form-control qty mx-1 text-center" value="1" style="width: 60px;">
                            <button class="btn btn-sm btn-success qty-plus">+</button>
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control total-price" readonly>
                        </div>
                        <div class="col-1 text-center action-col">
                            <button class="btn btn-sm btn-danger remove-row">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            
                <div class="text-left mt-4">
                    <button id="add-more" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Add More
                    </button>
                </div>
            
                <div class="row mt-4">
                    <div class="col-sm-9 text-grey-d2 text-95">
                        Extra note such as company or payment information...
                    </div>

                    {{-- <div class="row mt-4 justify-content-end">
                        <div class="col-sm-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>SubTotal (INR):</strong>
                                <input type="text" id="subtotal" class="form-control text-end w-50" readonly>
                            </div>
                            <div class="mt-2 text-end text-muted fst-italic" id="subtotal-words"></div>
                        </div>
                    </div> --}}
                    <div class="col-sm-3 text-right d-flex">
                            <span>SubTotal</span> 
                            <input type="text" id="subtotal" class="form-control">
                    </div>
                </div>
            
                <div class="mt-4">
                    <span class="text-secondary-d1 text-105">Thank you for your business</span>
                </div>
            </div>
            
            {{-- Print Button --}}
            <div class="page-tools mt-3">
                <div class="action-buttons">
                    <button class="btn bg-white btn-light mx-1px text-95" id="print-button">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </button>
                </div>
            </div>  
                
            <hr />
            </div>
        </div>
    </div>
</div>
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

        function updateSubtotal() {
           
            let subtotal = 0;
            $('.total-price').each(function () {
                console.log('total-price');
                let val = parseFloat($(this).val()) || 0;
                subtotal += val;
            });
            $('#subtotal').val(subtotal.toFixed(2));
        }

        function updateRowNumbers() {
            $('.product-row').each(function(index) {
                $(this).find('.row-number').text(index + 1);
            });
        }

        function bindRowEvents(row) {
            row.find('.product-select').off().on('change', function () {
                let productId = $(this).val();
                let currentRow = $(this).closest('.product-row');
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
            });
        }

        // Bind existing row
        bindRowEvents($('.product-row'));

        // Add More Button
        $('#add-more').click(function () {
            let lastRow = $('.product-row').last();
            let newRow = lastRow.clone();

            newRow.find('select').val('');
            newRow.find('.price').val('');
            newRow.find('.qty').val(1);
            newRow.find('.total-price').val('');

            $('#product-rows').append(newRow);
            bindRowEvents(newRow);
            updateRowNumbers();
        });

        updateSubtotal(); // initialize subtotal
    });
</script>

<script>
    // document.getElementById('pdfForm').addEventListener('submit', function(e) {
    //     let products = [];
    
    //     document.querySelectorAll('.product-row').forEach(function(row) {
    //         const productId = row.querySelector('.product-select').value;
    //         const price = row.querySelector('.price').value;
    //         const qty = row.querySelector('.qty').value;
    
    //         if (productId) {
    //             products.push({
    //                 id: productId,
    //                 price: price,
    //                 qty: qty
    //             });
    //         }
    //     });
    
    //     document.getElementById('productData').value = JSON.stringify(products);
    // });
    document.getElementById('print-button').addEventListener('click', function () {
        window.print(); // Let browser handle it (user can Save as PDF or print)
    });

    

</script>
    

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>
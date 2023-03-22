@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">REPORT ORDERS</a></li>
                    <li class="breadcrumb-item active text-danger">RESELLER PENDING PAGE</li>
                </ul>

                <h1 class="page-header text-danger">
                    Reseller Pending
                </h1>
            </div>
            <div class="ms-auto">
                <div class="mt-3">
                    <select class="form-select fw-bold text-theme border-theme" id="store" style="width: 250px;">
                        <option value="ALL">ALL STORE</option>
                        @foreach ($store as $stores)
                            <option value="{{ $stores->id_store }}">{{ $stores->store }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="ms-sm-3 mt-2">
                <div id="reportrange" class="btn btn-outline-theme d-flex align-items-center mt-2">
                    <span class="text-truncate">&nbsp;tanggal sekarang &nbsp;</span>
                    <i class="fa fa-caret-down ms-2"></i>
                </div>
            </div>
        </div>
        <style>
            .button-hover {
                padding: 0.5%;
                border-radius: 5px;
            }

            .button-hover:hover {
                background-color: rgba(255, 255, 255, .15);
            }

            .datepicker.datepicker-dropdown {
                z-index: 200000 !important;
            }
        </style>

        <div class="row mb-3" id="load_header">
        </div>
        
             {{-- pemanggilan print blade --}}
        @include('orderPending.print')
        {{-- end --}}

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3" style="height: auto;">
                        <!-- BEGIN input-group -->
                        <div class="input-group mb-2">
                            <div class="flex-fill position-relative">
                                <div class="input-group">

                                    <div style="width: 94%;margin-right:1%;">
                                        <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                            style="z-index: 1020;">
                                            <i class="fa fa-search opacity-5"></i>
                                        </div>
                                        <style>
                                            #search_purchaseOrder::-webkit-search-cancel-button {}
                                        </style>
                                        <input type="search" class="form-control ps-35px" id="search"
                                            placeholder="Search Order.." />
                                    </div>
                                    <div style="width: 5%;">
                                        <button type="button" id="btn_search" class="btn btn-theme">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style>
                            .thead-custom {
                                font-size: 11px;
                                background-color: darkslategray;
                            }

                            .tr-custom {
                                font-size: 11px;
                                border-left-width: 1px;
                                border-right-width: 1px;
                                border-bottom-width: 1px;
                                border-top-width: 1px;
                            }
                        </style>
                        <div class="mt-2 mb-2" id="search_var" style="display: none;">
                            <button id="clear_search" class="btn btn-sm btn-theme ms-1 me-1">Clear Search</button>
                            <span>Searching : <span id="query_search"></span></span>
                        </div>
                        {{-- tb awal --}}
                        <table class="table-sm mb-0 mt-2" style="width: 100%">
                            <thead class="thead-custom">
                                <tr class="text-white">
                                    <th class="text-center text-white" width="2%">NO
                                    </th>
                                    <th class="text-center text-white" width="30%">
                                        PRODUCT
                                    </th>
                                    <th class="text-center text-white" width="7%">ID PRODUCT
                                    </th>
                                    <th class="text-center text-white" width="3%">
                                        SIZE
                                    </th>
                                    <th class="text-center text-white" width="3%">
                                        QTY
                                    </th>
                                    <th class="text-center text-white" width="7%">PRICE
                                    </th>
                                    <th class="text-center text-white" width="7%">
                                        DISC ITEM
                                    </th>
                                    <th colspan="3" class="text-center text-white" width="25%">SUB
                                        TOTAL
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered" style="font-size: 11px;" id="load_tborder">
                            </tbody>
                        </table>
                        <br>
                        {{-- tb awal --}}
                        <center>
                            {{-- <button type="button" class="btn btn-sm btn-outline-theme" id="load_more">Load
                                More</button> --}}
                            <input type="hidden" id="validate" value="0">
                        </center>
                    </div>
                    <!-- Data Loader -->
                    {{-- <div class="auto-load text-center">
                        <div class="spinner-border"></div>
                    </div> --}}
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                </div>
            </div>
            <!-- END -->
        </div>

        <form class="was-validated" method="POST" action="/cancel_order_pending">
            <input type="hidden" name="_method" value="PATCH">
            @csrf
            <div class="modal fade" id="cancel_order" data-bs-backdrop="static" style="padding-top:5%;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-warning">DELETE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center text-warning" style="padding-bottom: 0px;font-weight: bold;">
                            <p>Delete Order?</p>
                        </div>
                        <input type="hidden" id="id_invoice" name="id_invoice">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-outline-warning" type="submit">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <form class="" method="POST" action="/refund_order_pending">
            @csrf
            <div class="modal fade" id="refund_order" data-bs-backdrop="static" style="padding-top:5%;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-success">REFUND PRODUCT <span id="s_idinvoice"></span></h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" style="font-weight: bold;" id="load_refund">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-outline-theme" type="submit">Refund</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form class="" method="POST" action="/retur_order_pending">
            @csrf
            <div class="modal fade" id="retur_order" data-bs-backdrop="static" style="padding-top:5%;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-success">RETUR PRODUCT <span id="s_idinvoice"></span></h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" style="font-weight: bold;" id="load_retur">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-outline-theme" type="submit">Retur</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Modal Payment --}}
        <form id="form_pay" method="POST" action="/payall_pending">
            @csrf
            <div class="modal fade" id="paymentModal" data-bs-backdrop="static" style="margin-top: 3%;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Payment <span id="pay_id_invoice"></span></h5>
                            <button type="button" class="btn btn-outline-theme btn-sm"
                                onclick="hide_payment_modal()">x</button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">Details</div>
                            <h5>RESELLER: <span id="s_reseller"></span></h5>
                            <div class="mb-2">Amount</div>
                            <center>
                                <h2><span id="s_grandtotal">0</span></h2>
                            </center>
                            <input type="hidden" value="" id="r_grandtotal" name="r_grandtotal">
                            <input type="hidden" value="" id="r_id_inovice" name="r_id_inovice">
                            <div class="mb-2 mt-4">Payment Method</div>

                            <div id="select_ammount">
                                <div class="row mb-3" align="center">
                                    <div class="col-3" align="left">
                                        <img src="{{ URL::asset('/assets/img/cash1.png') }}" width="55%">
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control" type="text" placeholder="Cash Amount"
                                            min="0" id="r_cash" name="r_cash" value=""
                                            type-currency="IDR">
                                    </div>
                                </div>

                                <div class="row mb-3" align="center">
                                    <div class="col-3" align="left">
                                        <img src="{{ URL::asset('/assets/img/bca1.png') }}" width="55%">
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control" type="text" placeholder="BCA Amount"
                                            id="r_bca" name="r_bca" value="" type-currency="IDR">
                                    </div>
                                </div>

                                <div class="row mb-3" align="center">
                                    <div class="col-3" align="left">
                                        <img src="{{ URL::asset('/assets/img/mandiri1.png') }}" width="55%">
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control" type="text" placeholder="MANDIRI Amount"
                                            id="r_mandiri" name="r_mandiri" value="" type-currency="IDR">
                                    </div>
                                </div>

                                <div class="row mb-3" align="center">
                                    <div class="col-3" align="left">
                                        <img src="{{ URL::asset('/assets/img/banktransfer.png') }}" width="55%">
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control" type="text" placeholder="TRANSFER Amount"
                                            id="r_banktf" name="r_banktf" value="" type-currency="IDR">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-theme" onclick="update_payment()">Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- Modal Payment --}}

        {{-- Modal Payment Per Product --}}
        <form id="form_pay_product" method="POST" action="/pay_pending">
            @csrf
            <div class="modal fade" id="paymentModalsatuan" data-bs-backdrop="static" style="margin-top: 3%;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Payment <span id="cpay_id_invoice"></span></h5>
                            <button type="button" class="btn btn-outline-theme btn-sm"
                                onclick="hide_payment_modal_satuan()">x</button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">Details</div>
                            <h6>RESELLER: <span id="cs_reseller"></span></h6>
                            <h6><span id="cs_produk"></span></h6>
                            <h6>Total Pesanan <span id="cs_ammount"></span> | Size: <span id="cs_size"></span> x <span
                                    id="cs_qty"></span> Pcs</h6>
                            <h6>Discount Item: <span id="sc_discitem"></span></h6>
                            <input type="hidden" id="batas_qty" name="batas_qty">
                            <input type="hidden" id="harga_satuan" name="harga_satuan">
                            <input type="hidden" id="rc_discitem" name="rc_discitem">
                            <hr>
                            <div class="mb-3">Jumlah QTY yang akan diBayar :</div>
                            <div class="d-flex mb-3 m-auto">
                                <button type="button" class="btn btn-outline-theme" onclick="change_qty('minus')"><i
                                        class="fa fa-minus"></i></button>
                                <input type="text"
                                    class="form-control w-100% fw-bold mx-2 border-1 border-theme text-center"
                                    id="mdl_qty" name="mdl_qty" readonly />
                                <button type="button" class="btn btn-outline-theme" onclick="change_qty('plus')"><i
                                        class="fa fa-plus"></i></button>
                            </div>

                            <script>
                                function change_qty(params) {
                                    var value = document.getElementById("mdl_qty").value;
                                    var batas = document.getElementById("batas_qty").value;
                                    var harga = document.getElementById("harga_satuan").value;
                                    let rupiah = Intl.NumberFormat('id-ID');

                                    if (params == 'minus') {
                                        if (value == 1) {} else {
                                            document.getElementById("mdl_qty").value = parseInt(value) - 1;
                                            qty = parseInt(value) - 1;

                                            document.getElementById("cs_grandtotal").innerHTML = "Rp " + rupiah.format(parseInt(qty) *
                                                parseInt(
                                                    harga));
                                            document.getElementById("rc_ammount").value = parseInt(qty) *
                                                parseInt(
                                                    harga);
                                        }
                                    } else if (params == 'plus') {
                                        if (batas == value) {
                                            alert('Tidak Boleh Melebihi Qty Pembelian!')
                                        } else {
                                            document.getElementById("mdl_qty").value = parseInt(value) + 1;
                                            qty = parseInt(value) + 1;

                                            document.getElementById("cs_grandtotal").innerHTML = "Rp " + rupiah.format(parseInt(qty) *
                                                parseInt(
                                                    harga));
                                            document.getElementById("rc_ammount").value = parseInt(qty) *
                                                parseInt(
                                                    harga);
                                        }
                                    }


                                }
                            </script>

                            <div class="mb-2">Jumlah Nominal yang harus diBayar :</div>
                            <center>
                                <h2><span id="cs_grandtotal">0</span></h2>
                                <input type="hidden" class="form_control" id="rc_ammount" name="rc_ammount"
                                    value="0">
                            </center>
                            <input type="hidden" id="cr_grandtotal" name="cr_grandtotal">
                            <input type="hidden" id="cr_id_inovice" name="cr_id_inovice">
                            <input type="hidden" id="cr_size" name="cr_size">
                            <input type="hidden" id="cr_id" name="cr_id">
                            <input type="hidden" id="cr_id_produk" name="cr_id_produk">
                            <input type="hidden" id="cr_totalqty" name="cr_totalqty">
                            <div class="mb-2 mt-4">Payment Method</div>

                            <div id="select_ammount">
                                <div class="row mb-3" align="center">
                                    <div class="col-3" align="left">
                                        <img src="{{ URL::asset('/assets/img/cash1.png') }}" width="55%">
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control" type="text" placeholder="Cash Amount"
                                            min="0" id="cr_cash" name="cr_cash" value=""
                                            type-currency="IDR">
                                    </div>
                                </div>

                                <div class="row mb-3" align="center">
                                    <div class="col-3" align="left">
                                        <img src="{{ URL::asset('/assets/img/bca1.png') }}" width="55%">
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control" type="text" placeholder="BCA Amount"
                                            id="cr_bca" name="cr_bca" value="" type-currency="IDR">
                                    </div>
                                </div>

                                <div class="row mb-3" align="center">
                                    <div class="col-3" align="left">
                                        <img src="{{ URL::asset('/assets/img/mandiri1.png') }}" width="55%">
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control" type="text" placeholder="MANDIRI Amount"
                                            id="cr_mandiri" name="cr_mandiri" value="" type-currency="IDR">
                                    </div>
                                </div>

                                <div class="row mb-3" align="center">
                                    <div class="col-3" align="left">
                                        <img src="{{ URL::asset('/assets/img/banktransfer.png') }}" width="55%">
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control" type="text" placeholder="TRANSFER Amount"
                                            id="cr_banktf" name="cr_banktf" value="" type-currency="IDR">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-theme" onclick="update_payment_satuan()">Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- Modal Payment Per Product --}}
        
         {{-- print modal --}}
        <script>
            function openmodalprint(id, id_invoice, id_reseller) {
                $('#modalprint').modal('show');
                document.getElementById('p_id').value = id;
                document.getElementById('p_id_invoice').value = id_invoice;
                document.getElementById('p_id_reseller').value = id_reseller;
                document.getElementById('p_id_reseller_label').innerHTML = id_reseller;
            }

            function submitformprint() {
                var id_invoice = document.getElementById('p_id_invoice').value;
                var id_reseller = document.getElementById('p_id_reseller').value;
                var validate = $('#type_print').find(":selected").val();
                document.getElementById('form_print').action = "../print_pending/" + id_invoice + "/" + id_reseller + "/" +
                    validate;
                document.getElementById("form_print").submit();
            }
        </script>
        {{-- end print modal --}}

        <script>
            function cancel_order(id_invoice) {
                document.getElementById('id_invoice').value = id_invoice;
                $('#cancel_order').modal('show');
            }

            function refund_order(id_invoice, count) {
                document.getElementById('s_idinvoice').innerHTML = id_invoice;

                $.ajax({
                    url: "/load_refund_pending",
                    type: "POST",
                    data: {
                        id_invoice: id_invoice,
                        count: count
                    },
                    beforeSend: function() {
                        $("#load_refund").html(`<div class="text-center w-100">
                            <div class="m-auto spinner-border"></div>
                        </div>`);
                    },
                    success: function(data) {
                        $("#load_refund").html(data);
                    }
                });

                $('#refund_order').modal('show');
            }

            function retur_order(id_invoice, count) {
                document.getElementById('s_idinvoice').innerHTML = id_invoice;

                $.ajax({
                    url: "/load_retur_pending",
                    type: "POST",
                    data: {
                        id_invoice: id_invoice,
                        count: count
                    },
                    beforeSend: function() {
                        $("#load_retur").html(`<div class="text-center w-100">
                            <div class="m-auto spinner-border"></div>
                        </div>`);
                    },
                    success: function(data) {
                        $("#load_retur").html(data);
                    }
                });

                $('#retur_order').modal('show');
            }

            function paid_order(id_invoice, grandtotal, reseller, grandtotal2) {
                document.getElementById("pay_id_invoice").innerHTML = id_invoice;
                document.getElementById("r_id_inovice").value = id_invoice;
                document.getElementById("s_grandtotal").innerHTML = grandtotal2;
                document.getElementById("r_grandtotal").value = grandtotal;
                document.getElementById("s_reseller").innerHTML = reseller;

                $('#paymentModal').modal('show');
            }

            function hide_payment_modal() {
                $('#paymentModal').modal('hide');
            }

            function update_payment() {
                var cash = document.getElementById("r_cash").value === '' ? 0 : document.getElementById("r_cash").value.replace(
                    /\D/g, '');
                var bca = document.getElementById("r_bca").value === '' ? 0 : document.getElementById("r_bca").value.replace(
                    /\D/g, '');
                var mandiri = document.getElementById("r_mandiri").value === '' ? 0 : document.getElementById("r_mandiri")
                    .value.replace(/\D/g, '');
                var banktf = document.getElementById("r_banktf").value === '' ? 0 : document.getElementById("r_banktf").value
                    .replace(/\D/g, '');

                var total_pay = parseInt(cash) + parseInt(bca) + parseInt(mandiri) + parseInt(banktf);

                var grandtotal = document.getElementById("r_grandtotal").value;

                if (total_pay != grandtotal) {
                    alert('Nominal tidak sesuai dengan Total Payment');
                } else {
                    document.getElementById("form_pay").submit();
                }
            }

            function paid_product(id_produk, totalqty, discitem, produk, size, qty, id, id_invoice, grandtotal, reseller,
                grandtotal2) {
                let rupiah = Intl.NumberFormat('id-ID');

                document.getElementById("cpay_id_invoice").innerHTML = id_invoice;
                document.getElementById("cr_id_inovice").value = id_invoice;
                document.getElementById("cr_totalqty").value = totalqty;
                document.getElementById("cr_id_produk").value = id_produk;
                document.getElementById("cr_id").value = id;
                document.getElementById("cr_size").value = size;
                document.getElementById("cr_grandtotal").value = grandtotal;
                document.getElementById("cs_reseller").innerHTML = reseller;

                document.getElementById("cs_produk").innerHTML = produk;
                document.getElementById("cs_size").innerHTML = size;
                document.getElementById("cs_qty").innerHTML = qty;
                document.getElementById("cs_ammount").innerHTML = grandtotal2;
                document.getElementById("batas_qty").value = qty;
                document.getElementById("mdl_qty").value = 1;

                document.getElementById("harga_satuan").value = parseInt(grandtotal) / parseInt(qty);
                document.getElementById("cs_grandtotal").innerHTML = "Rp " + rupiah.format(parseInt(grandtotal) / parseInt(
                    qty));
                document.getElementById("rc_ammount").value = parseInt(grandtotal) / parseInt(qty);
                document.getElementById("sc_discitem").innerHTML = "Rp " + rupiah.format(parseInt(discitem) / parseInt(qty));
                document.getElementById("rc_discitem").value = parseInt(discitem) / parseInt(qty);

                $('#paymentModalsatuan').modal('show');
            }

            function hide_payment_modal_satuan() {
                $('#paymentModalsatuan').modal('hide');
            }

            function update_payment_satuan() {
                var cash = document.getElementById("cr_cash").value === '' ? 0 : document.getElementById("cr_cash").value
                    .replace(
                        /\D/g, '');
                var bca = document.getElementById("cr_bca").value === '' ? 0 : document.getElementById("cr_bca").value.replace(
                    /\D/g, '');
                var mandiri = document.getElementById("cr_mandiri").value === '' ? 0 : document.getElementById("cr_mandiri")
                    .value.replace(/\D/g, '');
                var banktf = document.getElementById("cr_banktf").value === '' ? 0 : document.getElementById("cr_banktf").value
                    .replace(/\D/g, '');

                var total_pay = parseInt(cash) + parseInt(bca) + parseInt(mandiri) + parseInt(banktf);

                var grandtotal = document.getElementById("rc_ammount").value;

                if (total_pay != grandtotal) {
                    alert('Nominal tidak sesuai dengan Total Payment');
                } else {
                    document.getElementById("form_pay_product").submit();
                }
            }
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
                element.addEventListener('keyup', function(e) {
                    let cursorPostion = this.selectionStart;
                    let value = parseInt(this.value.replace(/[^,\d]/g, ''));
                    let originalLenght = this.value.length;
                    if (isNaN(value)) {
                        this.value = "";
                    } else {
                        this.value = value.toLocaleString('id-ID', {
                            currency: 'IDR',
                            style: 'currency',
                            minimumFractionDigits: 0
                        });
                        cursorPostion = this.value.length - originalLenght + cursorPostion;
                        this.setSelectionRange(cursorPostion, cursorPostion);
                    }
                });
            });
        </script>

        <script src="{{ URL::asset('assets/plugins/jquery/dist/jquery.js') }}"></script>
        <link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"
            rel="stylesheet" />
        <script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ URL::asset('assets/daterangepicker/moment.min.js') }}"></script>
        <script src="{{ URL::asset('assets/daterangepicker/daterangepicker.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/daterangepicker/daterangepicker.css') }}" />

        <script>
            var from = "";
            var to = "";
            var start = moment();
            var end = moment();
            var query_awal = $('#search').val();
            var id_awal = 0;

            $(document).ready(function() {
                function cb(start, end) {
                    var store = $('#store').find(":selected").val();
                    $('#reportrange span').html(start.format('DD MMMM YYYY') + ' - ' + end.format('DD MMMM YYYY'));
                    // load_tbsummary(query_awal, 1, id_awal, store, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
                    document.getElementById('validate').value = 0;
                    page = 1;
                    load_tborders(query_awal, 1, id_awal, store, start.format('YYYY-MM-DD'), end.format(
                        'YYYY-MM-DD'));
                    load_header(query_awal, store, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
                    from = start.format('YYYY-MM-DD');
                    to = end.format('YYYY-MM-DD');
                }

                $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')],
                        'This Years': [moment().startOf('year'), moment().endOf('year')],
                        'Last Years': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1,
                            'year').endOf('year')],
                    }
                }, cb);

                cb(start, end);
            });

            $("#store").change(function() {
                var stores = $(this).find(":selected").val();
                var query = $('#search').val();
                page = 1;
                document.getElementById('validate').value = 0;
                load_tborders(query, page, id_awal, stores, from, to);
                load_header(query, stores, from, to);
            });

            $("#btn_search").click(function() {
                var query = $('#search').val();
                if (query != '') {
                    document.getElementById('validate').value = 0;
                    page = 1;
                    val_last = '';
                    var store = $('#store').find(":selected").val();
                    load_tborders(query, page, id_awal, store, from, to);
                    load_header(query, store, from, to);
                    $("#search_var").css("display", "block");
                    $("#query_search").html(query);
                } else {
                    alert('Masukan Query Pencarian');
                }
            });

            $("#clear_search").click(function() {
                document.getElementById('validate').value = 0;
                page = 1;
                val_last = '';
                var store = $('#store').find(":selected").val();
                load_tborders('', page, id_awal, store, from, to);
                load_header('', store, from, to);
                $("#search_var").css("display", "none");
                $("#search").val('');
            });

            function load_header(querys, store, start, end) {
                $.ajax({
                    type: 'GET',
                    url: "/orderPending/load_header",
                    data: {
                        querys: querys,
                        store: store,
                        start: start,
                        end: end
                    },
                    beforeSend: function() {

                    },
                    success: function(data) {
                        $("#load_header").html(data);
                    }
                });
            }

            function load_tborders(querys, pages, start_data, store, start, end) {
                $("#load_tborder").html('');
                $.ajax({
                    type: 'GET',
                    url: "/load_tborders_pending",
                    data: {
                        querys: querys,
                        last_id: start_data,
                        pages: pages,
                        store: store,
                        start: start,
                        end: end
                    },
                    beforeSend: function() {
                        $("#load_tborder").html(
                            `<tr style="width:100%;">
                                <td colspan="8" align="center" style="padding: 30px 0px 20px 0px;">
                                    <div class="spinner-border"></div>
                                </td>
                            </tr>`);
                    },
                    success: function(data) {
                        $("#load_tborder").html(data);
                    }
                });
            }

            var page = 1;
            var val_last = '';

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
                    var validate = document.getElementById('validate').value;
                    if (validate == '0') {
                        document.getElementById('validate').value = 1;
                        index = parseInt(page) - 1;
                        page++;
                        var last_id = document.getElementsByName('last_id[]')[index].value;
                        val_last = last_id;
                        var query = $('#search').val();
                        if (val_last != 'last') {
                            var store = $('#store').find(":selected").val();
                            loadmore_tborders(query, page, last_id, store, from, to);
                        }
                    }
                }
            });

            function loadmore_tborders(querys, pages, start_data, store, start, end) {
                $.ajax({
                    type: 'GET',
                    url: "/load_tborders_pending",
                    data: {
                        querys: querys,
                        last_id: start_data,
                        pages: pages,
                        store: store,
                        start: start,
                        end: end
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        document.getElementById('validate').value = 0;
                        $("#load_tborder").append(data);
                    }
                });
            }
        </script>
    @endsection

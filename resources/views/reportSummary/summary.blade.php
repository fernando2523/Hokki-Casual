@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">REPORT PROFIT</a></li>
                    <li class="breadcrumb-item active">REPORT SUMMARY PAGE</li>
                </ul>

                <h1 class="page-header">
                    Report Summary
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

            .sticky-offset {
                top: 56px;
            }
        </style>

        <div class="row mb-3" id="load_header">
            <div class="col-12">
                <div class="row">
                    <div class="col-xl-4 mb-3">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="mb-1 text-default fw-bold text-center">NOTA</div>
                                    <h4 class="text-white fs-12px text-center">
                                        <div class="spinner-border"></div>
                                    </h4>
                                </div>
                            </div>
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                        </div>
                    </div>
                    <!-- END -->
                    <div class="col-xl-4 mb-3">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="mb-1 text-default fw-bold text-center">QTY</div>
                                    <h4 class="text-white fs-12px text-center">
                                        <div class="spinner-border"></div>
                                    </h4>
                                </div>
                            </div>
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 mb-3">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="text-default mb-1 fw-bold text-center">ONGKIR</div>
                                    <h4 class="text-default fs-12px text-center">
                                        <div class="spinner-border"></div>
                                    </h4>
                                </div>
                            </div>
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-xl-2 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="text-default mb-1 fw-bold text-center">GROSS SALE</div>
                                    <h4 class="text-white fs-12px text-center">
                                        <div class="spinner-border"></div>
                                    </h4>
                                </div>
                            </div>
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="text-default mb-1 fw-bold text-center">EXPENSES</div>
                                    <h4 class="text-red fs-12px text-center">
                                        <div class="spinner-border"></div>
                                    </h4>
                                </div>
                            </div>
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="text-default mb-1 fw-bold text-center">DISCOUNT</div>
                                    <h4 class="text-yellow fs-12px text-center">
                                        <div class="spinner-border"></div>
                                    </h4>
                                </div>
                            </div>
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="text-default mb-1 fw-bold text-center">NET SALES</div>
                                    <h4 class="text-info fs-12px text-center">
                                        <div class="spinner-border"></div>
                                    </h4>
                                </div>
                            </div>
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="text-default mb-1 fw-bold text-center">COSTS</div>
                                    <h4 class="text-indigo fs-12px text-center">
                                        <div class="spinner-border"></div>
                                    </h4>
                                </div>
                            </div>
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="text-default mb-1 fw-bold text-center">PROFIT </div>
                                    <h4 class="text-lime fs-12px text-center">
                                        <div class="spinner-border"></div>
                                    </h4>
                                </div>
                            </div>
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

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
                                    <th class="text-center text-white" width="7%">COST
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
                            <tbody class="table-bordered" style="font-size: 11px;" id="load_tbsummary">
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
                    load_tbsummary(query_awal, 1, id_awal, store, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
                    load_header(store, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
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
                load_tbsummary(query, 1, 0, stores, from, to);
                load_header(stores, from, to);
            });

            function load_header(store, start, end) {
                $.ajax({
                    type: 'GET',
                    url: "/reportsummary/load_header",
                    data: {
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

            $("#btn_search").click(function() {
                var query = $('#search').val();
                if (query != '') {
                    document.getElementById('validate').value = 0;
                    page = 1;
                    val_last = '';
                    var store = $('#store').find(":selected").val();
                    load_tbsummary(query, page, id_awal, store, from, to);
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
                load_tbsummary('', page, id_awal, store, from, to);
                $("#search_var").css("display", "none");
                $("#search").val('');
            });

            function load_tbsummary(querys, pages, start_data, store, start, end) {
                $("#load_tbsummary").html('');
                $.ajax({
                    type: 'GET',
                    url: "/load_tbsummary",
                    data: {
                        querys: querys,
                        last_id: start_data,
                        pages: pages,
                        store: store,
                        start: start,
                        end: end
                    },
                    beforeSend: function() {
                        $("#load_tbsummary").html(
                            `<tr style="width:100%;">
                                <td colspan="11" align="center" style="padding: 30px 0px 20px 0px;">
                                    <div class="spinner-border"></div>
                                </td>
                            </tr>`);
                    },
                    success: function(data) {
                        $("#load_tbsummary").html(data);
                    }
                });
            }

            var page = 1;
            var val_last = '';

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
                    var validate = document.getElementById('validate').value;
                    if (validate == '0' && val_last != 'last') {
                        document.getElementById('validate').value = 1;
                        index = parseInt(page) - 1;
                        page++;
                        var last_id = document.getElementsByName('last_id[]')[index].value;
                        val_last = last_id;
                        var query = $('#search').val();
                        if (val_last != 'last') {
                            var store = $('#store').find(":selected").val();
                            loadmore_tbsummary(query, page, last_id, store, from, to);
                        }
                    }
                }
            });

            function loadmore_tbsummary(querys, pages, start_data, store, start, end) {
                $.ajax({
                    type: 'GET',
                    url: "/load_tbsummary",
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
                        $("#load_tbsummary").append(data);
                    }
                });
            }
        </script>
    @endsection

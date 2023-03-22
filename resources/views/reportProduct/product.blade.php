@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">REPORT PROFIT</a></li>
                    <li class="breadcrumb-item active">REPORT PRODUCT PAGE</li>
                </ul>

                <h1 class="page-header">
                    Report Product
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

        <div id="load_report_product">
        </div>
    </div>
    <script src="{{ URL::asset('assets/plugins/jquery/dist/jquery.js') }}"></script>
    <link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet" />
    <script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var start = moment();
            var end = moment();
            var from = "";
            var to = "";

            function cb(start, end) {
                var store = $('#store').find(":selected").val();
                $('#reportrange span').html(start.format('DD MMMM YYYY') + ' - ' + end.format('DD MMMM YYYY'));
                load_data(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), store);
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

            $("#store").change(function() {
                var stores = $(this).find(":selected").val();
                // cb(start, end);
                load_data(from, to, stores);
            });

        });

        function load_data(start, end, store) {
            $.ajax({
                type: 'GET',
                url: "{{ URL::to('/load_report_product') }}",
                data: {
                    start: start,
                    end: end,
                    store: store
                },
                beforeSend() {
                    $("#load_report_product").html(`<div class="text-center w-100 align-middle">
                            <div class="m-auto spinner-border"></div>
                        </div>`);
                },
                success: function(data) {
                    $('#load_report_product').html(data);
                }
            });
        }
    </script>
    <script src="{{ URL::asset('assets/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/daterangepicker/daterangepicker.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/daterangepicker/daterangepicker.css') }}" />
@endsection

@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/location/locations">ASSETS</a></li>
                <li class="breadcrumb-item active">ASSETS PAGE</li>
            </ul>

            <div class="row">
                <div class="col-6">
                    <h1 class="page-header">
                        Assets (FIFO METHOD)
                    </h1>
                </div>
                <div align="right" class="col-6">
                    <div class="mb-4">
                        @if (Auth::user()->role === 'SUPER-ADMIN')
                            <select class="form-select form-select-sm text-theme fw-bold" id="select_ware"
                                onchange="select()" style="width: 250px;">
                                <option value="all_ware" selected>ALL WAREHOUSE..</option>
                                @foreach ($selectWarehouse as $select)
                                    <option value="{{ $select->id_ware }}">{{ $select->warehouse }}</option>
                                @endforeach
                            </select>
                        @else
                            <select class="form-select form-select-sm text-theme fw-bold" id="select_ware"
                                onchange="select()" style="width: 250px;">
                                @foreach ($userware as $users)
                                    @foreach ($selectWarehouse as $select)
                                        @if ($select->id_ware === $users->id_ware)
                                            <option value="{{ $select->id_ware }}" selected>{{ $select->warehouse }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="ms-auto">
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

            .thead-custom {
                font-size: 11px;
                background-color: darkslategray;
            }

            .tr-custom {
                border-left-width: 1px;
                border-right-width: 1px;
                border-bottom-width: 1px;
            }
        </style>

        <div class="row mb-3" id="load_header">
        </div>

        <div id="load_tb_assets"></div>

        @include('asset.detail')

        <script>
            var id_ware = $('#select_ware').val();

            $(document).ready(function() {
                load_header(id_ware);
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_tb_assets') }}",
                    data: {
                        id_ware: id_ware,
                    },
                    success: function(data) {
                        $("#load_tb_assets").html(data);
                    }
                });
            });

            function select() {
                var id_ware = $('#select_ware').val();
                load_header(id_ware);

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_tb_assets') }}",
                    data: {
                        id_ware: id_ware,
                    },
                    success: function(data) {
                        $("#load_tb_assets").html(data);
                    }
                });
            }

            function load_header(id_ware) {
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_header_assets') }}",
                    data: {
                        id_ware: id_ware,
                    },
                    success: function(data) {
                        $("#load_header").html(data);
                    }
                });
            }

            function openmodaldetail(id_produk) {
                $('#modaldetail').modal('show');

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_detail_asset') }}",
                    data: {
                        id_produk: id_produk,
                    },
                    success: function(data) {
                        $("#load_detail_asset").html(data);
                    }
                });
            }
        </script>
    @endsection

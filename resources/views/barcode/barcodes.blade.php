@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">MANAGEMENT STOCK</a></li>
                    <li class="breadcrumb-item active">BARCODE PAGE</li>
                </ul>

                <h1 class="page-header">
                    Barcode
                </h1>
            </div>
            <div class="ms-auto">
                <div class="mt-3">
                    @if (Auth::user()->role === 'SUPER-ADMIN')
                        <select class="form-select form-select-sm text-theme fw-bold" id="select_ware" onchange="select()"
                            style="width: 300px;">
                            <option value="all_ware" selected>ALL WAREHOUSE..</option>
                            @foreach ($selectWarehouse as $select)
                                <option value="{{ $select->id_ware }}">{{ $select->warehouse }}</option>
                            @endforeach
                        </select>
                    @elseif (Auth::user()->role === 'HEAD-AREA')
                        <select class="form-select form-select-sm text-theme fw-bold" id="select_ware" onchange="select()"
                            style="width: 300px;">
                            <option value="per_area" selected>Warehouse Area {{ $userware[0]->area }}..</option>
                            @foreach ($userware as $users)
                                @foreach ($selectWarehouse as $select)
                                    @if ($select->id_area === $users->id_area)
                                        <option value="{{ $select->id_ware }}">{{ $select->warehouse }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    @else
                        <select class="form-select form-select-sm text-theme fw-bold" id="select_ware" onchange="select()"
                            style="width: 300px;">
                            @foreach ($userware as $users)
                                @foreach ($selectWarehouse as $select)
                                    @if ($select->id_ware === $users->id_ware)
                                        <option value="{{ $select->id_ware }}" selected>{{ $select->warehouse }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    @endif
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


        <div class="row" id="load_barcode">
        </div>

        <script>
            function select() {
                var select = document.getElementById('select_ware');
                var selected_ware = select.options[select.selectedIndex].value;
                load_ware(selected_ware);
            }

            $(document).ready(function() {
                var select = document.getElementById('select_ware');
                var selected_ware = select.options[select.selectedIndex].value;
                load_ware(selected_ware);
            });

            function load_ware(id_ware) {
                $.ajax({
                    type: 'GET',
                    url: "{{ URL::to('/load_barcode') }}",
                    data: {
                        id_ware: id_ware,
                    },
                    success: function(data) {
                        $("#load_barcode").html(data);
                    }
                });
            }
        </script>
    @endsection

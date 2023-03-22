@extends('layouts.main')
@section('container')
    @include('displays.add_display')
    @include('displays.remove_display')
    <div id="content" class="app-content">
        <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/location/locations">PRODUCT</a></li>
                <li class="breadcrumb-item active">DISPLAY</li>
            </ul>

            <div class="row mb-3">
                <div class="col-6">
                    <h1 class="page-header">
                        Display Product
                    </h1>
                </div>
                <div align="right" class="col-6" style="display: flex;align-items: center;justify-content: right;">
                    @if (Auth::user()->role === 'SUPER-ADMIN' or
                        Auth::user()->role === 'HEAD-AREA' or
                        Auth::user()->role === 'HEAD-STORE')
                        <div class="me-3"> <button type="button" class="btn btn-lime btn-sm fw-bold"
                                onclick="print_so()"><i class="fas fa-lg fa-fw me-2 fa-print"></i>Print
                                SO Displays</button></div>
                    @endif
                    <div>
                        @if (Auth::user()->role === 'SUPER-ADMIN')
                            <select class="form-select form-select-sm text-theme fw-bold" id="select_store"
                                style="width: 250px;">
                                @foreach ($selectStore as $select)
                                    <option data-toko="{{ $select->store }}" data-store="{{ $select->id_store }}"
                                        value="{{ $select->id_ware }}">
                                        {{ $select->store }}</option>
                                @endforeach
                            </select>
                        @else
                            <select class="form-select form-select-sm text-theme fw-bold" id="select_store"
                                style="width: 250px;">
                                @foreach ($userware as $users)
                                    @foreach ($selectStore as $select)
                                        @if ($select->id_store === $users->id_store)
                                            <option data-toko="{{ $select->store }}" data-store="{{ $select->id_store }}"
                                                value="{{ $select->id_ware }}" selected>{{ $select->store }}
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

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body p-3" style="height: auto;">
                    <div>
                        <style>
                            .button-hover {
                                padding: 0.5%;
                                border-radius: 5px;
                            }

                            .button-hover:hover {
                                background-color: rgba(255, 255, 255, .15);
                            }

                            .datepicker.datepicker-dropdown {
                                z-index: 1000000 !important;
                            }
                        </style>
                        <div class="input-group mb-4">
                            <div class="flex-fill position-relative">
                                <div class="input-group">
                                    <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                        style="z-index: 1020;">
                                        <i class="fa fa-search opacity-5"></i>
                                    </div>
                                    <input type="text" class="form-control ps-35px" id="search_product"
                                        placeholder="Search products.." />
                                </div>
                            </div>
                        </div>
                        <div id="detail_product">
                        </div>
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

        <script>
            $(document).ready(function() {
                var select = document.getElementById('select_store');
                var store = $('#select_store').find(':selected').data("store");
                var id_ware = select.options[select.selectedIndex].value;
                load_display(store, id_ware);
            });

            function load_display(store, id_ware) {
                $.ajax({
                    type: 'GET',
                    url: "{{ URL::to('/load_displays') }}",
                    data: {
                        store: store,
                        id_ware: id_ware,
                    },
                    success: function(data) {
                        $("#detail_product").html(data);
                    }
                });
            }

            $("#select_store").change(function() {
                var store = $(this).find(':selected').data("store");
                var id_ware = $(this).val();
                load_display(store, id_ware);
            });

            function modal_display(id_produk, id_area, id_ware, id_store, brand, produk, users) {
                $('#id_produk').val(id_produk);
                $('#id_area').val(id_area);
                $('#id_store').val(id_store);
                $('#brand').val(brand);
                $('#produk').val(produk);
                $('#users').val(users);
                $('#size').val('');

                $('#add_display').modal('show');
            }

            function remove_display(id) {
                $('#id_display').val(id);

                $('#remove_display').modal('show');
            }

            function print_so() {
                var store = $('#select_store').find(':selected').data("toko");
                window.open("/print_so?store=" + store);
            }
        </script>

    @endsection

@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">PRODUCTS</a></li>
                    <li class="breadcrumb-item active">PRODUCTS PAGE</li>
                </ul>

                <h1 class="page-header">
                    Products
                </h1>
            </div>
            <div class="ms-auto">
            </div>

            <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-lime" data-bs-toggle="modal"
                    data-bs-target="#modalso"><i class="bi bi-arrow-clockwise fa-fw me-1"></i> Stock Opname</a>
            </div>
            {{-- <div class="ms-sm-3 mt-sm-0"><a class="btn btn-outline-theme" data-bs-toggle="modal"
                    data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Product</a>
            </div> --}}
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

        <div class="modal fade" id="modalso" data-bs-backdrop="static" style="padding-top:8%;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">PRINT STOCK OPNAME <i class="fa-xl bi bi-upc-scan ms-1"></i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" action="{{ url('/print_stockopname') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="row form-group mt-3">
                                <div class="col-12 form-group position-relative mb-3">
                                    @if (Auth::user()->role === 'SUPER-ADMIN')
                                        <select class="form-select form-select-sm text-theme fw-bold" name="ware_so"
                                            required>
                                            <option value="" disabled selected>Pilih Warehouse..</option>
                                            @foreach ($selectWarehouse as $select)
                                                <option value="{{ $select->id_ware }}">{{ $select->warehouse }}</option>
                                            @endforeach
                                        </select>
                                    @elseif (Auth::user()->role === 'HEAD-AREA')
                                        <select class="form-select form-select-sm text-theme fw-bold" name="ware_so"
                                            required>
                                            <option value="" disabled selected>Pilih Warehouse..</option>
                                            @foreach ($userware as $users)
                                                @foreach ($selectWarehouse as $select)
                                                    @if ($select->id_area === $users->id_area)
                                                        <option value="{{ $select->id_ware }}">{{ $select->warehouse }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>
                                    @else
                                        <select class="form-select form-select-sm text-theme fw-bold" name="ware_so"
                                            required>
                                            <option value="" disabled selected>Pilih Warehouse..</option>
                                            @foreach ($userware as $users)
                                                @foreach ($selectWarehouse as $select)
                                                    @if ($select->id_ware === $users->id_ware)
                                                        <option value="{{ $select->id_ware }}" selected>
                                                            {{ $select->warehouse }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="invalid-tooltip">
                                        Mohon pilih warehouse yang akan di stock opname.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3" align="right" style="padding-top: 20px;">
                                <button class="btn btn-theme" type="submit">PRINT <i
                                        class="fa-xl bi bi-upc-scan ms-1"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $('#file').change(function() {

                if (file === "") {
                    document.getElementById("previewimg").src = '/product/defaultimg.png';
                } else {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#previewimg').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }

            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {

                function variation(variasi) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ URL::to('/load_variation') }}",
                        data: {
                            variasi: variasi
                        },
                        success: function(data) {
                            $("#hasil_variation").html(data);
                        }
                    });
                }

                $('#type_variasi').change(function() {
                    var variasi = $(this).val();
                    variation(variasi);
                });
            });
        </script>


        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        <form id="form_so" class="was-validated" enctype="multipart/form-data" method="POST" action="/input_so">
            <input type="hidden" name="_method" value="PATCH">
            @csrf
            <div class="modal fade" id="modalstockopname" data-bs-backdrop="static" style="padding-top: 5%;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-white">EDIT STOCK OPNAME</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <input type="hidden" id="so_id" name="so_id">
                        <input type="hidden" id="so_id_produk" name="so_id_produk">
                        <input type="hidden" id="so_id_ware" name="so_id_ware">

                        <div class="modal-body" id="tbody_item">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- <script>
            // CSRF for all ajax call
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script> --}}



        @include('product.delete')
        @include('product.edit')

        <div class="row">
            <!-- DATA ASSSET -->
            @if (Auth::user()->role === 'SUPER-ADMIN')
                <div class="col-xl-3 mb-3">
                    <div class="card" style="margin-bottom: 15px;">
                        <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                            <div class="flex-fill" style="padding-top: 5px;padding-bottom: 3px;">
                                <div class="col-6 text-theme fw-bold">ARTIKEL</div>
                                <h4>{{ $get_totalproduk }}</h4>
                            </div>

                            <div class="opacity-5">
                                <i class="bi bi-box-seam fa-3x"></i>
                            </div>
                        </div>

                        <!-- card-arrow -->
                        <div class="card-arrow">
                            <div class="card-arrow-top-left"></div>
                            <div class="card-arrow-top-right"></div>
                            <div class="card-arrow-bottom-left"></div>
                            <div class="card-arrow-bottom-right"></div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                            <div class="flex-fill" style="padding-top: 5px;padding-bottom: 3px;">
                                <div class="col-6 text-theme fw-bold">QTY</div>
                                <h4>{{ $get_totalqty }}</h4>
                            </div>

                            <div class="opacity-5">
                                <i class="bi bi-boxes fa-3x"></i>
                            </div>
                        </div>

                        <!-- card-arrow -->
                        <div class="card-arrow">
                            <div class="card-arrow-top-left"></div>
                            <div class="card-arrow-top-right"></div>
                            <div class="card-arrow-bottom-left"></div>
                            <div class="card-arrow-bottom-right"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 mb-3">
                    <div class="card">
                        <div class="card-body p-3" style="height: 225px;">
                            <div class="row" align="center">
                                @foreach ($getsproduct as $key => $utama)
                                    @foreach ($getnamewarehouse as $wares)
                                        @if ($utama->id_ware === $wares->id_ware)
                                            @foreach ($get_perware as $keys => $kedua)
                                                @if ($utama->id_ware === $kedua->id_ware)
                                                    <div class="col-4 mb-3">
                                                        <div class="card">
                                                            <div class="card-body p-3 bg-white bg-opacity-10">
                                                                <div class="d-flex fw-bold small mb-2">
                                                                    <span
                                                                        class="flex-grow-1 text-theme">{{ $wares->warehouse }}</span>
                                                                </div>
                                                                <div class="row align-items-center">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <h6 class="mb-0">
                                                                                {{ $kedua->countidproduk }}
                                                                            </h6>
                                                                            <h6 class="mb-0 fs-10px">ARTIKEL
                                                                            </h6>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <h6 class="mb-0">{{ $kedua->totalQty }}</h6>
                                                                            <h6 class="mb-0 fs-10px">QTY</h6>
                                                                        </div>
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
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach
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
            @endif

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3" style="height: auto;">
                        <!-- BEGIN input-group -->
                        <div class="d-flex fw-bold small mb-3">
                            <div class="col-9" style="margin-top: 7px;">
                                <span class="flex-grow-1">SEARCH PRODUCTS</span>
                            </div>
                            <div class="col-3" align="right">
                                @if (Auth::user()->role === 'SUPER-ADMIN')
                                    <select class="form-select form-select-sm text-theme fw-bold" id="select_ware"
                                        onchange="select()" style="width: 300px;">
                                        <option value="all_ware" selected>ALL WAREHOUSE..</option>
                                        @foreach ($selectWarehouse as $select)
                                            <option value="{{ $select->id_ware }}">{{ $select->warehouse }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-select form-select-sm text-theme fw-bold" id="select_ware"
                                        onchange="select()" style="width: 300px;">
                                        <option value="per_area" selected>Warehouse Area {{ $userware[0]->area }}..
                                        </option>
                                        @foreach ($userware as $users)
                                            @foreach ($selectWarehouse as $select)
                                                @if ($select->id_area === $users->id_area)
                                                    <option value="{{ $select->id_ware }}">{{ $select->warehouse }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div id="detail_product">
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
                    url: "{{ URL::to('/detail_product') }}",
                    data: {
                        id_ware: id_ware,
                    },
                    success: function(data) {
                        $("#detail_product").html(data);
                    }
                });
            }

            function openmodalso(id, id_produk, id_ware) {
                $('#modalstockopname').modal('show');
                document.getElementById('so_id').value = id;
                document.getElementById('so_id_produk').value = id_produk;
                document.getElementById('so_id_ware').value = id_ware;

                $.ajax({
                    type: 'GET',
                    url: "{{ URL::to('/so_oldqty') }}",
                    data: {
                        id: id,
                        id_produk: id_produk,
                        id_ware: id_ware
                    },
                    beforeSend: function() {
                        $("#tbody_item").html(
                            '<center><div align="center"><div class="spinner-border"></div></center>'
                        );
                    },
                    success: function(data) {
                        get_modal(id_produk);
                        $("#tbody_item").html(data);
                    }
                });
            }

            function get_modal(id_produk) {
                $.ajax({
                    type: 'GET',
                    url: "{{ URL::to('/get_modal') }}",
                    data: {
                        id_produk: id_produk,
                    },
                    success: function(data) {
                        $("#so_modal").html(data);
                    }
                });
            }
        </script>
    @endsection

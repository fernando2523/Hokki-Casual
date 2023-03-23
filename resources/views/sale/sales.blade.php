@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/sale/sales">SALES</a></li>
                    <li class="breadcrumb-item active">SALES PAGE</li>
                </ul>

                <h1 class="page-header">
                    Sales
                </h1>
            </div>

            <div class="ms-auto">
            </div>
            <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-yellow" data-bs-toggle="modal"
                    data-bs-target="#modaldatatersedia"><i class="fa fa-plus-circle fa-fw me-1"></i> PILIH YANG SUDAH
                    ADA</a></div>
            <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-theme" data-bs-toggle="modal"
                    data-bs-target="#modaldatabaru"><i class="fa fa-plus-circle fa-fw me-1"></i> Tambah Order</a></div>
        </div>

        <script>
            function print_sales() {
                window.open("/print_sales");
            }
        </script>

        <div class="modal fade" id="modaldatabaru" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">Tambah Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formadd" class="was-validated" method="POST" enctype="multipart/form-data"
                        action="{{ url('/product/products/store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-12">
                                    <div class="row form-group">
                                        <div class="col-8 form-group mb-3">
                                            <label class="form-label">Nama Produk</label>
                                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                                name="produk" required placeholder="Silahkan masukan nama produk"
                                                autocomplete="OFF">
                                        </div>
                                        <div class="col-2 form-group mb-3">
                                            <label class="form-label">Size</label>
                                            <select class="form-select form-select-sm text-theme" name="size" required>
                                                <option value="" disabled selected>Size</option>
                                                <option value="35">35</option>
                                                <option value="36">36</option>
                                                <option value="37">37</option>
                                                <option value="38">38</option>
                                                <option value="39">39</option>
                                                <option value="40">40</option>
                                                <option value="41">41</option>
                                                <option value="42">42</option>
                                                <option value="43">43</option>
                                                <option value="44">44</option>
                                                <option value="45">45</option>
                                            </select>
                                        </div>

                                        <div class="col-2 form-group mb-3">
                                            <label class="form-label">Qty</label>
                                            <input class="form-control form-control-sm text-theme is-invalid" type="number"
                                                name="qty" required placeholder="0" autocomplete="OFF">
                                        </div>

                                        <div class="col-4 form-group position-relative mb-3">
                                            <label class="form-label">Supplier</label>
                                            <div class="position-relative text-center">
                                                <select class="form-select form-select-sm text-theme text-center"
                                                    name="id_sup">
                                                    <option value="" disabled selected>Pilih Supplier</option>
                                                    @foreach ($getsupplier as $gets)
                                                        <option value="{{ $gets->id_sup }}">{{ $gets->supplier }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-tooltip">
                                                    Silahkan pilih kualitas yang sesuai.
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-4 form-group mb-3">
                                            <label class="form-label">Harga Beli <small class="text-warning">(Dari
                                                    Toko)</small></label>
                                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                                name="m_price" required placeholder="0" autocomplete="OFF"
                                                type-currency="IDR">
                                        </div>
                                        <div class="col-4 form-group mb-3">
                                            <label class="form-label">Harga Jual <small
                                                    class="text-warning">(Marketplace)</small></label>
                                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                                name="j_price" required placeholder="0" autocomplete="OFF"
                                                type-currency="IDR">
                                        </div>

                                        <div class="col-3 form-group position-relative mb-3">
                                            <label class="form-label">Brand</label>
                                            <select class="form-select form-select-sm text-theme" name="id_brand" required>
                                                <option value="" disabled selected>Pilih Brand</option>
                                                @foreach ($getbrand as $gets)
                                                    <option value="{{ $gets->id_brand }}">{{ $gets->brand }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih nama brand yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-3 form-group position-relative mb-3">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-select form-select-sm text-theme" name="category"
                                                required>
                                                <option value="" disabled selected>Pilih Kategori</option>
                                                @foreach ($getcategory as $gets)
                                                    <option value="{{ $gets->sub_category }}">{{ $gets->sub_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih category yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-3 form-group position-relative mb-3">
                                            <label class="form-label">Kualitas</label>
                                            <select class="form-select form-select-sm text-theme" name="quality" required>
                                                <option value="" disabled selected>Pilih Kualitas</option>
                                                {{-- <option value="LOKAL">LOKAL</option> --}}
                                                <option value="IMPORT">IMPORT</option>
                                                <option value="ORIGINAL">ORIGINAL</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih kualitas yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-3 form-group position-relative mb-3">
                                            <label class="form-label">Warehouse</label>
                                            @if (Auth::user()->role === 'SUPER-ADMIN')
                                                <select class="form-select form-select-sm text-theme" name="id_ware"
                                                    required>
                                                    <option value="" disabled selected>Pilih Warehouse</option>
                                                    @foreach ($getware as $gets)
                                                        <option value="{{ $gets->id_ware }}">{{ $gets->warehouse }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @elseif (Auth::user()->role === 'HEAD-AREA')
                                                <select class="form-select form-select-sm text-theme" name="id_ware"
                                                    required>
                                                    <option value="" disabled selected>Pilih Warehouse</option>
                                                    @foreach ($userware as $users)
                                                        @foreach ($getware as $gets)
                                                            @if ($gets->id_area === $users->id_area)
                                                                <option value="{{ $gets->id_ware }}">
                                                                    {{ $gets->warehouse }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            @else
                                                <select class="form-select form-select-sm text-theme" name="id_ware"
                                                    required>
                                                    @foreach ($userware as $users)
                                                        @foreach ($getware as $gets)
                                                            @if ($gets->id_ware === $users->id_ware)
                                                                <option value="{{ $gets->id_ware }}" selected>
                                                                    {{ $gets->warehouse }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            @endif
                                            <div class="invalid-tooltip">
                                                Silahkan pilih warehouse yang sesuai.
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3" align="right">
                                <button class="btn btn-theme" type="button" onclick="submitadd()">Save</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modaldatatersedia" data-bs-backdrop="static" style="padding-top:12%;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">Pilih Order Yang Sudah Ada</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" enctype="multipart/form-data"
                        action="{{ url('/reseller/resellers/store') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="row form-group">

                            </div>
                            <div class="form-group mt-3" align="right">
                                <button class="btn btn-theme" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <form id="form_pay" action="/savesales" method="POST">
            @csrf
            <div class="row">
                <!-- DATA ASSSET -->
                <div class="col-xl-5">
                    <div class="row mb-3">
                        <div class="col-6">
                            <select class="form-select fw-bold  form-select-sm text-theme" id="select_store"
                                name="store" required>
                                <option value="" disabled selected>Pilih Store..</option>
                                @foreach ($getstore as $stores)
                                    <option data-upprice="{{ $stores->detailsarea[0]['up_price'] }}"
                                        data-area="{{ $stores->id_area }}" data-id_store="{{ $stores->id_store }}"
                                        value="{{ $stores->store }}">{{ $stores->store }} </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="r_area" id="r_area">
                            <input type="hidden" name="r_id_store" id="r_id_store">
                            <input type="hidden" name="up_price" id="up_price">
                        </div>

                        <div class="col-6">
                            <select class="form-select  fw-bold  form-select-sm text-theme" id="cashier" name="cashier"
                                required>
                                <option value="" disabled selected>Pilih Kasir..</option>
                                @foreach ($getkasir as $kasir)
                                    <option value="{{ $kasir->name }}">{{ $kasir->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- List Product --}}
                    <div class="card">
                        <div class="card-body p-3" id="card-catalog" style="height: 550px;">
                            <!-- BEGIN input-group -->
                            <div class="input-group mb-4 row">
                                <div class="col-4 text-center" style="padding-top: 5px;">
                                    <span class="flex-grow-1 fw-bold ">FIND PRODUCT</span>
                                </div>
                                <div class="col-8">
                                    <div class="input-group">
                                        <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                            style="z-index: 1020;">
                                            <i class="fa fa-search opacity-5"></i>
                                        </div>
                                        <input type="search"
                                            class="form-control text-theme fw-bold form-control-sm ps-35px"
                                            id="search_product" placeholder="Search products.." disabled />
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <style>
                                /* Hide scrollbar for Chrome, Safari and Opera */
                                .scroll-hide::-webkit-scrollbar {
                                    display: none;
                                }

                                /* Hide scrollbar for IE, Edge and Firefox */
                                .scroll-hide {
                                    -ms-overflow-style: none;
                                    /* IE and Edge */
                                    scrollbar-width: none;
                                    /* Firefox */
                                }
                            </style>
                            <div id="loading_catalog" class="row"
                                style="position: absolute;background-color:rgb(65, 69, 72);margin:15px;top:13%;left:0;right:0;bottom:0;display:none;z-index:100000;">
                                <div align="center" class="align-items-center m-auto">
                                    <span class="spinner-border" style="width: 20px;height:20px;margin-right:5px;"></span>
                                    <span>Loading... </span>
                                </div>
                            </div>
                            {{-- Load Product --}}
                            <div class="row scroll-hide load_data" id="product_catalog"
                                style="overflow-y: scroll;height: 83%;padding-bottom:40%;">
                                <div align="center" id="opening" style="margin: auto;">
                                    Silahkan Pilih Store
                                </div>
                            </div>
                            <input type="hidden" id="validate" value="0">
                            {{-- Load Product --}}
                        </div>
                        <div class="card-arrow">
                            <div class="card-arrow-top-left"></div>
                            <div class="card-arrow-top-right"></div>
                            <div class="card-arrow-bottom-left"></div>
                            <div class="card-arrow-bottom-right"></div>
                        </div>
                    </div>
                    {{-- End List Product --}}

                    {{-- Script Ajax Load Product --}}

                    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js') }}"></script>
                    <script type="text/javascript">
                        var heigh = $('#product_catalog').height();
                        var area = '';
                        var search_awal = '';

                        $("#select_store").change(function() {
                            clear_cart();
                            $("#opening").css("display", "none");

                            var area = $(this).find(':selected').data("area");
                            var id_store = $(this).find(':selected').data("id_store");
                            var upprice = $(this).find(':selected').data("upprice");

                            document.getElementById('validate').value = 0;
                            val_last = '';
                            area = area;
                            page = 1;
                            id_store = id_store;

                            $('#r_area').val(area);
                            $('#r_id_store').val(id_store);
                            $('#up_price').val(upprice);

                            loadData(page, area, search_awal);

                            $("#search_product").prop("disabled", false);
                            $("#search_product").addClass("border-theme");

                            $("#search_barcode").prop("disabled", false);
                            $("#search_barcode").addClass("border-theme");
                        });


                        $('#search_product').change(function(e) {
                            var search_data = document.getElementById('search_product').value;
                            var area = $('#r_area').val();
                            document.getElementById('validate').value = 0;
                            val_last = '';
                            page = 1;
                            loadData(page, area, search_data);
                        });

                        var page = 1;
                        var val_last = '';

                        $('#product_catalog').scroll(function() {
                            var clientHeight = $('#product_catalog').prop('clientHeight') + 2;
                            var scminst = $('#product_catalog').prop('scrollHeight') - $('#product_catalog').scrollTop();

                            if (scminst <= clientHeight) {
                                var validate = document.getElementById('validate').value;
                                if (validate == '0' && val_last != 'last') {
                                    document.getElementById('validate').value = 1;
                                    index = parseInt(page) - 1;
                                    page++;
                                    var last_id = document.getElementsByName('last_id[]')[index].value;
                                    val_last = last_id;
                                    var query = $('#search').val();
                                    if (val_last != 'last') {
                                        var search_data = document.getElementById('search_product').value;
                                        var area = $('#r_area').val();
                                        loadMoreData(page, area, search_data);
                                    }
                                }
                            }

                        });

                        function loadData(page, area, querys) {
                            $.ajax({
                                    url: "/tablesale?page=" + page,
                                    type: "GET",
                                    data: {
                                        area: area,
                                        querys: querys
                                    },
                                    beforeSend: function() {
                                        $("#loading_catalog").css("display", "flex");
                                    }
                                })
                                .done(function(response) {
                                    $("#loading_catalog").css("display", "none");
                                    $(".load_data").html(response);
                                })
                                .fail(function(jqXHR, ajaxOptions, thrownError) {
                                    console.log('Server error occured');
                                });
                        }

                        function loadMoreData(page, area, querys) {
                            $.ajax({
                                    url: "/tablesale?page=" + page,
                                    type: "GET",
                                    data: {
                                        area: area,
                                        querys: querys
                                    },
                                    beforeSend: function() {}
                                })
                                .done(function(response) {
                                    document.getElementById('validate').value = 0;
                                    $(".load_data").append(response);
                                })
                                .fail(function(jqXHR, ajaxOptions, thrownError) {
                                    console.log('Server error occured');
                                });
                        }
                    </script>
                    {{-- End Script Ajax Load Product --}}


                </div>
                <!-- END -->
                <div class="col-xl-7">

                    <div class="row mb-3">
                        <div class="col-7">
                            <select class="form-select fw-bold  form-select-sm text-theme" id="customer" name="customer"
                                required>
                                <option value="" disabled selected>Customer..</option>
                                <option value="RETAIL">RETAIL</option>
                                <option value="RESELLER">RESELLER</option>
                                <option value="GROSIR">GROSIR</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select class="form-select fw-bold form-select-sm text-theme" id="reseller_name"
                                name="reseller_name" disabled>
                                <option value="" disabled selected>Name Marketplace..</option>
                                @foreach ($getreseller as $reseller)
                                    <option value="{{ $reseller->nama }}">{{ $reseller->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <?php
                            $datenow = Carbon\Carbon::now()->format('Y-m-d');
                            ?>
                            <input class="form-control  fw-bold  form-control-sm text-lime text-center" type="text"
                                name="r_tanggal" value="no pesanan" readonly>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-3 bg-dark bg-opacity-50" style="height: 370px;">

                            <div class="input-group mb-4 row">
                                <div class="col-4 text-center" style="padding-top: 5px;">
                                    <span class="flex-grow-1 fw-bold "><i class="fa fa-search opacity-5"></i> CURRENT SALE
                                        <span id="counter_span">(0)</span></span>
                                    <input type="hidden" id="count" name="count" value="0">
                                </div>
                                <div class="col-8">
                                    <div class="input-group">
                                        <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                            style="z-index: 1020;">
                                            <i class="fa fa-search opacity-5"></i>
                                        </div>
                                        <input type="text"
                                            class="form-control text-theme fw-bold form-control-sm ps-35px"
                                            id="search_barcode" placeholder="Search barcode.." disabled />
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <style>
                                thead,
                                tbody {
                                    display: block;
                                }

                                tbody {
                                    height: 67%;
                                    /* Just for the demo          */
                                    overflow-y: auto;
                                    /* Trigger vertical scroll    */
                                    overflow-x: hidden;
                                    /* Hide the horizontal scroll */
                                }
                            </style>
                            <table id="table" class="table table-striped "
                                style="margin-top: -12px;width: 100% !important;height: 100%;">
                                <thead style="font-size: 11px;width: 100% !important;">
                                    <tr>
                                        <th class="text-left" width="58.5%" style="color: #a8b6bc !important;">PRODUCT
                                        </th>
                                        <th class="text-center" width="15%" style="color: #a8b6bc !important;">QTY
                                        </th>
                                        <th class="text-center" width="15%" style="color: #a8b6bc !important;">PRICE
                                        </th>
                                        <th class="text-center" width="15%" style="color: #a8b6bc !important;">DISC
                                        </th>
                                        <th class="text-center" width="15%" style="color: #a8b6bc !important;">TOTAL
                                        </th>
                                        <th class="text-center" width="15%" style="color: #a8b6bc !important;">ACT
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="table_cart" class="scroll-hide"
                                    style="font-size: 10px;width: 100% !important;">

                                </tbody>
                            </table>
                        </div>
                        <div class="card-arrow">
                            <div class="card-arrow-top-left"></div>
                            <div class="card-arrow-top-right"></div>
                            <div class="card-arrow-bottom-left"></div>
                            <div class="card-arrow-bottom-right"></div>
                        </div>
                    </div>

                    <div class="card mt-3">

                        <div class="card-body" style="height: auto;">
                            <div class="row">

                                <div class="col-4" style="padding-left: 17px;">
                                    <div class="row bagde border border-default">
                                        <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                            <span class="text-success fs-12px" style="width: 120px;">Sub Total
                                                : </span>
                                        </div>
                                        <div class="col-7" align="right" style="padding-top: 3px;">
                                            <span class="text-success fw-bold fs-12px" style="width: 120px;">Rp <span
                                                    id="rh_subtotal">0</span></span>
                                        </div>
                                        <input type="hidden" value="0" id="rs_subtotal">
                                    </div>

                                    <div class="row bagde border border-default">
                                        <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                            <span class="text-yellow fs-12px" style="width: 120px;">Disc Items
                                                : </span>
                                        </div>
                                        <div class="col-7" align="right" style="padding-top: 3px;">
                                            <span class="text-yellow fw-bold fs-12px" style="width: 120px;">Rp <span
                                                    id="rh_discitems">0</span></span>
                                        </div>
                                        <input type="hidden" value="0" id="rs_discitems">
                                    </div>

                                    <div class="row bagde border border-default">
                                        <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                            <span class="text-yellow fs-12px" style="width: 120px;">Disc Nota
                                                : </span>
                                        </div>
                                        <div class="col-7" align="right" style="padding-top: 3px;">
                                            <span class="text-yellow fw-bold fs-12px" style="width: 120px;">Rp <span
                                                    id="rh_discnota">0</span></span>
                                        </div>
                                        <input type="hidden" value="0" id="rs_discnota" name="rs_discnota">
                                    </div>

                                    <div class="row bagde border border-default">
                                        <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                            <span class="text-indigo fs-12px" style="width: 120px;">Ongkir
                                                : </span>
                                        </div>
                                        <div class="col-7" align="right" style="padding-top: 3px;">
                                            <span class="text-indigo fw-bold fs-12px" style="width: 120px;">Rp <span
                                                    id="rh_ongkir">0</span></span>
                                        </div>
                                        <input type="hidden" value="0" id="rs_ongkir" name="rs_ongkir">
                                    </div>

                                    <div class="row bagde border border-default">
                                        <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                            <span class="text-success fs-12px" style="width: 120px;">Payment
                                                : </span>
                                        </div>
                                        <div class="col-7" align="right" style="padding-top: 3px;">
                                            <span class="text-success fw-bold fs-12px" style="width: 120px;">Rp <span
                                                    id="rh_payment">0</span></span>
                                        </div>
                                        <input type="hidden" value="0" id="rs_payment" name="rs_payment">
                                    </div>
                                </div>
                                <div class="col-8">
                                    {{-- <div class="col-12 mb-3" style="display: none" id="show_reseller">
                                        <select class="form-select fw-bold form-select-sm text-theme" id="reseller_name"
                                            name="reseller_name" required>
                                            <option value="" disabled selected>Name Reseller..</option>
                                            @foreach ($getreseller as $reseller)
                                                <option value="{{ $reseller->id_reseller }}">{{ $reseller->nama }}</option>
                                @endforeach
                                </select>
                            </div> --}}
                                    <div class="row">
                                        <div class="col-4">
                                            <button type="button" id="btn_ongkir" class="btn btn-default"
                                                style="width: 100%;" disabled onclick="ongkirModal()">ONGKIR</button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-yellow" style="width: 100%;"
                                                onclick="discountModal()">DISCOUNT ALL</button>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-danger" style="width: 100%;"
                                                onclick="clear_cart()">X</button>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-success fw-bold fs-14px"
                                                style="width: 100%;" onclick="paymentModal()">PAY (Rp <span
                                                    id="pay_ammount">0</span>)</button>
                                        </div>
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
            </div>

            {{-- Modal Payment --}}
            <div class="modal fade" id="paymentModal" data-bs-backdrop="static" style="margin-top: 3%;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Payment</h5>
                            <button type="button" class="btn btn-outline-theme btn-sm"
                                onclick="hide_payment_modal()">x</button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">Amount</div>
                            <center>
                                <h2>Rp <span id="s_grandtotal">0</span></h2>
                            </center>
                            <input type="hidden" value="" id="r_grandtotal" name="r_grandtotal">
                            <div class="mb-2 mt-4">Payment Method</div>

                            <select class="form-select mb-4" id="r_payment_method" name="r_payment_method">
                                <option value="PAID" selected>PAID (RESELLER)</option>
                                <option value="PENDING">PENDING (RESELLER)</option>
                            </select>

                            <div class="row p-2 alert-warning" id="warning"
                                style="margin-left: 7px;margin-right: 7px;">
                                *Ongkir dan Diskon Nota tidak akan dihitung Jika metode Pembayaran yang di pilih Pending
                            </div>

                            <!-- <input type="text" value="0" id="rs_paymethod" name="rs_paymethod"> -->

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
                            <button type="button" class="btn btn-theme" onclick="save_payment()">Pay</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Payment --}}

            {{-- Modal Ongkir --}}
            <div class="modal fade" id="ongkirModal" style="margin-top: 7%;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Biaya Ongkir</h5>
                            <button type="button" class="btn btn-theme btn-sm" onclick="hide_ongkir_modal()">x</button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control" id="md_ongkir" placeholder="Masukan Biaya Ongkir"
                                type-currency="IDR" value="0">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="hide_ongkir_modal()">Close</button>
                            <button type="button" class="btn btn-primary" onclick="save_ongkir()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Ongkir --}}

            {{-- Modal Discount --}}
            <div class="modal fade" id="discountModal" style="margin-top: 7%;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Discount Nota</h5>
                            <button type="button" class="btn btn-theme btn-sm" onclick="hide_discountModal()">x</button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control" id="md_discountnota"
                                placeholder="Masukan Discount" type-currency="IDR" value="0">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                onclick="hide_discountModal()">Close</button>
                            <button type="button" class="btn btn-primary" onclick="save_discount()">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Discount --}}

            <!-- BEGIN #modalPosItem -->
            <div class="modal modal-pos fade" id="modalPosItem" style="margin-top: 2%;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0">
                        <div class="card">
                            <div class="card-body p-0">
                                <a href="#" onclick="hide_modal()"
                                    class="btn-close position-absolute top-0 end-0 m-4"></a>
                                <div class="modal-pos-product">
                                    <div class="modal-pos-product-img">
                                        <input type="hidden" id="mdl_produk" name="mdl_produk" value="">
                                        <input type="hidden" id="c_size" name="c_size" value="">
                                        <input type="hidden" id="mdl_id_produk" name="mdl_id_produk" value="">
                                        <input type="hidden" id="mdl_id_brand" name="mdl_id_brand" value="">
                                        <input type="hidden" id="mdl_quality" name="mdl_quality" value="">
                                        <input type="hidden" id="mdl_selling_price" name="mdl_selling_price"
                                            value="">

                                        <div class="mb-2"><img id="image_product" width="100%"></div>

                                        <div class="mb-2 p-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="fw-bold mb-2">Qty:</div>
                                                    <div class="d-flex mb-3">
                                                        <button type="button" class="btn btn-outline-theme"
                                                            onclick="change_qty('minus')"><i
                                                                class="fa fa-minus"></i></button>
                                                        <input type="text"
                                                            class="form-control w-50px fw-bold mx-2 border-1 border-theme text-center"
                                                            id="mdl_qty" value="1" readonly />
                                                        <button type="button" class="btn btn-outline-theme"
                                                            onclick="change_qty('plus')"><i
                                                                class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="fw-bold mb-2">Discount Item:</div>
                                                    <select class="form-select fw-bold border-theme text-theme"
                                                        id="mdl_diskon_item">
                                                        <option value="0" selected>Rp 0</option>
                                                        <option value="10000">Rp 10.000</option>
                                                        <option value="20000">Rp 20.000</option>
                                                        <option value="30000">Rp 30.000</option>
                                                        <option value="40000">Rp 40.000</option>
                                                        <option value="50000">Rp 50.000</option>
                                                        <option value="60000">Rp 60.000</option>
                                                        <option value="70000">Rp 70.000</option>
                                                        <option value="80000">Rp 80.000</option>
                                                        <option value="90000">Rp 90.000</option>
                                                        <option value="100000">Rp 100.000</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-pos-product-info">
                                        <div class="h5 mb-2" id="md_nameproduct"></div>
                                        <div class="h6 mb-3" id="md_price"></div>
                                        <hr class="mx-n4" />

                                        <div class="mb-3">
                                            <div class="col-12">
                                                <div class="fw-bold mb-2">Warehouse:</div>
                                                <div id="load_ware">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="fw-bold mb-2">Size:</div>
                                            <style>
                                                .radio-toolbar input[type="radio"] {
                                                    display: none;
                                                }

                                                .radio-toolbar label {
                                                    display: inline-block;
                                                    padding: 4px 11px;
                                                    font-family: Arial;
                                                    font-size: 16px;
                                                    text-align: center;
                                                    width: 100%;
                                                }

                                                .radio-toolbar input[type="radio"]:checked+label {
                                                    color: black;
                                                    background-color: aquamarine;
                                                }

                                                .radio-toolbar label {
                                                    color: aquamarine;
                                                    padding: 10px 15px 10px 15px;
                                                    border: 1px solid;
                                                    border-radius: 5px;
                                                    margin-top: 5px;
                                                    margin-bottom: 5px;
                                                    font-size: 12px;
                                                }
                                            </style>
                                            <div class="radio-toolbar row" id="load_size">
                                            </div>
                                        </div>

                                        <script>
                                            function change_qty(params) {
                                                var value = document.getElementById("mdl_qty").value;
                                                if (params == 'minus') {
                                                    if (value == 1) {} else {
                                                        document.getElementById("mdl_qty").value = parseInt(value) - 1;
                                                    }
                                                } else if (params == 'plus') {
                                                    document.getElementById("mdl_qty").value = parseInt(value) + 1;
                                                }
                                            }
                                        </script>
                                        <hr class="mb-4" />
                                        <div class="row">
                                            <div class="col-4">
                                                <a href="#" class="btn btn-default h4 mb-0 d-block rounded-0 py-3"
                                                    onclick="hide_modal()">Cancel</a>
                                            </div>
                                            <div class="col-8">
                                                <a onclick="addCart()"
                                                    class="btn btn-success d-flex justify-content-center align-items-center rounded-0 py-3 h4 m-0">Add
                                                    to cart <i class="bi bi-plus fa-2x ms-2 my-n3"></i></a>
                                            </div>
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
                </div>
            </div>
            <!-- END #modalPosItem -->

        </form>

        <script>
            $(document).on("dblclick", "#search_barcode", function() {
                var up_price = $('#up_price').val();
                var id_area = $('#r_area').val();

                var cashier = $('#cashier').find(":selected").val();
                var customer = $('#customer').find(":selected").val();
                var reseller_name = $('#reseller_name').find(":selected").val();

                var querys = $('#search_barcode').val();
                const split = querys.split(".");
                var id_produk = split[0];
                var size = split[1];

                $('#c_size').val(size);

                if (querys == '') {

                } else {
                    if ($('#select_store').find(":selected").val() == '') {
                        alert('Silahkan Pilih Store');
                    } else {
                        if (cashier == '') {
                            alert('Silahkan Pilih Kasir');
                        } else {
                            if (customer == '') {
                                alert('Silahkan Pilih Tipe Customer');
                            } else {
                                if (customer == 'RESELLER' || customer == 'GROSIR') {
                                    if (reseller_name == '') {
                                        alert('Silahkan Pilih Nama Reseller');
                                    } else {
                                        $.ajax({
                                            url: "/getbarcodeproduct",
                                            type: "GET",
                                            data: {
                                                id_produk: id_produk
                                            },
                                            dataType: 'JSON',
                                            beforeSend: function() {},
                                            success: function(response) {
                                                if (response['count'] > 0) {
                                                    var md_nameproduct = response['produk'];
                                                    var image_product = response['img_produk'];
                                                    var id_brand = response['brand'];
                                                    var quality = response['quality'];

                                                    var n_price = parseInt(response['n_price']) + parseInt(
                                                        up_price);
                                                    var r_price = parseInt(response['r_price']) + parseInt(
                                                        up_price);
                                                    var g_price = parseInt(response['g_price']) + parseInt(
                                                        up_price);

                                                    open_modalPositem(md_nameproduct, image_product,
                                                        id_produk,
                                                        id_area,
                                                        id_brand, quality,
                                                        n_price,
                                                        r_price, g_price)
                                                } else {
                                                    alert('Data tidak ditemukan');
                                                }
                                            }
                                        });
                                    }
                                } else {
                                    $.ajax({
                                        url: "/getbarcodeproduct",
                                        type: "GET",
                                        data: {
                                            id_produk: id_produk
                                        },
                                        dataType: 'JSON',
                                        beforeSend: function() {},
                                        success: function(response) {
                                            if (response['count'] > 0) {
                                                var md_nameproduct = response['produk'];
                                                var image_product = response['img_produk'];
                                                var id_brand = response['brand'];
                                                var quality = response['quality'];

                                                var n_price = parseInt(response['n_price']) + parseInt(
                                                    up_price);
                                                var r_price = parseInt(response['r_price']) + parseInt(
                                                    up_price);
                                                var g_price = parseInt(response['g_price']) + parseInt(
                                                    up_price);

                                                open_modalPositem(md_nameproduct, image_product, id_produk,
                                                    id_area,
                                                    id_brand, quality,
                                                    n_price,
                                                    r_price, g_price)
                                            } else {
                                                alert('Data tidak ditemukan');
                                            }
                                        }
                                    });
                                }
                            }
                        }
                    }
                }




            });

            $(document).on("dblclick", ".open-modal", function() {
                var up_price = $('#up_price').val();
                var id_area = $('#r_area').val();
                $('#c_size').val('allsize');

                var md_nameproduct = $(this).data('md_nameproduct');
                var image_product = $(this).data('image_product');
                var id_produk = $(this).data('id_produk');
                // var id_area = $(this).data('id_area');
                var id_brand = $(this).data('id_brand');
                var quality = $(this).data('quality');
                // var m_price = $(this).data('m_price');
                var n_price = parseInt($(this).data('n_price')) + parseInt(up_price);
                var r_price = parseInt($(this).data('r_price')) + parseInt(up_price);
                var g_price = parseInt($(this).data('g_price')) + parseInt(up_price);

                var cashier = $('#cashier').find(":selected").val();
                var customer = $('#customer').find(":selected").val();
                var reseller_name = $('#reseller_name').find(":selected").val();

                if (cashier == '') {
                    alert('Silahkan Pilih Kasir');
                } else {
                    if (customer == '') {
                        alert('Silahkan Pilih Tipe Customer');
                    } else {
                        if (customer == 'RESELLER' || customer == 'GROSIR') {
                            if (reseller_name == '') {
                                alert('Silahkan Pilih Nama Reseller');
                            } else {
                                open_modalPositem(md_nameproduct, image_product, id_produk, id_area, id_brand, quality,
                                    n_price,
                                    r_price, g_price)
                            }
                        } else {
                            open_modalPositem(md_nameproduct, image_product, id_produk, id_area, id_brand, quality,
                                n_price,
                                r_price, g_price)
                        }
                    }
                }

            });

            function open_modalPositem(md_nameproduct, image_product, id_produk, id_area, id_brand, quality, n_price,
                r_price, g_price) {

                $('#load_size').html('<center>Pilih Warehouse Dahulu</center>')
                $('#load_ware').html(
                    '<select class="form-select fw-bold text-dark" disabled><option value="" selected>Loading Warehouse..</option></select>'
                )

                $('#mdl_produk').val(md_nameproduct);
                $('#mdl_id_produk').val(id_produk);
                $('#mdl_id_brand').val(id_brand);
                $('#mdl_quality').val(quality);
                $("#md_nameproduct").html(md_nameproduct);
                $('#image_product').attr('src', '/product/' + image_product);

                var cashier = $('#cashier').find(":selected").val();
                var customer = $('#customer').find(":selected").val();
                var reseller_name = $('#reseller_name').find(":selected").val();

                if (customer == 'RETAIL') {
                    $('#mdl_selling_price').val(n_price);
                    $("#md_price").html('Rp ' + new Intl.NumberFormat('ID-ID', {
                        maximumSignificantDigits: 3
                    }).format(n_price));
                } else if (customer == 'RESELLER') {
                    $('#mdl_selling_price').val(r_price);
                    $("#md_price").html('Rp ' + new Intl.NumberFormat('ID-ID', {
                        maximumSignificantDigits: 3
                    }).format(r_price));
                } else if (customer == 'GROSIR') {
                    $('#mdl_selling_price').val(g_price);
                    $("#md_price").html('Rp ' + new Intl.NumberFormat('ID-ID', {
                        maximumSignificantDigits: 3
                    }).format(g_price));
                }

                load_ware(id_area);
                $('#modalPosItem').modal('show');
            }

            function load_size(id_produk, id_ware, size) {
                var store = $('#select_store').find(':selected').data("id_store");
                $.ajax({
                        url: "/load_size",
                        type: "POST",
                        data: {
                            id_produk: id_produk,
                            id_ware: id_ware,
                            size: size,
                            store: store
                        },
                        beforeSend: function() {
                            $('#load_size').html('<center>Loading Size...</center>');
                        },
                    })
                    .done(function(response) {
                        $("#load_size").html(response);
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log('Server error occured');
                    });
            }

            function load_ware(id_area) {
                $.ajax({
                        url: "/load_ware",
                        type: "POST",
                        data: {
                            id_area: id_area
                        },

                    })
                    .done(function(response) {
                        $("#load_ware").html(response);
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log('Server error occured');
                    });
            }

            $('#customer').on('change', function() {
                clear_cart();
                if (this.value != 'RETAIL') {
                    $("#reseller_name").prop("disabled", false);
                    $("#btn_ongkir").prop("disabled", false);
                    $("#btn_ongkir").removeClass("btn-default").addClass("btn-purple");
                } else {
                    $("#reseller_name").prop("disabled", true);
                    $("#btn_ongkir").prop("disabled", true);
                    $("#btn_ongkir").removeClass("btn-purple").addClass("btn-default");
                }
            });

            function addCart() {
                var table = document.getElementById("table");
                var tbo = table.tBodies[0].rows.length;
                var length = parseInt(tbo) + 1;

                document.getElementById("counter_span").innerHTML = "(" + length + ")";
                document.getElementById("count").value = length;

                if ($('input[name=mdl_size]:checked').length > 0) {
                    var mdl_size = document.querySelector('input[name="mdl_size"]:checked').value;
                    var mdl_qty_stock = document.querySelector('input[name="mdl_size"]:checked').getAttribute('data-qty');
                    var mdl_produk = document.getElementById("mdl_produk").value;
                    var mdl_id_produk = document.getElementById("mdl_id_produk").value;
                    var mdl_warehouse = document.getElementById("mdl_warehouse").value;
                    var mdl_id_brand = document.getElementById("mdl_id_brand").value;
                    var mdl_quality = document.getElementById("mdl_quality").value;
                    // var mdl_m_price = document.getElementById("mdl_m_price").value;
                    var mdl_selling_price = document.getElementById("mdl_selling_price").value;
                    var mdl_qty = document.getElementById("mdl_qty").value;
                    var mdl_diskon_item = parseInt(document.getElementById("mdl_diskon_item").value) * parseInt(mdl_qty);
                    var mdl_subtotal = (mdl_selling_price * mdl_qty) - mdl_diskon_item;
                    var md_warehouse = $('#mdl_warehouse').find(':selected').data("warehouse");

                    if (parseInt(mdl_qty_stock) < parseInt(mdl_qty)) {
                        alert('QTY Melebihi Stock yang ada');
                    } else {
                        var table = document.getElementById("table");
                        var tbo = table.tBodies[0].rows.length;
                        var length = parseInt(tbo);

                        $validasi_produk = '';

                        for (index = 0; index < length; index++) {
                            var row_id_ware = document.getElementsByName('r_idware[]')[index].value;
                            var row_size = document.getElementsByName('r_size[]')[index].value;
                            var row_id_produk = document.getElementsByName('r_id_produk[]')[index].value;
                            if (mdl_warehouse == row_id_ware && mdl_size == row_size && mdl_id_produk == row_id_produk) {
                                $validasi_produk = 'BREAK';
                                break;
                            }
                            $validasi_produk = 'OKE';
                        }

                        if ($validasi_produk === 'BREAK') {
                            alert('Produk dengan Size dan Gudang yang sama sudah ada');
                        } else {
                            if ($('input[name=type_product]:checked').length > 0) {
                                var display = document.querySelector('input[name="type_product"]:checked').value;

                                if (display === 'display') {
                                    var dsp = '<span class="badge bg-warning"> Display</span>';
                                } else {
                                    var dsp = '';
                                }
                                // add To Cart
                                document.getElementById("table_cart").insertRow(-1).innerHTML = `
                            <tr>
                                <td class="text-left fw-bold" style="width:60%;">
                                    <span>` + mdl_produk + dsp + `</span><br>
                                    <span class="text-theme">` + md_warehouse + `</span><br>
                                    <input type="hidden" id="r_produk" name="r_produk[]" value="` + mdl_produk + `">
                                    <input type="hidden" id="r_display" name="r_display[]" value="` + display + `">
                                    <input type="hidden" id="r_id_produk" name="r_id_produk[]" value="` +
                                    mdl_id_produk + `">
                                    <input type="hidden" id="r_idware" name="r_idware[]" value="` + mdl_warehouse + `">
                                    <input type="hidden" id="r_id_brand" name="r_id_brand[]" value="` + mdl_id_brand + `">
                                    <input type="hidden" id="r_quality" name="r_quality[]" value="` + mdl_quality + `">
                                    <input type="hidden" id="r_selling_price" name="r_selling_price[]" value="` +
                                    mdl_selling_price + `">
                                    <input type="hidden" id="r_subtotal" name="r_subtotal[]" value="` + mdl_subtotal + `">
                                    <input type="hidden" id="r_size" name="r_size[]" value="` + mdl_size + `">
                                    <input type="hidden" id="r_qty" name="r_qty[]" value="` + mdl_qty + `">
                                    <input type="hidden" id="r_diskon_item" name="r_diskon_item[]" value="` +
                                    mdl_diskon_item + `">
                                </td>
                                <td width="15%" class="text-center">` + mdl_qty + `x` + mdl_size + `</td>
                                <td width="15%" class="text-center">` + new Intl.NumberFormat('ID-ID', {
                                        maximumSignificantDigits: 3
                                    }).format(mdl_selling_price) + `</td>
                                <td width="15%" class="text-center">` + new Intl.NumberFormat('ID-ID', {
                                        maximumSignificantDigits: 3
                                    }).format(mdl_diskon_item) + `</td>
                                <td width="15%" class="text-center">` + new Intl.NumberFormat('ID-ID', {
                                        maximumSignificantDigits: 3
                                    }).format(mdl_subtotal) + `</td>
                                <td width="10%" class="text-center"><button onclick="deleteRow(this)" type="button" class="btn btn-sm btn-danger">X</button></td>
                            </tr>
                            `;

                                let rupiah = Intl.NumberFormat('id-ID');

                                document.getElementById("rh_subtotal").innerHTML = rupiah.format(parseInt(document
                                    .getElementById(
                                        "rs_subtotal")
                                    .value) + (parseInt(mdl_selling_price) * parseInt(mdl_qty)));

                                document.getElementById("rs_subtotal").value = parseInt(document.getElementById("rs_subtotal")
                                    .value) + (parseInt(mdl_selling_price) * parseInt(mdl_qty));
                                /////////////////////////////
                                document.getElementById("rh_discitems").innerHTML = rupiah.format(parseInt(document
                                    .getElementById(
                                        "rs_discitems")
                                    .value) + parseInt(mdl_diskon_item));

                                document.getElementById("rs_discitems").value = parseInt(document.getElementById("rs_discitems")
                                    .value) + parseInt(mdl_diskon_item);
                                /////////////////////////////
                                document.getElementById("rh_payment").innerHTML = rupiah.format(parseInt(document
                                    .getElementById("rs_subtotal")
                                    .value) - (
                                    parseInt(document.getElementById("rs_discitems").value) + parseInt(document
                                        .getElementById(
                                            "rs_discnota").value)) + parseInt(document.getElementById("rs_ongkir")
                                    .value));

                                document.getElementById("rs_payment").value = parseInt(document.getElementById("rs_subtotal")
                                    .value) - (
                                    parseInt(document.getElementById("rs_discitems").value) + parseInt(document
                                        .getElementById(
                                            "rs_discnota").value)) + parseInt(document.getElementById("rs_ongkir").value);

                                document.getElementById("pay_ammount").innerHTML = rupiah.format(document.getElementById(
                                    "rs_payment").value);
                                /////////////////////////////
                                document.getElementById("mdl_qty").value = 1;
                                document.getElementById("mdl_diskon_item").value = 0;
                                $('#modalPosItem').modal('hide');
                                // add To Cart
                            } else {
                                alert('Pastikan Stock Display di Pilih')
                            }
                        }
                    }
                } else {
                    alert('Mohon Lengkapi Warehouse dan Size');
                }
            }

            function hide_modal() {
                document.getElementById("mdl_qty").value = 1;
                document.getElementById("mdl_diskon_item").value = 0;
                $('#modalPosItem').modal('hide');
            }

            function deleteRow(r) {
                var i = r.parentNode.parentNode.rowIndex;
                var r = i - 1;

                var subtotal = document.getElementsByName('r_selling_price[]')[r].value;
                var qty = document.getElementsByName('r_qty[]')[r].value;
                var discitem = document.getElementsByName('r_diskon_item[]')[r].value;

                let rupiah = Intl.NumberFormat('id-ID');

                document.getElementById("rh_subtotal").innerHTML = rupiah.format(parseInt(document.getElementById("rs_subtotal")
                    .value) - (
                    parseInt(subtotal) * parseInt(qty)));

                document.getElementById("rs_subtotal").value = parseInt(document.getElementById("rs_subtotal").value) - (
                    parseInt(subtotal) * parseInt(qty));
                /////////////////////////////
                document.getElementById("rh_discitems").innerHTML = rupiah.format(parseInt(document.getElementById(
                        "rs_discitems").value) -
                    parseInt(discitem));

                document.getElementById("rs_discitems").value = parseInt(document.getElementById("rs_discitems").value) -
                    parseInt(discitem);
                /////////////////////////////
                document.getElementById("rh_payment").innerHTML = rupiah.format(parseInt(document.getElementById("rs_subtotal")
                    .value) - (
                    parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById(
                        "rs_discnota").value)) + parseInt(document.getElementById("rs_ongkir").value));

                document.getElementById("rs_payment").value = parseInt(document.getElementById("rs_subtotal").value) - (
                    parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById(
                        "rs_discnota").value)) + parseInt(document.getElementById("rs_ongkir").value);

                document.getElementById("pay_ammount").innerHTML = rupiah.format(document.getElementById("rs_payment").value);

                document.getElementById("table").deleteRow(i);

                var table = document.getElementById("table");
                var tbo = table.tBodies[0].rows.length;
                var length = parseInt(tbo);
                document.getElementById("counter_span").innerHTML = "(" + length + ")";
                document.getElementById("count").value = length;

                if (tbo == '0') {
                    /////////////////////////////
                    document.getElementById("rh_discnota").innerHTML = 0;
                    document.getElementById("rs_discnota").value = 0;
                    /////////////////////////////
                    document.getElementById("rh_ongkir").innerHTML = 0;
                    document.getElementById("rs_ongkir").value = 0;
                    /////////////////////////////
                    document.getElementById("rh_payment").innerHTML = 0;
                    document.getElementById("rs_payment").value = 0;
                    document.getElementById("pay_ammount").innerHTML = 0;
                    /////////////////////////////   
                }
            }

            function ongkirModal() {
                var amount = document.getElementById("rs_payment").value;

                if (amount == '0') {
                    alert('Silahkan Masukan Pesanan Dahulu');
                } else {
                    $('#ongkirModal').modal('show');
                }
            }

            function hide_ongkir_modal() {
                $('#ongkirModal').modal('hide');
            }

            function save_ongkir() {
                let rupiah = Intl.NumberFormat('id-ID');
                /////////////////////////////
                document.getElementById("rh_ongkir").innerHTML = rupiah.format(parseInt(document.getElementById("md_ongkir")
                    .value.replace(/\D/g, '')));

                document.getElementById("rs_ongkir").value = parseInt(document.getElementById("md_ongkir").value.replace(/\D/g,
                    ''));
                /////////////////////////////
                document.getElementById("rh_payment").innerHTML = rupiah.format(parseInt(document.getElementById("rs_subtotal")
                    .value) - (
                    parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById(
                        "rs_discnota").value)) + parseInt(document.getElementById("rs_ongkir").value));

                document.getElementById("rs_payment").value = parseInt(document.getElementById("rs_subtotal").value) - (
                    parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById(
                        "rs_discnota").value)) + parseInt(document.getElementById("rs_ongkir").value);

                document.getElementById("pay_ammount").innerHTML = rupiah.format(document.getElementById("rs_payment").value);
                /////////////////////////////
                $('#ongkirModal').modal('hide');
            }

            function discountModal() {
                var amount = document.getElementById("rs_payment").value;

                if (amount == '0') {
                    alert('Silahkan Masukan Pesanan Dahulu');
                } else {
                    $('#discountModal').modal('show');
                }
            }

            function hide_discountModal() {
                $('#discountModal').modal('hide');
            }

            function save_discount() {
                let rupiah = Intl.NumberFormat('id-ID');
                /////////////////////////////
                document.getElementById("rh_discnota").innerHTML = rupiah.format(parseInt(document.getElementById(
                    "md_discountnota").value.replace(/\D/g,
                    '')));

                document.getElementById("rs_discnota").value = parseInt(document.getElementById("md_discountnota").value
                    .replace(/\D/g,
                        ''));
                /////////////////////////////
                document.getElementById("rh_payment").innerHTML = rupiah.format(parseInt(document.getElementById("rs_subtotal")
                    .value) - (
                    parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById(
                        "rs_discnota").value)) + parseInt(document.getElementById("rs_ongkir").value));

                document.getElementById("rs_payment").value = parseInt(document.getElementById("rs_subtotal").value) - (
                    parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById(
                        "rs_discnota").value)) + parseInt(document.getElementById("rs_ongkir").value);

                document.getElementById("pay_ammount").innerHTML = rupiah.format(document.getElementById("rs_payment").value);
                /////////////////////////////
                $('#discountModal').modal('hide');
            }

            function clear_cart() {
                document.getElementById("reseller_name").value = '';
                document.getElementById("counter_span").innerHTML = "(0)";
                document.getElementById("count").value = 0;

                document.getElementById("rh_subtotal").innerHTML = 0;
                document.getElementById("rs_subtotal").value = 0;
                document.getElementById("rh_discitems").innerHTML = 0;
                document.getElementById("rs_discitems").value = 0;
                document.getElementById("rh_discnota").innerHTML = 0;
                document.getElementById("rs_discnota").value = 0;
                document.getElementById("rh_ongkir").innerHTML = 0;
                document.getElementById("rs_ongkir").value = 0;
                document.getElementById("rh_payment").innerHTML = 0;
                document.getElementById("rs_payment").value = 0;
                document.getElementById("pay_ammount").innerHTML = 0;

                $('#search_barcode').val('');

                $("#table > tbody").empty();
            }

            function paymentModal() {
                let rupiah = Intl.NumberFormat('id-ID');

                var amount = document.getElementById("rs_payment").value;
                document.getElementById("r_grandtotal").value = amount;
                document.getElementById("s_grandtotal").innerHTML = rupiah.format(amount);

                var customer = $('#customer').find(":selected").val();

                if (amount == '0') {
                    alert('Silahkan Masukan Pesanan Dahulu');
                } else {
                    if (customer == "RETAIL") {
                        $('#r_payment_method').val("PAID");
                        $("#r_payment_method").css("display", "none");
                        $("#select_ammount").css("display", "block");
                        $("#warning").css("display", "none");
                    } else {
                        $('#r_payment_method').val("PAID");
                        $("#r_payment_method").css("display", "block");
                        $("#select_ammount").css("display", "block");
                        $("#warning").css("display", "none");
                    }

                    $('#paymentModal').modal('show');
                }
            }

            $('#r_payment_method').on('change', function() {
                let rupiah = Intl.NumberFormat('id-ID');

                if (this.value == "PAID") {
                    $("#select_ammount").css("display", "block");
                    $("#warning").css("display", "none");

                    document.getElementById("r_grandtotal").value = document.getElementById("rs_payment").value;
                    document.getElementById("s_grandtotal").innerHTML = rupiah.format(document.getElementById(
                        "rs_payment").value);
                } else {
                    document.getElementById("r_grandtotal").value = parseInt(document.getElementById("rs_subtotal")
                        .value) - parseInt(document.getElementById("rs_discitems").value);
                    document.getElementById("s_grandtotal").innerHTML = rupiah.format(parseInt(document.getElementById(
                        "rs_subtotal").value) - parseInt(document.getElementById("rs_discitems").value));

                    document.getElementById("r_cash").value = '';
                    document.getElementById("r_bca").value = '';
                    document.getElementById("r_mandiri").value = '';
                    document.getElementById("r_banktf").value = '';
                    $("#select_ammount").css("display", "none");
                    $("#warning").css("display", "block");
                }
            });

            function hide_payment_modal() {
                $('#paymentModal').modal('hide');
            }

            function save_payment() {
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

                var method = $('#r_payment_method').find(":selected").val();

                if (method == "PENDING") {
                    document.getElementById("form_pay").submit();
                } else {
                    if (total_pay != grandtotal) {
                        alert('Nominal tidak sesuai dengan Total Payment');
                    } else {
                        document.getElementById("form_pay").submit();
                    }
                }

            }

            function cek_kosong(e) {
                // alert(e.value);
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

        {{-- @include('store.delete')
        @include('store.edit') --}}

        <link href="{{ URL::asset('/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"
            rel="stylesheet" />
        <link href="{{ URL::asset('/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
            rel="stylesheet" />
        <link href="{{ URL::asset('/assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}"
            rel="stylesheet" />

        <script src="{{ URL::asset('/assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
        </script>



        {{-- <script>
            // edit
            function openmodaledit(id, id_store, store, address, id_ware, warehouse) {
                $('#modaledit').modal('show');

                document.getElementById('e_id').value = id;
                document.getElementById('e_id_store').value = id_store;
                document.getElementById('e_store').value = store;
                document.getElementById('e_address').value = address;
                document.getElementById('e_id_ware').value = id_ware;


                document.getElementById("e_warehousedefault").innerHTML = "DEFAULT : " + warehouse;
            }

            function submitformedit() {
                var value = document.getElementById('e_id').value;
                document.getElementById('form_edit').action = "../store/editact/" + value;
                document.getElementById("form_edit").submit();
            }

            // delete
            function openmodaldelete(id) {
                $('#modaldelete').modal('show');
                document.getElementById('del_id').value = id;
            }

            function submitformdelete() {
                var value = document.getElementById('del_id').value;
                document.getElementById('form_delete').action = "../store/destroy/" + value;
                document.getElementById("form_delete").submit();
            }
        </script> --}}
    @endsection

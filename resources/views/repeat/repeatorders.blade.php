@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">MANAGEMENT STOCK</a></li>
                    <li class="breadcrumb-item active">RELEASE REPEAT ORDER PAGE</li>
                </ul>

                <h1 class="page-header">
                    Release / Repeat
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
            <div class="ms-sm-3 mt-sm-3"><a class="btn btn-sm btn-outline-yellow" data-bs-toggle="modal"
                    data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> RELEASE PRODUCT</a>
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

        <div class="modal fade" id="modaladd" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">RELEASE PRODUCTS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formadd" class="was-validated" method="POST" enctype="multipart/form-data"
                        action="{{ url('/product/products/store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-4">
                                    <div class="row form-group">
                                        <div class="col-2 mt-2">
                                        </div>
                                        <div class="col-8 mt-2 form-group position-relative mb-2 profile-img"
                                            align="center">
                                            <script type="text/javascript">
                                                var loadeditFile = function(event) {
                                                    var previewimg = document.getElementById('previewimg');
                                                    previewimg.src = URL.createObjectURL(event.target.files[0]);
                                                };
                                            </script>
                                            <img class="mb-2" id="previewimg" width="247px"
                                                src="/product/defaultimg.png">
                                            <input type="file" class="form-control" id="file" name="file"
                                                onchange="loadeditFile(event)">
                                        </div>
                                        <div class="card-arrow">
                                            <div class="card-arrow-top-left"></div>
                                            <div class="card-arrow-top-right"></div>
                                            <div class="card-arrow-bottom-left"></div>
                                            <div class="card-arrow-bottom-right"></div>
                                        </div>
                                        <div class="col-2 mt-2">
                                        </div>
                                        <div class="col-12 form-group mb-3">
                                            <label class="form-label">Nama Produk</label>
                                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                                name="produk" required placeholder="Silahkan masukan nama produk"
                                                autocomplete="OFF">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="row form-group">
                                        <div class="col-6 form-group position-relative mb-3">
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

                                        <div class="col-6 form-group position-relative mb-3">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-select form-select-sm text-theme" name="category" required>
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

                                        <div class="col-6 form-group position-relative mb-3 mt-3">
                                            <label class="form-label">Kualitas</label>
                                            <select class="form-select form-select-sm text-theme" name="quality" required>
                                                <option value="" disabled selected>Pilih Kualitas</option>
                                                <option value="LOKAL">LOKAL</option>
                                                <option value="IMPORT">IMPORT</option>
                                                <option value="ORIGINAL">ORIGINAL</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih kualitas yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group position-relative mb-3 mt-3">
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

                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Modal</label>
                                            <input class="form-control form-control-sm text-theme is-invalid"
                                                type="text" name="m_price" required placeholder="0"
                                                autocomplete="OFF" type-currency="IDR">
                                        </div>
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Reseller</label>
                                            <input class="form-control form-control-sm text-theme is-invalid"
                                                type="text" name="r_price" required placeholder="0"
                                                autocomplete="OFF" type-currency="IDR">
                                        </div>
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Normal</label>
                                            <input class="form-control form-control-sm text-theme is-invalid"
                                                type="text" name="n_price" required placeholder="0"
                                                autocomplete="OFF" type-currency="IDR">
                                        </div>
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Grosir</label>
                                            <input
                                                class="form-control form-select-sm form-control-sm text-theme is-invalid"
                                                type="text" name="g_price" required placeholder="0"
                                                autocomplete="OFF" type-currency="IDR">
                                        </div>
                                        <div class="col-12 form-group position-relative mb-2">
                                            <label class="form-label">Supplier</label>
                                            <div class="position-relative text-center mb-3">
                                                <select class="form-select form-select-sm text-theme text-center"
                                                    name="type_po" id="type_po_add" required onchange="typepo_add()">
                                                    <option value="" disabled selected>Tipe PO</option>
                                                    <option value="baru">PO Baru</option>
                                                    <option value="lama">PO Lanjutan</option>
                                                </select>
                                            </div>
                                            <div class="position-relative text-center mb-3" style="display:none;"
                                                id="divlama_add">
                                                <select class="form-select form-select-sm text-theme text-center"
                                                    name="id_po_lama" id="id_po_lama_add">
                                                    <option value="" disabled selected>Pilih DATA PO</option>
                                                    @foreach ($get_Supplier_Order as $orders)
                                                        @foreach ($getsupplier as $supps)
                                                            @if ($supps->id_sup === $orders->id_sup)
                                                                <option value="{{ $orders->idpo }}">
                                                                    {{ $orders->tanggal }}
                                                                    -
                                                                    {{ $supps->supplier }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="position-relative text-center" style="display:none;"
                                                id="divbaru_add">
                                                <select class="form-select form-select-sm text-theme text-center"
                                                    name="id_sup" id="id_sup_add">
                                                    <option value="" disabled selected>Pilih Supplier</option>
                                                    @foreach ($getsupplier as $gets)
                                                        <option value="{{ $gets->id_sup }}">{{ $gets->supplier }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <script>
                                                function typepo_add() {
                                                    var select = document.getElementById('type_po_add');
                                                    var value = select.options[select.selectedIndex].value;

                                                    if (value == 'baru') {
                                                        document.getElementById("divbaru_add").style.display = 'block';
                                                        document.getElementById("divlama_add").style.display = 'none';
                                                    } else if (value == 'lama') {
                                                        document.getElementById("divbaru_add").style.display = 'none';
                                                        document.getElementById("divlama_add").style.display = 'block';
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row form-group">
                                        <div class="col-12 form-group position-relative mb-3">
                                            <label class="form-label">Variation</label>
                                            <select class="form-select form-select-sm text-theme fs-12px"
                                                id="type_variasi" name="type_variasi" required>
                                                <option value="" disabled selected>Pilih Variation</option>
                                                <option value="SNEAKERS UNISEX">Sneakers Unisex 35-45</option>
                                                <option value="CUSTOM">Custom</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                                Pilih supplier yang sesuai.
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div id="hasil_variation" style="text-align: center;"></div>
                                            <script>
                                                function addpo() {
                                                    var tbody = document.getElementById('tbody_item');
                                                    var row = tbody.insertRow(1);
                                                    var size = row.insertCell(0);
                                                    var qty = row.insertCell(1);
                                                    var aksi = row.insertCell(2);

                                                    size.innerHTML = "<input class='form-control' type='text' name='size[]' style='width: 100%;height:100%;'>";
                                                    qty.innerHTML =
                                                        "<input class='form-control' onkeypress='return isNumberKey(event)' type='text' name='qty[]' style='width: 100%;height:100%;'>";
                                                    aksi.innerHTML = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">X</button>';
                                                }

                                                function deleteRow(r) {
                                                    var i = r.parentNode.parentNode.rowIndex;
                                                    document.getElementById("variations").deleteRow(i);
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-1" align="right">
                                <button class="btn btn-theme" type="button" onclick="submitadd()">Save</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function isNumberKey(evt) {
                var aCode = event.which ? event.which : event.keyCode;
                if (aCode > 31 && (aCode < 48 || aCode > 57)) return false;
                return true;
            }

            function valids(e) {
                if (e.value > 0) {
                    return e.value = parseInt(e.value);
                } else {
                    return e.value = 0;
                }
            }
        </script>

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

        <div class="row" id="detail_repeat_order">
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
                    url: "{{ URL::to('/detail_repeat_order') }}",
                    data: {
                        id_ware: id_ware,
                    },
                    success: function(data) {
                        $("#detail_repeat_order").html(data);
                    }
                });
            }

            function submitadd() {
                if (document.forms["formadd"]["type_po_add"].value == "") {
                    alert("SILAHKAN PILIH TIPE PO, TERLEBIH DAHULU.");
                    document.forms["formadd"]["type_po_add"].focus();
                    return false;
                }

                if (document.forms["formadd"]["type_po_add"].value === "baru") {
                    if (document.forms["formadd"]["id_sup_add"].value == "") {
                        alert("SILAHKAN PILIH SUPPLIER, TERLEBI DAHULU.");
                        document.forms["formadd"]["id_sup_add"].focus();
                        return false;
                    }
                } else if (document.forms["formadd"]["type_po_add"].value === "lama") {
                    if (document.forms["formadd"]["id_po_lama_add"].value == "") {
                        alert("SILAHKAN PILIH PO LANJUTAN, TERLEBIH DAHULU.");
                        document.forms["formadd"]["id_po_lama_add"].focus();
                        return false;
                    }
                }

                document.getElementById("formadd").submit();
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
    @endsection

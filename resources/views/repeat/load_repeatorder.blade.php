<div class="row">
    <div class="col-xl-3">
        <div class="card">
            <div class="card-body  was-validated ">
                <div>
                    <input type="hidden" value="{{ $id_produk }}" name="id_produk">
                    <input type="hidden" value="{{ $id_area }}" name="id_area">
                    <input type="hidden" value="{{ $id_ware }}" name="id_ware">
                    <input type="hidden" value="{{ $produk }}" name="produk">
                    <input type="hidden" value="{{ $brand }}" name="brand">
                </div>

                <div class="position-relative text-center mb-3">
                    <select class="form-select form-select-sm text-theme text-center" name="type_po" id="type_po"
                        required onchange="typepo()">
                        <option value="" disabled selected>Tipe PO</option>
                        <option value="baru">PO Baru</option>
                        <option value="lama">PO Lanjutan</option>
                    </select>
                </div>
                <div class="position-relative text-center mb-3" style="display:none;" id="divlama">
                    <select class="form-select form-select-sm text-theme text-center" name="id_po_lama" id="id_po_lama">
                        <option value="" disabled selected>Pilih DATA PO</option>
                         @if (count($get_Supplier_Order) > 0)
                            @foreach ($get_Supplier_Order as $orders)
                                @foreach ($getsupplier as $supps)
                                    @if ($supps->id_sup === $orders->id_sup)
                                        <option value="{{ $orders->idpo }}">{{ $orders->tanggal }} -
                                            {{ $supps->supplier }} - {{ $orders->idpo }}
                                        </option>
                                    @endif
                                @endforeach
                            @endforeach
                         @endif

                    </select>
                </div>

                <div class="position-relative text-center" style="display:none;" id="divbaru">
                    <select class="form-select form-select-sm text-theme text-center" name="id_sup" id="id_sup">
                        <option value="" disabled selected>Pilih Supplier</option>
                        @if (count($getsupplier) > 0)
                            @foreach ($getsupplier as $gets)
                                <option value="{{ $gets->id_sup }}">{{ $gets->supplier }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <script>
                    function typepo() {
                        var select = document.getElementById('type_po');
                        var value = select.options[select.selectedIndex].value;

                        if (value == 'baru') {
                            document.getElementById("divbaru").style.display = 'block';
                            document.getElementById("divlama").style.display = 'none';
                        } else if (value == 'lama') {
                            document.getElementById("divbaru").style.display = 'none';
                            document.getElementById("divlama").style.display = 'block';
                        }
                    }
                </script>

                <div class="row mt-3">
                    <div class="col-4" align="center">
                        <label class="text-center fw-bold" style="padding-top: 5px;">Modal : </label>
                    </div>
                    <div class="col-8">
                      @if ($get_m_price->id_produk === $id_produk)
                                <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                    name="m_price" required placeholder="Silahkan masukan nama produk"
                                    value="@currency($get_m_price->m_price)" autocomplete="OFF" type-currency="IDR">
                            @endif      
                    </div>
                </div>

                <table class="table table-bordered table-sm mt-3 was-validated">
                    <thead>
                        <tr>
                            <th class="text-center text-white" style="height: 21px;">SIZE</th>
                            <th class="text-center text-white" style="height: 21px;">QTY</th>
                            <th class="text-center text-white" style="height: 21px;width: 40%;">QTY NEW</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($variationss) > 0)
                            @foreach ($variationss as $key => $value)
                                @if ($value->id_produk === $id_produk)
                                    <tr>
                                        <td>
                                            <input class="form-control text-center" type="text" name="size[]"
                                                value="{{ $value->size }}" readonly style="width: 100%;height: 21px;">
                                        </td>
                                        <td>
                                            <input class="form-control text-center fw-bold text-success" type="number"
                                                name="qty_old[]" value="{{ $value->qty }}" readonly
                                                style="width: 100%;height: 21px;">
                                        </td>
                                        <td>
                                            <input class="form-control text-center text-theme is-invalid" type="text"
                                                name="qty[]" value="0" min="0"
                                                onkeydown="return isNumberKey(event)" onkeyup="return valids(this)"
                                                style="width: 100%;height: 21px;font-weight: bold;" autocomplete="off"
                                                required>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            {{-- {{ $value->products[0]['category'] }} --}}
                        @else
                            @foreach ($variationss_default as $key => $values)
                                @if ($values->id_produk === $id_produk)
                                    <tr>
                                        <td>
                                            <input class="form-control text-center" type="text" name="size[]"
                                                value="{{ $values->size }}" readonly style="width: 100%;height: 21px;">
                                        </td>
                                        <td>
                                            <input class="form-control text-center fw-bold text-danger" type="number"
                                                name="qty_old[]" value="0" readonly
                                                style="width: 100%;height: 21px;">
                                        </td>
                                        <td>
                                            <input class="form-control text-center" type="text" name="qty[]"
                                                value="0" min="0" onkeydown="return isNumberKey(event)"
                                                onkeyup="return valids(this)"
                                                style="width: 100%;height: 21px;font-weight: bold;" autocomplete="off"
                                                required>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                            {{-- @php
                                $i = 0;
                                $sizes = 35;
                            @endphp
                            @while ($i < 11)
                                <tr>
                                    <td>
                                        <input class="form-control text-center" type="text" name="size[]"
                                            value="{{ $sizes + $i }}" readonly style="width: 100%;height: 21px;">

                        </td>
                        <td>
                            <input class="form-control text-center fw-bold text-danger" type="number" name="qty_old[]" value="0" readonly style="width: 100%;height: 21px;">
                        </td>
                        <td>
                            <input class="form-control text-center" type="text" name="qty[]" value="0" onkeydown="return isNumberKey(event)" onkeyup="return valids(this)" style="width: 100%;height: 21px;font-weight: bold;" autocomplete="off">
                        </td>
                        </tr>
                        @php $i++; @endphp
                        @endwhile --}}
                        @endif
                    </tbody>
                </table>
                <div class="form-group mt-3" align="right">
                    <button class="btn btn-theme" type="button" onclick="submitformedit()">Save</button>
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
    <div class="col-xl-9">
        <div class="card">
            <div class="card-body p-3" style="height: auto;">
                <div class="input-group mb-4">
                    <div class="flex-fill position-relative">
                        <div class="input-group">
                            <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                style="z-index: 1020;">
                                <i class="fa fa-search opacity-5"></i>
                            </div>
                            <input type="text" class="form-control ps-35px" id="search_tb_repeat"
                                placeholder="Search products.." />
                        </div>
                    </div>
                </div>
                <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_repeat">
                    <thead style="font-size: 11px;">
                        <tr>
                            <th class="text-center" width="30%" style="color: #a8b6bc !important;">DETAIL
                            </th>
                            <th class="text-center" width="30%" style="color: #a8b6bc !important;">AMOUNT
                            </th>
                            <th class="text-center" width="30%" style="color: #a8b6bc !important;">SIZE
                            </th>
                        </tr>
                    </thead>

                    <tbody style="font-size: 11px;">
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
    </div>
</div>


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

<script type="text/javascript">
    $(function() {
        var table = $('#tb_repeat').DataTable({
            lengthMenu: [3],
            responsive: true,
            processing: false,
            serverSide: true,
            ajax: "/table_detail_repeatorder/{{ $id_ware }}/{{ $id_produk }}",
            columns: [{
                    data: 'idpo',
                    name: 'idpo',
                    class: 'text-left fs-12px',
                    searchable: true,
                    "render": function(data, type, row, meta) {
                        if (row.suppliers_detail.length > 0) {
                            return 'TANGGAL <span style="padding-left: 18px;">:</span> <span class="fw-bold text-white">' +
                                row.tanggal +
                                '</span><br>ID PO <span style="padding-left: 41px;">:</span> <span class="fw-bold text-indigo">' +
                                row.idpo +
                                '</span><br>TIPE ORDER : <span class="fw-bold text-yellow">' +
                                row
                                .tipe_order +
                                '</span><br>SUPPLIER <span style="padding-left: 12px;">:</span> <span class="fw-bold text-white">' +
                                row
                                .suppliers_detail[0]['supplier'] +
                                '</span><br>QTY <span style="padding-left: 48px;">:</span> <span class="fw-bold text-white">' +
                                row
                                .qty +
                                '</span>';
                        } else {
                            return 'TANGGAL <span style="padding-left: 18px;">:</span> <span class="fw-bold text-white">' +
                                row.tanggal +
                                '</span><br>ID PO <span style="padding-left: 41px;">:</span> <span class="fw-bold text-indigo">' +
                                row.idpo +
                                '</span><br>TIPE ORDER : <span class="fw-bold text-yellow">' +
                                row
                                .tipe_order +
                                '</span><br>SUPPLIER <span style="padding-left: 12px;">:</span> <span class="fw-bold text-white">' +
                                row
                                .id_sup +
                                '</span><br>QTY <span style="padding-left: 48px;">:</span> <span class="fw-bold text-white">' +
                                row
                                .qty +
                                '</span>';
                        }

                    },
                },
                {
                    data: 'tanggal',
                    name: 'tanggal',
                    class: 'text-center fs-12px',
                    searchable: true,
                    "render": function(data, type, row, meta) {
                        let rupiah = Intl.NumberFormat('id-ID');

                        return 'MODAL &nbsp;&nbsp;: <span class="fw-bold text-success">Rp ' +
                            rupiah.format(row.m_price) +
                            '</span><br>SUBTOTAL : <span class="fw-bold text-success">Rp ' +
                            rupiah
                            .format(row.subtotal) +
                            '</span>';
                    },
                },
                {
                    data: 'supplier_variation',
                    name: 'supplier_variation',
                    class: 'text-center',
                    searchable: true,
                    "render": function(data, type, row) {
                        size = '';
                        length = data.length;
                        i = 0;
                        b = 1;
                        v = '';

                        while (i < length) {
                            if (row.id_ware === row.supplier_variation[
                                    i][
                                    'id_ware'
                                ] && row.id_produk === row.supplier_variation[i]['id_produk'] && row.id_act === row.supplier_variation[i]['id_act']) {
                                if (row.supplier_variation[i]['qty'] === '0') {
                                    size = size + '<span class="text-danger"> ' +
                                        '[' +
                                        row
                                        .supplier_variation[i]['size'] +
                                        '<span class="text-danger"> = </span><span class="text-danger fw-bold">' +
                                        row.supplier_variation[
                                            i][
                                            'qty'
                                        ] +
                                        '</span><span class="fw-bold text-danger">] </span>';

                                } else {
                                    size = size + '<span class="text-lime">' + '[' +
                                        row
                                        .supplier_variation[i]['size'] +
                                        '<span class="text-lime"> = </span><span class="text-lime fw-bold">' +
                                        row.supplier_variation[
                                            i][
                                            'qty'
                                        ] +
                                        '</span><span class="fw-bold text-lime">] </span>';
                                }
                                if (b === 4) {
                                    size = size + '<br>';
                                    b = 0;
                                }
                                b++;
                                v = '1';
                            }
                            i++;
                        }
                        if (v === '1') {
                            return size;
                        } else {
                            return '<span class="fw-bold text-warning">STOK TIDAK TERSEDIA</span>';
                        }
                    },
                },
            ],
            dom: 'tip',
            // "ordering" : true,
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                    orderable: false,
                    targets: []
                },

            ],
        });
        $('#search_tb_repeat').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
    // end
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

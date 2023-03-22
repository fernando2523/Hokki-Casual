<div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body p-3" style="height: auto;">
                <div class="input-group mb-4">
                    <div class="flex-fill position-relative">
                        <div class="input-group">
                            <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                style="z-index: 1020;">
                                <i class="fa fa-search opacity-5"></i>
                            </div>
                            <input type="text" class="form-control form-control-sm ps-35px"
                                id="search_product_transfer" placeholder="Search products.." />
                        </div>
                    </div>
                </div>
                <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_product_transfer">
                    <thead style="font-size: 11px;">
                        <tr>
                            <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO
                            </th>
                            <th class="text-center" width="2%" style="color: #a8b6bc !important;">IMAGE
                            </th>
                            <th class="text-center" width="40%" style="color: #a8b6bc !important;">NAME
                            </th>
                            <th class="text-center" width="10%" style="color: #a8b6bc !important;">WAREHOUSE
                            </th>
                            <th class="text-center" width="20%" style="color: #a8b6bc !important;">SIZE
                            </th>
                            <th class="text-center" width="7%" style="color: #a8b6bc !important;">ACT
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

    @include('productTransfer.detail')

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
            var table = $('#tb_product_transfer').DataTable({
                fixedHeader: {
                    header: false,
                    footer: true
                },
                lengthMenu: [10],
                responsive: true,
                processing: false,
                serverSide: true,
                ajax: "/tableproducttransfer/{{ $id_ware }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        class: 'text-center fw-bold',
                        searchable: false
                    }, {
                        data: 'id_produk',
                        name: 'id_produk',
                        class: 'text-center',
                        searchable: true,
                        "render": function(data, type, row) {
                            if (row.image_product[0]['img'] === "") {
                                return '<span><img src="/product/defaultimg.png" alt="" width="100" height="100" class="rounded"></span><span class="fw-bold text-default"><br>' +
                                    row
                                    .id_produk + '</span>';
                            } else {
                                return '<span><img src="/product/' + row.image_product[0]['img'] +
                                    '" alt="" width="95"  height="95" class="rounded"></span><span class="fw-bold text-default"><br>' +
                                    row
                                    .id_produk + '</span>';
                            }
                        },
                    }, {
                        data: 'produk',
                        name: 'produk',
                        class: 'text-left',
                        searchable: true,
                        "render": function(data, type, row, meta) {
                            return '<span class="fw-bold fs-14px text-white">' + row.produk +
                                '</span><br><span class="fw-bold"><span class="fw-bold text-white">' +
                                row
                                .category +
                                '</span>';
                        },
                    }, {
                        data: 'warehouse',
                        name: 'warehouse',
                        class: 'text-center',
                        searchable: false,
                        "render": function(data, type, row, meta) {
                            return '<span class="fw-bold text-indigo">' + row.warehouse[0][
                                    'warehouse'
                                ] +
                                '</span><br><span class="fw-bold">' + row
                                .quality +
                                '</span>';
                        },
                    }, {
                        data: 'product_variation2',
                        name: 'product_variation2',
                        class: 'text-center',
                        searchable: false,
                        // Edit Tian
                        "render": function(data, type, row) {
                            size = '';
                            length = data.length;
                            i = 0;
                            b = 1;
                            v = '';
                            total = 0;

                            while (i < length) {
                                if (row.warehouse[0]['id_ware'] === row.product_variation2[
                                        i][
                                        'id_ware'
                                    ]) {

                                    total = parseInt(total) + parseInt(row.product_variation2[i][
                                        'qty'
                                    ]);
                                    if (parseInt(row.product_variation2[i]['qty']) === 0) {
                                        size = size + '<span class="text-danger"> ' +
                                            '[' +
                                            row
                                            .product_variation2[i]['size'] +
                                            '<span class="text-danger"> = </span><span class="text-danger fw-bold">' +
                                            row.product_variation2[
                                                i][
                                                'qty'
                                            ] +
                                            '</span><span class="fw-bold text-danger">] </span>';

                                    } else {
                                        size = size + '<span class="text-lime">' + '[' +
                                            row
                                            .product_variation2[i]['size'] +
                                            '<span class="text-lime"> = </span><span class="text-lime fw-bold">' +
                                            row.product_variation2[
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
                                size = size +
                                    '<br><br><span class="fw-bold text-lime">Total QTY = ' +
                                    total + '</span>';

                                return size;
                            } else {
                                return '<span class="fw-bold text-warning">STOK TIDAK TERSEDIA</span>';
                            }
                        },
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'text-center fw-bold',
                        "render": function(data, type, row) {
                            return '<span><a class="text-lime" style="cursor: pointer;" onclick="openmodaldetail(' +
                                "'" + row.id + "'" +
                                ',' +
                                "'" + row.id_produk + "'" + ',' +
                                "'" + row.id_area + "'" + ',' +
                                "'" + row.id_ware + "'" + ',' +
                                "'" + row.produk + "'" + ',' + "'" + row.brand + "'" +
                                ',' + "'" + row.quality + "'" +
                                ',' + "'" + row.category + "'" +
                                ')"><i class="fas fa-xl bi bi-plus-square"></i></a>';
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
                        targets: [3]
                    },

                ],
            });
            $('#search_product_transfer').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
        // end
    </script>

    <script>
        // edit
        function openmodaldetail(id, id_produk, id_area, id_ware, produk, brand, quality, category) {
            $('#modaldetail').modal('show');
            $.ajax({
                type: 'POST',
                url: "{{ URL::to('/load_product_transfer') }}",
                data: {
                    id: id,
                    id_produk: id_produk,
                    id_area: id_area,
                    id_ware: id_ware,
                    produk: produk,
                    brand: brand,
                    quality: quality,
                    category: category,
                },
                success: function(data) {
                    $("#load_product_transfer").html(data);
                }
            });
        }

        function submitformdetail() {
            var count = document.forms["form_detail"]["count_qty"].value;
            var max = document.forms["form_detail"]["max"].value;
            var jumlah = 0;
            for (let index = 0; index < count; index++) {
                jumlah = jumlah + parseInt(document.forms["form_detail"]["qty[]"][index].value);
            }

            if (document.forms["form_detail"]["warehouse_tujuan"].value == "") {
                alert("SILAHKAN PILIH WAREHOSUE TUJUAN.");
                document.forms["form_detail"]["warehouse_tujuan"].focus();
                return false;
            }

            if (jumlah === 0) {
                alert('QTY Transfer Minimal 1');
            } else if (jumlah > max) {
                alert('QTY Transfer Melebihi Stock');
            } else {
                document.getElementById("form_detail").submit();
            }

        }
    </script>
</div>

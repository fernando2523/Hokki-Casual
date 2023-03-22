<div class="row">
    <!-- DATA ASSSET -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body p-3" style="height: auto;">
                <!-- BEGIN input-group -->
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
                <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_product">
                    <thead style="font-size: 11px;">
                        <tr>
                            <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO
                            </th>
                            <th class="text-left" width="25%" style="color: #a8b6bc !important;">NAME
                            </th>
                            </th>
                            <th class="text-center" width="8%" style="color: #a8b6bc !important;">ID PRODUCT
                            </th>
                            <th class="text-center" width="7%" style="color: #a8b6bc !important;">RELEASE
                            </th>
                            <th class="text-center" width="7%" style="color: #a8b6bc !important;">REPEAT
                            </th>
                            <th class="text-center" width="7%" style="color: #a8b6bc !important;">TRANSFER
                            </th>
                            <th class="text-center" width="7%" style="color: #a8b6bc !important;">SOLD
                            </th>
                            <th class="text-center" width="7%" style="color: #a8b6bc !important;">STOCK
                            </th>
                            <th class="text-center" width="10%" style="color: #a8b6bc !important;">ASSETS
                            </th>
                            <th class="text-center" width="3%" style="color: #a8b6bc !important;">ACT
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
    <!-- END -->
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
        var table = $('#tb_product').DataTable({
            lengthMenu: [10],
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: "/tableassets/{{ $id_ware }}",
            columns: [{
                data: 'DT_RowIndex',
                name: 'id',
                class: 'text-center fw-bold text-white',
                searchable: false
            }, {
                data: 'produk',
                name: 'produk',
                class: 'text-left text-white',
                searchable: true,
                "render": function(data, type, row) {
                    return '<span class="fw-bold">' + row.produk + '</span>';
                },
            }, {
                data: 'id_produk',
                name: 'id_produk',
                class: 'text-center fw-bold text-white',
                searchable: true,
            }, {
                data: 'supplier_order3',
                name: 'supplier_order3',
                class: 'text-center fw-bold text-white',
                searchable: true,
                "render": function(data, type, row) {
                    var release = 0;

                    for (let index = 0; index < data.length; index++) {
                        if ('{{ $id_ware }}' === 'all_ware') {
                            if (row.supplier_order3[index]['tipe_order'] == "RELEASE") {
                                release = release + parseInt(row.supplier_order3[index][
                                    'qty'
                                ]);
                            } else {
                                release = release + 0;
                            }
                        } else {
                            if (row.supplier_order3[index]['tipe_order'] == "RELEASE" && row
                                .supplier_order3[index]['id_ware'] == '{{ $id_ware }}'
                            ) {
                                release = release + parseInt(row.supplier_order3[index][
                                    'qty'
                                ]);
                            } else {
                                release = release + 0;
                            }
                        }
                    }

                    return release;
                },
            }, {
                data: 'supplier_order3',
                name: 'supplier_order3',
                class: 'text-center fw-bold text-white',
                searchable: true,
                "render": function(data, type, row) {
                    var repeat = 0;

                    for (let index = 0; index < data.length; index++) {
                        if ('{{ $id_ware }}' === 'all_ware') {
                            if (row.supplier_order3[index]['tipe_order'] == "REPEAT") {
                                repeat = repeat + parseInt(row.supplier_order3[index][
                                    'qty'
                                ]);
                            } else {
                                repeat = repeat + 0;
                            }
                        } else {
                            if (row.supplier_order3[index]['tipe_order'] == "REPEAT" && row
                                .supplier_order3[index]['id_ware'] == '{{ $id_ware }}'
                            ) {
                                repeat = repeat + parseInt(row.supplier_order3[index][
                                    'qty'
                                ]);
                            } else {
                                repeat = repeat + 0;
                            }
                        }


                    }

                    return repeat;
                },
            }, {
                data: 'supplier_order3',
                name: 'supplier_order3',
                class: 'text-center fw-bold text-white',
                searchable: true,
                "render": function(data, type, row) {
                    var repeat = 0;

                    for (let index = 0; index < data.length; index++) {
                        if ('{{ $id_ware }}' === 'all_ware') {
                            if (row.supplier_order3[index]['tipe_order'] == "TRANSFER") {
                                repeat = repeat + parseInt(row.supplier_order3[index][
                                    'qty'
                                ]);
                            } else {
                                repeat = repeat + 0;
                            }

                        } else {
                            if (row.supplier_order3[index]['tipe_order'] == "TRANSFER" &&
                                row
                                .supplier_order3[index]['id_ware'] == '{{ $id_ware }}'
                            ) {
                                repeat = repeat + parseInt(row.supplier_order3[index][
                                    'qty'
                                ]);
                            } else {
                                repeat = repeat + 0;
                            }

                        }
                    }

                    return repeat;
                },
            }, {
                data: 'sales',
                name: 'saless',
                class: 'text-center fw-bold text-yellow',
                searchable: true,
                "render": function(data, type, row) {
                    var sales = '';

                    if (row.sales.length > 0) {
                        for (let index = 0; index < data.length; index++) {
                            sales = sales + row.sales[index]['sold'];
                        }
                    } else {
                        sales = "0";
                    }

                    return sales;
                },
            }, {
                data: 'stock',
                name: 'stocks',
                class: 'text-center fw-bold text-success',
                searchable: true,
                "render": function(data, type, row) {
                    var stock = 0;

                    for (let index = 0; index < data.length; index++) {
                        if ('{{ $id_ware }}' === 'all_ware') {
                            stock = parseInt(stock) + parseInt(row.stock[index]['stock']);
                        } else {
                            if (row.stock[index]['id_ware'] == '{{ $id_ware }}') {
                                stock = parseInt(stock) + parseInt(row.stock[index]['stock']);
                            }
                        }

                    }

                    return stock;
                },
            }, {
                data: 'stock',
                name: 'assets',
                class: 'text-center fw-bold text-lime',
                searchable: true,
                "render": function(data, type, row) {
                    var stock = 0;

                    for (let index = 0; index < data.length; index++) {
                        for (let i = 0; i < row.details_po.length; i++) {
                            if ('{{ $id_ware }}' === 'all_ware') {
                                if (row.stock[index]['idpo'] === row.details_po[i][
                                        'idpo'
                                    ]) {
                                    stock = stock + parseInt(row.stock[index]['stock']) *
                                        parseInt(row
                                            .details_po[i]['m_price']);
                                }
                            } else {
                                if (row.stock[index]['idpo'] === row.details_po[i][
                                        'idpo'
                                    ] &&
                                    row.stock[index]['id_ware'] == '{{ $id_ware }}') {
                                    stock = stock + parseInt(row.stock[index]['stock']) *
                                        parseInt(row
                                            .details_po[i]['m_price']);
                                }
                            }
                        }
                    }

                    let rupiah = Intl.NumberFormat('id-ID');

                    return 'Rp' + rupiah.format(stock);
                },
            }, {
                data: 'action',
                name: 'action',
                class: 'text-center fw-bold',
                "render": function(data, type, row) {
                    return '<span><a class="text-theme" style="cursor: pointer;" onclick="openmodaldetail(' +
                        "'" + row.id_produk + "'" +
                        ')"><i class="fas fa-xl bi bi-eye-fill"></i></a>';
                },
            }, ],
            dom: 'tip',
            // "ordering" : true,
            order: [
                [0, 'desc']
            ],
            columnDefs: [
                // {
                //     orderable: false,
                //     targets: [3]
                // },
                // { "type": "num", "targets": 7 }

            ],
        });
        $('#search_product').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
    // end
</script>

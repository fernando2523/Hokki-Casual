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
                            <input type="text" class="form-control ps-35px" id="search_detail_asset"
                                placeholder="Search idpo.." />
                        </div>
                    </div>
                </div>
                <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_detail_asset">
                    <thead style="font-size: 11px;">
                        <tr>

                            <th class="text-left" width="30%" style="color: #a8b6bc !important;">PRODUK
                            </th>
                            <th class="text-center" width="10%" style="color: #a8b6bc !important;">TANGGAL
                            </th>
                            <th class="text-center" width="10%" style="color: #a8b6bc !important;">IDPO
                            </th>
                            <th class="text-center" width="20%" style="color: #a8b6bc !important;">SIZE
                            </th>
                            <th class="text-center" width="5%" style="color: #a8b6bc !important;">QTY
                            </th>
                            <th class="text-center" width="10%" style="color: #a8b6bc !important;">MODAL
                            </th>
                            <th class="text-center" width="10%" style="color: #a8b6bc !important;">TOTAL
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
            var table = $('#tb_detail_asset').DataTable({
                lengthMenu: [3],
                responsive: true,
                processing: false,
                serverSide: true,
                ajax: "/table_detail_asset/{{ $id_produk }}",
                columns: [{
                        data: 'produk',
                        name: 'produk',
                        class: 'text-left fs-12px fw-bold',
                        searchable: true,
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        class: 'text-center fw-bold',
                        searchable: true,
                    },
                    {
                        data: 'idpo',
                        name: 'idpo',
                        class: 'text-center fw-bold',
                        searchable: true,
                    },
                    {
                        data: 'supplier_variation2',
                        name: 'supplier_variation2',
                        class: 'text-center',
                        searchable: false,
                        "render": function(data, type, row) {
                            size = '';
                            length = data.length;
                            i = 0;
                            b = 1;

                            while (i < length) {
                                if (row.idpo === row.supplier_variation2[i][
                                        'idpo'
                                    ]) {
                                    if (row.supplier_variation2[i]['qty'] === '0') {
                                        size = size + '<span class="text-danger"> ' + '[' +
                                            row
                                            .supplier_variation2[i]['size'] +
                                            '<span class="text-danger"> = </span><span class="text-danger fw-bold">' +
                                            row.supplier_variation2[
                                                i][
                                                'qty'
                                            ] +
                                            '</span><span class="fw-bold text-danger">] </span>';

                                    } else {
                                        size = size + '<span class="text-lime">' + '[' + row
                                            .supplier_variation2[i]['size'] +
                                            '<span class="text-lime"> = </span><span class="text-lime fw-bold">' +
                                            row.supplier_variation2[
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
                                }
                                i++;
                            }
                            return size;
                        },
                    },
                    {
                        data: 'qty',
                        name: 'qty',
                        class: 'text-center fw-bold',
                        searchable: true,
                    },
                    {
                        data: 'm_price',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp '),
                        name: 'm_price',
                        class: 'text-center fw-bold',
                        searchable: true,
                    },
                    {
                        data: 'subtotal',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp '),
                        name: 'subtotal',
                        class: 'text-center fw-bold',
                        searchable: true,
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
            $('#detail_asset').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
        // end
    </script>

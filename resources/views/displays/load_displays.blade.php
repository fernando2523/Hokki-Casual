<table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_product">
    <thead style="font-size: 11px;">
        <tr>
            <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO
            </th>
            <th class="text-center" width="2%" style="color: #a8b6bc !important;">IMAGE
            </th>
            <th class="text-center" width="40%" style="color: #a8b6bc !important;">NAME
            </th>
            </th>
            <th class="text-center" width="10%" style="color: #a8b6bc !important;">DETAIL
            </th>
            <th class="text-center" width="10%" style="color: #a8b6bc !important;">DISPLAY
            </th>
            <th class="text-center" width="5%" style="color: #a8b6bc !important;">ACT
            </th>
        </tr>
    </thead>

    <tbody style="font-size: 11px;">
    </tbody>
</table>

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
            serverSide: true,
            ajax: "/tabledisplay/{{ $id_ware }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                    class: 'text-center fw-bold',
                    searchable: false
                }, {
                    data: 'image_product',
                    name: 'image_product',
                    class: 'text-center',
                    searchable: false,
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
                    "render": function(data, type, row) {
                        hasil = '';

                        hasil = hasil + '<span class="fw-bold fs-14px text-white">' + row
                            .produk +
                            '</span><br><span class="fw-bold"><span class="fw-bold">' +
                            row.brand +
                            '</span>';
                        return hasil;
                    },
                },
                {
                    data: 'quality',
                    name: 'quality',
                    class: 'text-center',
                    searchable: true,
                    "render": function(data, type, row) {
                        result = '';
                        for (let index = 0; index < row.store.length; index++) {
                            if (row.store[index]['id_store'] === '{{ $id_store }}') {
                                result = result + '<span class="fw-bold text-success">' + row
                                    .store[index]['store'] +
                                    '</span><br><span class="fw-bold">' + row
                                    .category +
                                    '</span><br><span class="fw-bold">' + row
                                    .quality +
                                    '</span>';
                            }
                        }

                        return result;
                    },
                },
                {
                    data: 'display',
                    name: 'display',
                    class: 'text-center',
                    searchable: false,
                    "render": function(data, type, row) {
                        result = '';
                        if (row.display.length > 0) {
                            for (let index = 0; index < row.display.length; index++) {
                                if (row.display[index]['id_store'] === '{{ $id_store }}' &&
                                    row
                                    .display[index]['id_produk'] === row.id_produk) {
                                    validate = row.display[index]['size'];
                                    id_display = row.display[index]['id'];
                                    break;
                                } else {
                                    validate = 0;
                                }
                            }

                            if (validate != 0) {
                                result =
                                    '<span class="badge bg-success" style="font-size:1em;">' +
                                    'DISPLAYED' + '</span><br><br>' +
                                    '<span class="badge bg-success" style="font-size:1em;">' +
                                    'Size = ' + validate + '</span>';


                                return result;
                            } else {
                                result =
                                    '<span class="badge bg-danger" style="font-size:1em;">' +
                                    'NOT DISPLAYED' + '</span>';

                                return result;
                            }

                        } else {
                            result =
                                '<span class="badge bg-danger" style="font-size:1em;">' +
                                'NOT DISPLAYED' + '</span>';

                            return result;
                        }
                    },
                },
                {
                    data: 'action',
                    name: 'action',
                    class: 'text-center fw-bold',
                    "render": function(data, type, row) {
                        result = '';
                        if (row.display.length > 0) {
                            for (let index = 0; index < row.display.length; index++) {
                                if (row.display[index]['id_store'] === '{{ $id_store }}' &&
                                    row
                                    .display[index]['id_produk'] === row.id_produk) {
                                    validate = row.display[index]['size'];
                                    id_display = row.display[index]['id'];
                                    break;
                                } else {
                                    validate = 0;
                                }
                            }

                            if (validate != 0) {
                                return '<span onclick="remove_display(' +
                                    "'" + id_display + "'" +
                                    ')"  style="cursor: pointer;"><a class="text-danger"><i class="fas fa-xl fa-remove"></i></a></span>';
                            } else {
                                return '<span onclick="modal_display(' +
                                    "'" + row.id_produk + "'" + ',' + "'" + row.id_area + "'" +
                                    ',' +
                                    "'" +
                                    row.id_ware + "'" + ',' + "'{{ $id_store }}'" + ',' +
                                    "'" +
                                    row.brand + "'" + ',' + "'" + row.produk + "'" + ',' +
                                    "'ADMIN'" +
                                    ')"><a class="text-primary" style="cursor: pointer;"><i class="fas fa-xl fa-edit"></i></a></span>';
                            }

                        } else {
                            return '<span onclick="modal_display(' +
                                "'" + row.id_produk + "'" + ',' + "'" + row.id_area + "'" +
                                ',' +
                                "'" +
                                row.id_ware + "'" + ',' + "'{{ $id_store }}'" + ',' +
                                "'" +
                                row.brand + "'" + ',' + "'" + row.produk + "'" + ',' +
                                "'ADMIN'" +
                                ')"><a class="text-primary" style="cursor: pointer;"><i class="fas fa-xl fa-edit"></i></a></span>';
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
                    targets: [4]
                },

            ],
        });

        $(document).ready(function() {
            var isAdmin = "{{ Auth::user()->role }}";
            if (isAdmin === "SUPER-ADMIN") {
                table.column(5).visible(true);
            } else if (isAdmin === "HEAD-AREA") {
                table.column(5).visible(true);
            } else if (isAdmin === "HEAD-STORE") {
                table.column(5).visible(true);
            } else {
                table.column(5).visible(false);
            }
        });

        $('#search_product').on('keyup', function() {
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

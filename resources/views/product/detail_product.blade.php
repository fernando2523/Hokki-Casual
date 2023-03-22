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
                <input type="text" class="form-control ps-35px" id="search_product" placeholder="Search products.." />
            </div>
        </div>
    </div>
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
                <th class="text-center" width="20%" style="color: #a8b6bc !important;">SIZE
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
                processing: true,
                serverSide: true,
                ajax: "/tableproduct/{{ $id_ware }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        class: 'text-center fw-bold',
                        searchable: false
                    }, {
                        data: 'id_produk',
                        name: 'id_produk',
                        class: 'text-center',
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
                            let rupiah = Intl.NumberFormat('id-ID');
                            retail = 0;
                            reseller = 0;
                            grosir = 0;
                            hasil = '';
                            if (row.id_area === row.areas[0]['id_area']) {
                                let retail = parseInt(row.n_price) + parseInt(row.areas[0][
                                    'up_price'
                                ]);
                                let reseller = parseInt(row.r_price) + parseInt(row.areas[0][
                                    'up_price'
                                ]);
                                let grosir = parseInt(row.g_price) + parseInt(row.areas[0][
                                    'up_price'
                                ]);

                                hasil = hasil + '<span class="fw-bold fs-14px text-white">' + row
                                    .produk +
                                    '</span><br><span class="fw-bold"><span class="fw-bold">' +
                                    row.brand +
                                    '</span><hr style="margin-top: 15px;margin-bottom: 17px;"><span class="fw-bold me-3 text-white text-opacity-75 fw-bold" style="font-size: 11px;" >RETAIL : ' +
                                    rupiah.format(retail) +
                                    '</span><span class="fw-bold me-3 text-yellow text-opacity-75 fw-bold" style="font-size: 11px;" >RESELLER : ' +
                                    rupiah.format(reseller) +
                                    '</span><span class="fw-bold text-info text-opacity-75 fw-bold" style="font-size: 11px;" >GROSIR : ' +
                                    rupiah.format(grosir) + '</span>';
                            }
                            return hasil;
                        },
                    },
                    {
                        data: 'quality',
                        name: 'quality',
                        class: 'text-center',
                        searchable: true,
                        "render": function(data, type, row, meta) {
                            return '<span class="fw-bold text-success">' + row
                                .warehouse[0]['warehouse'] +
                                '</span><br><span class="fw-bold">' + row
                                .category +
                                '</span><br><span class="fw-bold">' + row
                                .quality +
                                '</span>';
                        },
                    },
                    {
                        data: 'product_variation',
                        name: 'product_variation',
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
                                if (row.warehouse[0]['id_ware'] === row.product_variation[
                                        i][
                                        'id_ware'
                                    ]) {
                                    total = parseInt(total) + parseInt(row.product_variation[i][
                                        'qty'
                                    ]);
                                    if (parseInt(row.product_variation[i]['qty']) === 0) {
                                        size = size + '<span class="text-danger"> ' +
                                            '[' +
                                            row
                                            .product_variation[i]['size'] +
                                            '<span class="text-danger"> = </span><span class="text-danger fw-bold">' +
                                            row.product_variation[
                                                i][
                                                'qty'
                                            ] +
                                            '</span><span class="fw-bold text-danger">] </span>';

                                    } else {
                                        size = size + '<span class="text-lime">' + '[' +
                                            row
                                            .product_variation[i]['size'] +
                                            '<span class="text-lime"> = </span><span class="text-lime fw-bold">' +
                                            row.product_variation[
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
                            return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit(' +
                                "'" + row.id + "'" + ',' + "'" + row.id_produk + "'" + ',' + "'" +
                                row.produk + "'" + ',' + "'" + row
                                .brand + "'" + ',' + "'" + row.category + "'" + ',' + "'" + row
                                .quality + "'" + ',' + "'" + row
                                .r_price + "'" + ',' + "'" + row.n_price + "'" + ',' + "'" + row
                                .g_price + "'" +
                                ',' + "'" + row.id_ware + "'" +
                                ')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete(' +
                                "'" + row.id + "'" +
                                ',' + "'" + row.id_produk + "'" +
                                ')"><i class="fas fa-xl fa-times-circle"></i></a></span><br><br><span><a class="text-warning" style="cursor: pointer;text-decoration: none;" onclick="openmodalso(' +
                                "'" + row.id + "'" +
                                ',' + "'" + row.id_produk + "'" +
                                ',' + "'" + row.id_ware + "'" +
                                ')"><i class="bi fa-xl bi-box-arrow-in-right "></i> STOCK</a></span>';
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



    <script>
        // edit
        function openmodaledit(id, id_produk, produk, brand, category, quality, r_price, n_price,
            g_price, id_ware) {
            $('#modaledit').modal('show');
            document.getElementById('id').value = id;
            document.getElementById('id_produk').value = id_produk;

            document.getElementById('produk').value = produk;

            document.getElementById("branddefault").innerHTML = brand;
            document.getElementById("categorydefault").innerHTML = category;
            document.getElementById("qualitydefault").innerHTML = quality;

            var convert_r_price = r_price;
            var number_string = convert_r_price.toString(),
                sisa = number_string.length % 3,
                hasil_r_price = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '' : '';
                hasil_r_price += separator + ribuan.join('.');
            }

            var convert_n_price = n_price;
            var number_string = convert_n_price.toString(),
                sisa = number_string.length % 3,
                hasil_n_price = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '' : '';
                hasil_n_price += separator + ribuan.join('.');
            }

            var convert_g_price = g_price;
            var number_string = convert_g_price.toString(),
                sisa = number_string.length % 3,
                hasil_g_price = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '' : '';
                hasil_g_price += separator + ribuan.join('.');
            }

            document.getElementById('r_price').value = "Rp " + hasil_r_price;
            document.getElementById('n_price').value = "Rp " + hasil_n_price;
            document.getElementById('g_price').value = "Rp " + hasil_g_price;
            document.getElementById('id_ware').value = id_ware;

            $.ajax({
                type: 'POST',
                url: "{{ URL::to('/load_edit_variation') }}",
                data: {
                    id_ware: id_ware,
                    id_produk: id_produk
                },
                success: function(data) {
                    $("#edit_variation").html(data);
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ URL::to('/load_image') }}",
                data: {
                    id_produk: id_produk,
                },
                success: function(data) {
                    $("#edit_image").html(data);
                }
            });
        }

        function submitformedit() {
            var value = document.getElementById('id').value;
            document.getElementById('form_edit').action = "../product/editact/" + value;
            document.getElementById("form_edit").submit();
        }

        // delete
        function openmodaldelete(id, id_produk) {
            $('#modaldelete').modal('show');
            document.getElementById('del_id').value = id;
            document.getElementById('del_id_produk').value = id_produk;
        }

        function submitformdelete() {
            var value = document.getElementById('del_id').value;
            document.getElementById('form_delete').action = "../product/destroy/" + value;
            document.getElementById("form_delete").submit();
        }

        function submitformso() {
            var value = document.getElementById('so_id').value;
            document.getElementById('form_so').action = "../product/so_act/" + value;
            document.getElementById("form_so").submit();
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
</div>

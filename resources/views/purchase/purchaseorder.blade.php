@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">MANAGEMENT STOCK</a></li>
                    <li class="breadcrumb-item active">PURCHASE ORDER PAGE</li>
                </ul>

                <h1 class="page-header">
                    Purchase Order
                </h1>
            </div>
            <div class="ms-auto">
                <div class="mt-3">
                    <select class="form-select form-select-sm text-theme fw-bold" id="select_type" style="width: 200px;">
                        <option value="all_type" selected>ALL TYPE..</option>
                        <option value="RELEASE">RELEASE ORDER</option>
                        <option value="REPEAT">REPEAT ORDER</option>
                        <option value="TRANSFER">TRANSFER ORDER</option>
                        <option value="SO_GUDANG">STOCK OPNAME</option>
                    </select>
                </div>
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

            .thead-custom {
                font-size: 11px;
                background-color: darkslategray;
            }

            .tr-custom {
                border-left-width: 1px;
                border-right-width: 1px;
                border-bottom-width: 1px;
            }
        </style>
        <div class="modal fade" id="modaldetail" data-bs-backdrop="static" style="padding-top:12%;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">RINCIAN ORDER</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" enctype="multipart/form-data"
                        action="{{ url('/purchase/purchaseorder/store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-group" id="load_purchase_order">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mb-3" id="load_header">

        </div>

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3" style="height: auto;">
                        <!-- BEGIN input-group -->
                        <div class="input-group mb-2">
                            <div class="flex-fill position-relative">
                                <div class="input-group">

                                    <div style="width: 94%;margin-right:1%;">
                                        <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                            style="z-index: 1020;">
                                            <i class="fa fa-search opacity-5"></i>
                                        </div>
                                        <style>
                                            #search::-webkit-search-cancel-button {}
                                        </style>
                                        <input type="search" class="form-control ps-35px" id="search"
                                            placeholder="Search Data Purchase Order.." />
                                    </div>
                                    <div style="width: 5%;">
                                        <button type="button" id="btn_search" class="btn btn-theme">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .thead-custom {
                                font-size: 11px;
                                background-color: darkslategray;
                            }

                            .tr-custom {
                                font-size: 11px;
                                border-left-width: 1px;
                                border-right-width: 1px;
                                border-bottom-width: 1px;
                                border-top-width: 1px;
                            }
                        </style>
                        <div class="mt-2 mb-2" id="search_var" style="display: none;">
                            <button id="clear_search" class="btn btn-sm btn-theme ms-1 me-1">Clear Search</button>
                            <span>Searching : <span id="query_search"></span></span>
                        </div>
                        <table class="table-sm mb-0" style="width: 100%" data-search="true">
                            <thead class="thead-custom">
                                <tr class="text-white">
                                    <th class="text-center text-white" width="2%">NO
                                    </th>
                                    <th class="text-center text-white" width="50%">
                                        PRODUCT
                                    </th>
                                    @if (Auth::User()->role === 'SUPER-ADMIN' or Auth::User()->role === 'HEAD-AREA')
                                        <th class="text-center text-white" width="4%">ACT
                                        </th>
                                    @endif
                                    <th class="text-center text-white" width="5%">
                                        TYPE
                                    </th>
                                    <th class="text-center text-white" width="5%">
                                        WAREHOUSE
                                    </th>
                                    <th class="text-center text-white" width="10%">
                                        SUPPLIER
                                    </th>
                                    <th class="text-center text-white" width="3%">QTY
                                    </th>
                                    <th class="text-center text-white" width="10%">
                                        COST
                                    </th>
                                    <th class="text-center text-white" width="12%">SUB
                                        TOTAL
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tb_po">
                            </tbody>
                        </table>
                        <br>
                        <center>
                            {{-- <button type="button" class="btn btn-sm btn-outline-theme" id="load_more">Load
                                More</button> --}}
                            <input type="hidden" id="validate" value="0">
                        </center>
                    </div>
                    <!-- Data Loader -->
                    {{-- <div class="auto-load text-center">
                        <div class="spinner-border"></div>
                    </div> --}}
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

        <form class="was-validated" method="POST" action="/deleted_po">
            <input type="hidden" name="_method" value="PATCH">
            @csrf
            <div class="modal fade" id="modaldelete" data-bs-backdrop="static" style="padding-top:3%;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-warning">DELETE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center text-warning" style="padding-bottom: 0px;font-weight: bold;">
                            <p>Are You Sure Want To Delete This Item?</p>
                        </div>
                        <input type="hidden" id="d_idpo" name="d_idpo">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-outline-warning" type="submit">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form class="was-validated" method="POST" action="/deleteitem_po">
            @csrf
            <div class="modal fade" id="modalitemdelete" data-bs-backdrop="static" style="padding-top:3%;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-warning">DELETE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center text-warning" style="padding-bottom: 0px;font-weight: bold;">
                            <p>Are You Sure Want To Delete This Item?</p>
                        </div>
                        <input type="hidden" id="d_id" name="d_id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-outline-warning" type="submit">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal fade" id="showQty" data-bs-backdrop="static" style="margin-top:3%;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-success"><span id="name_produk"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center">
                        <div id="load_details">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-default" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="/edit_po">
            @csrf
            <div class="modal fade" id="editPo" data-bs-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title text-warning">Edit : <span id="name_produk_edit"></span></span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body text-center" style="padding-bottom: 0px;">
                            <div id="edit_details">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default"
                                data-bs-dismiss="modal">Cancel</button>
                            <button id="btn_edit" class="btn btn-outline-warning" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
            function deleteModal(idpo) {
                document.getElementById('d_idpo').value = idpo;
                $('#modaldelete').modal('show');
            }

            function deleteitemModal(id) {
                document.getElementById('d_id').value = id;
                $('#modalitemdelete').modal('show');
            }

            function showQty(id_produk, idpo, id_ware, produk, id_act) {
                $("#name_produk").html(produk);
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_details_po') }}",
                    data: {
                        id_produk: id_produk,
                        idpo: idpo,
                        id_ware: id_ware,
                        id_act: id_act
                    },
                    beforeSend: function() {
                        $("#load_details").html('<div class="spinner-border"></div>');
                    },
                    success: function(data) {
                        $("#load_details").html(data);
                    }
                });

                $('#showQty').modal('show');
            }

            function editPo(id_produk, idpo, id_ware, produk, id_act) {
                $("#name_produk_edit").html(produk);
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_edit_po') }}",
                    data: {
                        id_produk: id_produk,
                        idpo: idpo,
                        id_ware: id_ware,
                        id_act: id_act
                    },
                    beforeSend: function() {
                        $("#edit_details").html('<div class="spinner-border"></div>');
                        $("#btn_edit").prop("disabled", true);
                    },
                    success: function(data) {
                        $("#btn_edit").prop("disabled", false);
                        $("#edit_details").html(data);
                    }
                });

                $('#editPo').modal('show');
            }
        </script>

        @include('purchase.edit')

        <script>
            // edit
            function openmodaldetail(idpo, id_produk, id_ware, produk) {
                $('#modaldetail').modal('show');

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_purchase_order') }}",
                    data: {
                        idpo: idpo,
                        id_produk: id_produk,
                        id_ware: id_ware,
                        produk: produk,
                    },
                    success: function(data) {
                        $("#load_purchase_order").html(data);
                    }
                });
            }

            function openmodaledit(id, idpo, id_produk, id_ware, produk, id_sup, m_price, tipe_order) {
                $('#modaledit').modal('show');
                document.getElementById('e_id').value = id;

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/purchase_variation') }}",
                    data: {
                        idpo: idpo,
                        id_produk: id_produk,
                        id_ware: id_ware,
                        produk: produk,
                        id_sup: id_sup,
                        m_price: m_price,
                        tipe_order: tipe_order,
                    },
                    success: function(data) {
                        $("#purchase_edit").html(data);
                    }
                });
            }

            // delete
            function openmodaldelete(id, id_produk) {
                $('#modaldelete').modal('show');
                document.getElementById('del_id').value = id;
                document.getElementById('del_id_produk').value = id_produk;
            }

            function submitformdelete() {
                var value = document.getElementById('del_id').value;
                document.getElementById('form_delete').action = "../purchase/destroy/" + value;
                document.getElementById("form_delete").submit();
            }
        </script>

        {{-- Tb Load PO --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            var query_awal = '';
            var id_awal = 0;
            var type = $('#select_type').find(":selected").val();

            $(document).ready(function() {
                load_tb_po(query_awal, 1, id_awal, type);
                load_header_po(type);
            });

            $('#btn_search').click(function() {
                var query = $('#search').val();
                if (query != '') {
                    document.getElementById('validate').value = 0;
                    page = 1;
                    val_last = '';
                    load_tb_po(query, page, id_awal, type);
                    $("#search_var").css("display", "block");
                    $("#query_search").html(query);
                } else {
                    alert('Masukan Query Pencarian');
                }
            });

            $("#clear_search").click(function() {
                document.getElementById('validate').value = 0;
                page = 1;
                val_last = '';
                load_tb_po('', page, id_awal, type);
                $("#search_var").css("display", "none");
                $("#search").val('');
            });

            $("#select_type").change(function() {
                document.getElementById('validate').value = 0;
                page = 1;
                val_last = '';
                load_tb_po('', page, id_awal, $(this).val());
                load_header_po($(this).val());
                $("#search_var").css("display", "none");
                $("#search").val('');
            });

            function load_header_po(types) {
                $("#tb_po").html('');
                $.ajax({
                    type: 'GET',
                    url: "/load_header_po",
                    data: {
                        type: types
                    },
                    success: function(data) {
                        $("#load_header").html(data);
                    }
                });
            }

            function load_tb_po(querys, pages, start_data, types) {
                $("#tb_po").html('');
                $.ajax({
                    type: 'GET',
                    url: "/load_tb_po",
                    data: {
                        querys: querys,
                        last_id: start_data,
                        pages: pages,
                        type: types
                    },
                    beforeSend: function() {
                        $("#tb_po").html(
                            `<tr style="width:100%;">
                                <td colspan="8" align="center" style="padding: 30px 0px 20px 0px;">
                                    <div class="spinner-border"></div>
                                </td>
                            </tr>`);
                    },
                    success: function(data) {
                        $("#tb_po").html(data);
                    }
                });
            }

            var page = 1;
            var val_last = '';

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
                    var validate = document.getElementById('validate').value;
                    if (validate == '0' && val_last != 'last') {
                        document.getElementById('validate').value = 1;
                        index = parseInt(page) - 1;
                        page++;
                        var last_id = document.getElementsByName('last_id[]')[index].value;
                        val_last = last_id;
                        var query = $('#search').val();
                        if (val_last != 'last') {
                            loadmore_tb_po(query, page, last_id, type);
                        }
                    }
                }
            });

            function loadmore_tb_po(querys, pages, start_data, type) {
                $.ajax({
                        url: "/load_tb_po",
                        type: "GET",
                        data: {
                            querys: querys,
                            last_id: start_data,
                            pages: pages,
                            type: type
                        },
                        beforeSend: function() {
                            $('.auto-load').show();
                        }
                    })
                    .done(function(response) {
                        document.getElementById('validate').value = 0;
                        $("#tb_po").append(response);
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log('Server error occured');
                    });
            }
        </script>

        {{-- Tb Load PO --}}
    @endsection

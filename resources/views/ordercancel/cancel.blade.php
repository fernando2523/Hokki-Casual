@extends('layouts.main')
@section('container')
    <style>
        .badge3 {
            position: relative;
        }

        .badge3[data-badge]:after {
            content: attr(data-badge);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.5em;
            color: white;
            width: auto;
            height: auto;
            text-align: center;
            line-height: 18px;
            box-shadow: 0 0 1px #333;
        }

        .bg-loader {
            width: 100%;
            height: 100%;
            padding-top: 10%;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.332);
            z-index: 100028;
            display: none;
        }
    </style>
    <div id="loader" class="bg-loader">
        <div style="display: flex !important;margin:auto;" class="spinner-border"></div>
    </div>

    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">HISTORIES</a></li>
                    <li class="breadcrumb-item active">CANCEL ORDERS PAGE</li>
                </ul>

                <h1 class="page-header">
                    History Cancel Order
                </h1>
            </div>
            <div class="ms-auto">
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

        {{-- <div class="modal fade" id="modaladd" data-bs-backdrop="static" style="padding-top:6%;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">ADD EXPENSES</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" action="{{ url('/store_expense/store_expenses/store') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="row form-group">
                                <div class="col-12 form-group position-relative mb-3">
                                    <label class="form-label">Store</label>
                                    <select class="form-select form-select-sm text-theme" name="store" required>
                                        @if (Auth::user()->role === 'SUPER-ADMIN')
                                            <option value="" disabled selected>Pilih Store</option>
                                            @foreach ($getstore as $gets)
                                                <option value="{{ $gets->store }}">{{ $gets->store }}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach ($getstore as $gets)
                                                @if (Auth::user()->id_store === $gets->id_store)
                                                    <option value="{{ $gets->store }}">{{ $gets->store }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon pilih store yang sesuai.
                                    </div>
                                </div>
                                <hr style="margin-top: 25px;">

                                <div class="col-12 form-group mb-3 mt-1">
                                    <label class="form-label">Store Expenses</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                        name="item" required placeholder="Mohon di isi nama pengeluaran"
                                        autocomplete="OFF">
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Desc</label>
                                    <textarea class="form-control form-control-sm text-theme is-invalid" type="text" name="desc"
                                        placeholder="Opsional.." autocomplete="OFF" rows="2"></textarea>
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Total Price</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                        name="total_price" required placeholder="0" autocomplete="OFF" type-currency="IDR">
                                </div>
                            </div>
                            <div class="form-group mt-3" align="right">
                                <button class="btn btn-theme" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3">
                        <!-- BEGIN input-group -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1 text-danger">DATA CANCEL ORDER</span>
                            <a href="#" data-toggle="card-expand"
                                class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                        </div>
                        <div class="input-group mb-4">
                            <div class="flex-fill position-relative">
                                <div class="input-group">
                                    <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                        style="z-index: 1020;">
                                        <i class="fa fa-search opacity-5"></i>
                                    </div>
                                    <input type="text" class="form-control ps-35px" id="search_cancel"
                                        placeholder="Search.." />
                                </div>
                            </div>
                        </div>
                        <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_cancel">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">ID TRANSACTION
                                    </th>
                                    <th class="text-center" width="3%" style="color: #a8b6bc !important;">STORE
                                    </th>
                                    <th class="text-center" width="7%" style="color: #a8b6bc !important;">TANGGAL
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">WAREHOUSE
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">CUSTOMER
                                    </th>
                                    <th class="text-center" width="30%" style="color: #a8b6bc !important;">NOTA
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">USER
                                    </th>
                                    <th class="text-center" width="5%" style="color: #a8b6bc !important;">RINCIAN
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


        @csrf
        <div class="modal fade" id="modalrincian" data-bs-backdrop="static" style="padding-top:2%;">
            <div class="modal-dialog modal-xl">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Rincian Nota : &nbsp;</h5>
                        <h5 class="modal-title text-theme" id="id_transaction"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <center>

                        </center>
                        <div id="rincian_cancel">
                        </div>
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
                var table = $('#tb_cancel').DataTable({
                    lengthMenu: [10],
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    ajax: "/tablecancel",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id',
                            class: 'text-center fw-bold',
                            searchable: false
                        }, {
                            data: 'id_transaction',
                            name: 'id_transaction',
                            class: 'text-center fw-bold',
                            searchable: true
                        }, {
                            data: 'stores',
                            name: 'stores',
                            class: 'text-center fw-bold',
                            searchable: true,
                            "render": function(data, type, row) {
                                // return `<span class="badge3" data-badge="` +
                                //     row.stores[0]['store'] + "asdasdasd asdasd" +
                                //     `">
                        //     <img src="/order/black-square.jpg" alt="" width="100" height="100" class="rounded">
                        //     </span>`;
                                return '<span>' + row.stores[0]['store'] + '</span>';
                            },
                        }, {
                            data: 'tanggal',
                            name: 'tanggal',
                            class: 'text-center fw-bold',
                            searchable: true
                        }, {
                            data: 'warehouses',
                            name: 'warehouses',
                            class: 'text-center fw-bold',
                            searchable: true,
                            "render": function(data, type, row) {
                                return '<span>' + row.warehouses[0]['warehouse'] + '</span>';
                            },
                        }, {
                            data: 'customer',
                            name: 'customer',
                            class: 'text-center text-theme fw-bold',
                            searchable: true,
                            "render": function(data, type, row) {
                                if (row.customer === "RETAIL") {
                                    return '<span class="text-success">' + row.customer + '</span>';
                                } else {
                                    if (row.payment === "PAID") {
                                        return '<span class="text-yellow">' + row.customer +
                                            ' PAID</span>';
                                    } else if (row.payment === "PENDING") {
                                        return '<span class="text-danger">' + row.customer +
                                            ' PENDING</span>';
                                    }

                                }
                            },
                        }, {
                            data: 'id_invoice',
                            name: 'id_invoice',
                            class: 'text-center fw-bold',
                            searchable: true
                        },
                        {
                            data: 'users',
                            name: 'users',
                            class: 'text-center fw-bold',
                            searchable: true
                        },
                        {
                            data: 'action',
                            name: 'action',
                            class: 'text-center',
                            "render": function(data, type, row) {
                                return '<span><a class="text-info" style="cursor: pointer;margin-right: 10px;" onclick="openrincian(' +
                                    "'" + row.id_transaction + "'" +
                                    ',' +
                                    "'" + row.desc + "'" +
                                    ')"><i class="fas fa-xl bi bi-eye-fill"></i></a></span>';
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
                            targets: [5]
                        },

                    ],
                });

                $('#search_cancel').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
            // end
        </script>

        <script>
            function openrincian(id_transaction, desc) {
                $("#loader").css("display", "block");
                $('#modalrincian').modal('show');
                $("#rincian_cancel").html('');
                document.getElementById('id_transaction').innerHTML = id_transaction;
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/rincian_cancel') }}",
                    data: {
                        id_transaction: id_transaction,
                        desc: desc,
                    },
                    beforeSend: function(request) {},
                    success: function(data) {
                        $("#loader").css("display", "none");
                        $("#rincian_cancel").html(data);
                    }
                });

            }

            // function submitformedit() {
            //     var value = document.getElementById('e_id').value;
            //     document.getElementById('form_edit').action = "../ordercancel/editact/" + value;
            //     document.getElementById("form_edit").submit();
            // }
        </script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
        </script> --}}
    @endsection

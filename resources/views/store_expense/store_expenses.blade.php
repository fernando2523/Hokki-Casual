@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">STORE EXPENSES</a></li>
                    <li class="breadcrumb-item active">STORE EXPENSES PAGE</li>
                </ul>

                <h1 class="page-header">
                    Store Expenses
                </h1>
            </div>
            <div class="ms-auto">
                {{-- <a href="#" class="btn btn-outline-secondary"><i class="fa fa-upload fa-fw me-1 text-white"></i> Export
                    CSV</a> --}}
            </div>
            <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-theme" data-bs-toggle="modal"
                    data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Expenses</a></div>
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

        <div class="modal fade" id="modaladd" data-bs-backdrop="static" style="padding-top:6%;">
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
        </div>

        <div class="row mb-3">
            <!-- TOTAL STOCK -->
            <div class="col-xl-6 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                            <div class="mb-1">EXPENSES TODAY</div>
                            <h4 class="text-theme"><?= $count ?> Expenses</h4>
                        </div>
                        <div class="opacity-5">
                            <i class="bi bi-tags-fill fa-3x"></i>
                        </div>
                    </div>

                    <!-- card-arrow -->
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                </div>
            </div>
            <!-- END -->
            <div class="col-xl-6 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                            <div class="mb-1">AMOUNT EXPENSES TODAY</div>
                            <h4 class="text-theme">@currency($amounttoday)</h4>
                        </div>
                        <div class="opacity-5">
                            <i class="bi bi-cash-stack fa-3x"></i>
                        </div>
                    </div>

                    <!-- card-arrow -->
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3" style="height: 490px;">
                        <!-- BEGIN input-group -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">DATA EXPENSES</span>
                            <a href="#" data-toggle="card-expand"
                                class="text-white text-opacity-50 text-decoration-none"><i
                                    class="bi bi-fullscreen"></i></a>
                        </div>
                        <div class="input-group mb-4">
                            <div class="flex-fill position-relative">
                                <div class="input-group">
                                    <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                        style="z-index: 1020;">
                                        <i class="fa fa-search opacity-5"></i>
                                    </div>
                                    <input type="text" class="form-control ps-35px" id="search_expenses"
                                        placeholder="Search expenses.." />
                                </div>
                            </div>
                        </div>
                        <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_expenses">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                    <th class="text-center" width="8%" style="color: #a8b6bc !important;">DATE</th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">STORE</th>
                                    <th class="text-center" width="15%" style="color: #a8b6bc !important;">ITEM</th>
                                    <th class="text-center" width="35%" style="color: #a8b6bc !important;">DESC</th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">TOTAL
                                    </th>
                                    <th class="text-center" width="5%" style="color: #a8b6bc !important;">USERS</th>
                                    <th class="text-center" width="5%" style="color: #a8b6bc !important;">ACT</th>
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

        @include('store_expense.delete')
        @include('store_expense.edit')

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
                var table = $('#tb_expenses').DataTable({
                    lengthMenu: [10],
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    ajax: "/tableexpenses",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id',
                            class: 'text-center fw-bold',
                            searchable: false
                        }, {
                            data: 'tanggal',
                            name: 'tanggal',
                            class: 'text-center',
                            searchable: true
                        }, {
                            data: 'store',
                            name: 'store',
                            class: 'text-center text-theme fw-bold',
                            searchable: true
                        }, {
                            data: 'item',
                            name: 'item',
                            class: 'text-center',
                            searchable: true
                        },
                        {
                            data: 'desc',
                            name: 'desc',
                            class: 'text-center',
                            searchable: true,
                            "render": function(data, type, row) {
                                if (row.desc === "" || row.desc === null) {
                                    return '<span>-</span>';
                                } else {
                                    return '<span>' + row.desc + '</span>';
                                }

                            },
                        },
                        {
                            data: 'total_price',
                            render: $.fn.dataTable.render.number('.', ',', 0, 'Rp '),
                            name: 'total_price',
                            class: 'text-center fw-bold text-yellow',
                            searchable: true
                        },
                        {
                            data: 'users',
                            name: 'users',
                            class: 'text-center fw-bold text-theme',
                            searchable: true
                        },
                        {
                            data: 'action',
                            name: 'action',
                            class: 'text-center fw-bold',
                            "render": function(data, type, row) {
                                return '<span><a class="text-info" style="cursor: pointer;margin-right: 10px;" onclick="openmodaledit(' +
                                    "'" + row.id + "'" +
                                    ',' +
                                    "'" + row.id_costs + "'" +
                                    ',' +
                                    "'" + row.store + "'" +
                                    ',' +
                                    "'" + row.item + "'" +
                                    ',' +
                                    "'" + row.desc + "'" +
                                    ',' +
                                    "'" + row.total_price + "'" +
                                    ')"><i class="fas fa-xl fa-edit"></i></a><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete(' +
                                    "'" + row.id + "'" +
                                    ')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
                            },
                        },
                    ],
                    dom: 'tip',
                    // "ordering" : true,
                    order: [
                        [1, 'desc']
                    ],
                    columnDefs: [{
                            orderable: false,
                            targets: [4]
                        },

                    ],
                });

                $(document).ready(function() {
                    var isAdmin = "{{ Auth::user()->role }}";
                    if (isAdmin === "SUPER-ADMIN" || isAdmin === "HEAD-AREA" || isAdmin === "HEAD-STORE") {
                        table.column(7).visible(true);
                    } else {
                        table.column(7).visible(false);
                    }
                });

                $('#search_expenses').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
            // end
        </script>



        <script>
            // edit
            function openmodaledit(id, id_costs, store, item, desc, total_price) {
                $('#modaledit').modal('show');
                document.getElementById('e_id').value = id;
                document.getElementById('e_id_costs').value = id_costs;
                document.getElementById('e_item').value = item;
                document.getElementById('e_totalprice').value = total_price;

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/expense_select_store') }}",
                    data: {
                        store: store,
                    },
                    success: function(data) {
                        $("#expense_select_store").html(data);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/expense_desc') }}",
                    data: {
                        desc: desc,
                    },
                    success: function(data) {
                        $("#expense_desc").html(data);
                    }
                });
            }

            function submitformedit() {
                var value = document.getElementById('e_id').value;
                document.getElementById('form_edit').action = "../store_expenses/editact/" + value;
                document.getElementById("form_edit").submit();
            }

            // delete
            function openmodaldelete(id) {
                $('#modaldelete').modal('show');
                document.getElementById('del_id').value = id;
            }

            function submitformdelete() {
                var value = document.getElementById('del_id').value;
                document.getElementById('form_delete').action = "../store_expenses/destroy/" + value;
                document.getElementById("form_delete").submit();
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

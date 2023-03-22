@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">ACCOUNT</a></li>
                    <li class="breadcrumb-item active">SUPPLIER PAGE</li>
                </ul>

                <h1 class="page-header">
                    Supplier
                </h1>
            </div>
            <div class="ms-auto">
            </div>
            <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-theme" data-bs-toggle="modal"
                    data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Supplier</a></div>
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

        <div class="modal fade" id="modaladd" data-bs-backdrop="static" style="padding-top:12%;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">ADD SUPPLIER</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" action="{{ url('/supplier/suppliers/store') }}">
                        @csrf
                        <div class="modal-body">
                            <div>
                                <input id="users" type="hidden" class="validate" name="users"
                                    value="{{ Auth::user()->name }}">
                            </div>
                            <div class="row form-group">
                                <div class="col-6 form-group mb-3">
                                    <label class="form-label">Name Supplier</label>
                                    <input class="form-control formm-control-sm text-theme is-invalid" type="text"
                                        name="supplier" required placeholder="Please provide a name supplier"
                                        autocomplete="OFF">
                                </div>

                                <div class="col-6 form-group mb-3">
                                    <label class="form-label">No Telp</label>
                                    <input class="form-control formm-control-sm text-theme is-invalid" type="number"
                                        name="tlp" placeholder="Please provide a No Telp" autocomplete="OFF">
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

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3" style="height: 490px;">
                        <!-- BEGIN input-group -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">DATA SUPPLIER</span>
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
                                    <input type="text" class="form-control ps-35px" id="search_supplier"
                                        placeholder="Search supplier.." />
                                </div>
                            </div>
                        </div>
                        <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_supplier">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                    <th class="text-center" width="50%" style="color: #a8b6bc !important;">SUPPLIER</th>
                                    <th class="text-center" width="15%" style="color: #a8b6bc !important;">TELP</th>
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

        @include('supplier.delete')
        @include('supplier.edit')

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
                var table = $('#tb_supplier').DataTable({
                    lengthMenu: [10],
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    ajax: "/tablesupplier",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id',
                            class: 'text-center fw-bold',
                            searchable: false
                        },
                        {
                            data: 'supplier',
                            name: 'supplier',
                            class: 'text-center',
                            searchable: true
                        },
                        {
                            data: 'tlp',
                            name: 'tlp',
                            class: 'text-center',
                            searchable: true,
                            "render": function(data, type, row) {
                                if (row.tlp === null || row.tlp === "") {
                                    return '<span>-</span>';
                                } else {
                                    return '<span>' + row.tlp + '</span>';
                                }
                            },
                        },
                        {
                            data: 'action',
                            name: 'action',
                            class: 'text-center fw-bold',
                            "render": function(data, type, row) {
                                return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit(' +
                                    "'" + row.id + "'" + ',' + "'" + row.id_sup + "'" + ',' + "'" + row
                                    .supplier + "'" + ',' + "'" + row.tlp + "'" +
                                    ')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete(' +
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
                            targets: [2]
                        },

                    ],
                });

                $(document).ready(function() {
                    var isAdmin = "{{ Auth::user()->role }}";
                    if (isAdmin === "SUPER-ADMIN") {
                        table.column(3).visible(true);
                    } else {
                        table.column(3).visible(false);
                    }
                });

                $('#search_supplier').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
            // end
        </script>



        <script>
            // edit
            function openmodaledit(id, id_sup, supplier, tlp) {
                $('#modaledit').modal('show');


                document.getElementById('e_id').value = id;
                document.getElementById('e_id_sup').value = id_sup;
                document.getElementById('e_supplier').value = supplier;
                document.getElementById('e_tlp').value = tlp;
            }

            function submitformedit() {
                var value = document.getElementById('e_id').value;
                document.getElementById('form_edit').action = "../supplier/editact/" + value;
                document.getElementById("form_edit").submit();
            }

            // delete
            function openmodaldelete(id) {
                $('#modaldelete').modal('show');
                document.getElementById('del_id').value = id;
            }

            function submitformdelete() {
                var value = document.getElementById('del_id').value;
                document.getElementById('form_delete').action = "../supplier/destroy/" + value;
                document.getElementById("form_delete").submit();
            }
        </script>
    @endsection

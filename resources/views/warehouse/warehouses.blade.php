@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">WAREHOUSE STORE</a></li>
                    <li class="breadcrumb-item active">WAREHOUSE PAGE</li>
                </ul>

                <h1 class="page-header">
                    Warehouse
                </h1>
            </div>
            <div class="ms-auto">

            </div>
            <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-theme" data-bs-toggle="modal"
                    data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Warehouse</a></div>
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
                        <h5 class="modal-title text-theme">ADD WAREHOUSE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" id="form_add" method="POST"
                        action="{{ url('/warehouse/warehouses/store') }}">
                        @csrf
                        <div class="modal-body">
                            <link href="{{ URL::asset('/assets/plugins/select-picker/dist/picker.min.css') }}"
                                rel="stylesheet" />

                            <div class="row form-group">
                                <div class="col-12 form-group mb-3 position-relative">
                                    <label class="form-label">Area / Kota <span class="text-danger fw-bold">*</span></label>
                                    <select class="form-select text-theme selectpicker" name="id_area" id="id_area"
                                        required>
                                        <option value="" disabled selected hidden>Pilih Area</option>
                                        @foreach ($getarea as $gets)
                                            <option data-kota="{{ $gets->kota }}" value="{{ $gets->id_area }}">
                                                {{ $gets->kota }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="r_kota" id="r_kota">
                                    <div class="invalid-tooltip">
                                        Silahkan pilih area yang sesuai.
                                    </div>
                                </div>

                                <div class="col-12 form-group mb-3 mt-2">
                                    <label class="form-label">Nama Warehouse</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                        name="warehouse" id="warehouse" required
                                        placeholder="Silahkan masukan nama warehouse yang sesuai." autocomplete="OFF">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control form-control-sm text-theme is-invalid" type="text" name="address" id="address"
                                        required placeholder="Silahkan isi alamat warehouse yang sesuai." autocomplete="OFF" rows="2"></textarea>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="form-group mt-3" align="right">
                                <button class="btn btn-theme" type="button" onclick="saved()">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{ URL::asset('/assets/plugins/select-picker/dist/picker.min.js') }}"></script>
        <script>
            $('#id_area').picker({
                search: true,
            });

            $('#id_area').on('sp-change', function() {
                var kota = $('#id_area').find(":selected").data('kota');
                document.getElementById('r_kota').value = kota;
            });

            function saved() {
                var select = document.getElementById('id_area');
                var value = select.options[select.selectedIndex].value;

                if (value === "") {
                    alert("Mohon pilih Area / Kota yang sesuai.");
                    document.getElementById('id_area').focus();
                    return false;
                }
                if (document.forms["form_add"]["warehouse"].value === "") {
                    alert("Mohon masukan nama warehouse yang sesuai.");
                    document.forms["form_add"]["warehouse"].focus();
                    return false;
                }
                if (document.forms["form_add"]["address"].value === "") {
                    alert("Silahkan isi alamat warehouse yang sesuai.");
                    document.forms["form_add"]["address"].focus();
                    return false;
                }
                document.getElementById("form_add").submit();
            }
        </script>

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3" style="height: 490px;">
                        <!-- BEGIN input-group -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">DATA WAREHOUSE</span>
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
                                    <input type="text" class="form-control ps-35px" id="search_warehouse"
                                        placeholder="Search warehouse.." />
                                </div>
                            </div>
                        </div>
                        <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_warehouse">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                    <th class="text-center" width="20%" style="color: #a8b6bc !important;">AREA</th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">WAREHOUSE
                                    </th>
                                    <th class="text-center" width="35%" style="color: #a8b6bc !important;">ADDRESS
                                    </th>
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

        @include('warehouse.delete')
        @include('warehouse.edit')

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
                var table = $('#tb_warehouse').DataTable({
                    lengthMenu: [10],
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    ajax: "/tablewarehouse",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id',
                            class: 'text-center fw-bold',
                            searchable: false
                        },
                        {
                            data: 'area',
                            name: 'area',
                            class: 'text-center text-theme fw-bold',
                            searchable: false
                        },
                        {
                            data: 'warehouse',
                            name: 'warehouse',
                            class: 'text-center fw-bold text-white',
                            searchable: true
                        },
                        {
                            data: 'address',
                            name: 'address',
                            class: 'text-center',
                            searchable: true
                        },
                        {
                            data: 'action',
                            name: 'action',
                            class: 'text-center fw-bold',
                            "render": function(data, type, row) {
                                return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit(' +
                                    "'" + row.id + "'" + ',' + "'" + row.id_ware + "'" + ',' + "'" + row
                                    .warehouse + "'" + ',' + "'" + row.address + "'" +
                                    ',' + "'" + row.id_area + "'" +
                                    ',' + "'" + row.area + "'" +
                                    ')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete(' +
                                    "'" + row.id + "'" +
                                    ')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
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
                        table.column(4).visible(true);
                    } else {
                        table.column(4).visible(false);
                    }
                });

                $('#search_warehouse').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
            // end
        </script>



        <script>
            // edit
            function openmodaledit(id, id_ware, warehouse, address, id_area, area) {
                $('#modaledit').modal('show');

                document.getElementById('e_id').value = id;
                document.getElementById('e_id_ware').value = id_ware;
                document.getElementById('e_warehouse').value = warehouse;
                document.getElementById('e_address').value = address;

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/edit_select_ware') }}",
                    data: {
                        id_area: id_area,
                        area: area,
                    },
                    success: function(data) {
                        $("#edit_select_ware").html(data);
                    }
                });
            }

            function submitformedit() {
                var select = document.getElementById('e_id_area');
                var value = select.options[select.selectedIndex].value;

                if (value === "") {
                    alert("Mohon pilih Area / Kota yang sesuai.");
                    document.getElementById('e_id_area').focus();
                    return false;
                }
                if (document.forms["form_edit"]["e_warehouse"].value === "") {
                    alert("Mohon masukan nama warehouse yang sesuai.");
                    document.forms["form_edit"]["e_warehouse"].focus();
                    return false;
                }
                if (document.forms["form_edit"]["e_address"].value === "") {
                    alert("Silahkan isi alamat warehouse yang sesuai.");
                    document.forms["form_edit"]["e_address"].focus();
                    return false;
                }

                var value = document.getElementById('e_id').value;
                document.getElementById('form_edit').action = "../warehouse/editact/" + value;
                document.getElementById("form_edit").submit();
            }

            // delete
            function openmodaldelete(id) {
                $('#modaldelete').modal('show');
                document.getElementById('del_id').value = id;
            }

            function submitformdelete() {
                var value = document.getElementById('del_id').value;
                document.getElementById('form_delete').action = "../warehouse/destroy/" + value;
                document.getElementById("form_delete").submit();
            }
        </script>
    @endsection

@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">MANAGEMENT STOCK</a></li>
                    <li class="breadcrumb-item active">CATEGORY PAGE</li>
                </ul>

                <h1 class="page-header">
                    Category
                </h1>
            </div>
            <div class="ms-auto mt-3">
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

        <div class="modal fade" id="modaladd" data-bs-backdrop="static" style="padding-top:12%;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">ADD CATEGORY</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" enctype="multipart/form-data"
                        action="{{ url('/category/categories/store') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="row form-group">
                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Name Category</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                        name="category" required placeholder="Silahkan masukan nama category yang sesuai"
                                        autocomplete="OFF">
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

        <div class="modal fade" id="modaladdsub" data-bs-backdrop="static" style="padding-top:12%;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">ADD SUB CATEGORY</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" enctype="multipart/form-data"
                        action="{{ url('/category/categories/storeadd') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="row form-group">
                                <div class="col-12 form-group mb-3 position-relative">
                                    <label class="form-label">Category</label>
                                    <select class="form-select text-theme" name="id_cat" required>
                                        <option value="" disabled selected>Choose Category</option>
                                        @foreach ($getcategory as $gets)
                                            <option value="{{ $gets->id_cat }}">{{ $gets->category }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-tooltip">
                                        Silahkan pilih category yang sesuai.
                                    </div>
                                </div>
                                <div class="col-12 form-group mb-3 mt-3">
                                    <label class="form-label">Name Sub Category</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                        name="sub_category" required
                                        placeholder="Silahkan masukan nama sub category yang sesuai" autocomplete="OFF">
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
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body p-3" style="height: 390px;">
                        <!-- BEGIN input-group -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">DATA CATEGORY <a class="btn btn-sm btn-outline-indigo"
                                    data-bs-toggle="modal" data-bs-target="#modaladd"><i
                                        class="fa fa-plus-circle fa-fw me-1"></i> Add
                                    Category</a></span>
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
                                    <input type="text" class="form-control ps-35px" id="search_category"
                                        placeholder="Search category.." />
                                </div>
                            </div>
                        </div>
                        <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_category">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                    <th class="text-center" width="30%" style="color: #a8b6bc !important;">CATEGORY
                                    </th>
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">ACT</th>
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

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body p-3" style="height: 490px;">
                        <!-- BEGIN input-group -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">DATA SUB CATEGORY <a class="btn btn-sm btn-outline-theme"
                                    data-bs-toggle="modal" data-bs-target="#modaladdsub"><i
                                        class="fa fa-plus-circle fa-fw me-1"></i> Add
                                    Sub Category</a></span>
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
                                    <input type="text" class="form-control ps-35px" id="search_sub_category"
                                        placeholder="Search sub category.." />
                                </div>
                            </div>
                        </div>
                        <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_sub_category">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                    <th class="text-center" width="55%" style="color: #a8b6bc !important;">SUB
                                        CATEGORY</th>
                                    <th class="text-center" width="25%" style="color: #a8b6bc !important;">CATEGORY
                                    </th>
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">ACT</th>
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
        </div>

        @include('category.delete')
        @include('category.edit')
        @include('category.editsub')
        @include('category.deletesub')

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
                var table = $('#tb_category').DataTable({
                    lengthMenu: [5],
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    ajax: "/tablecategory",
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        class: 'text-center fw-bold',
                        searchable: false,
                    }, {
                        data: 'category',
                        name: 'category',
                        class: 'text-center',
                        searchable: true
                    }, {
                        data: 'action',
                        name: 'action',
                        class: 'text-center fw-bold',
                        "render": function(data, type, row) {
                            return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit(' +
                                "'" + row.id + "'" + ',' + "'" + row.id_cat + "'" + ',' + "'" +
                                row
                                .category + "'" +
                                ')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete(' +
                                "'" + row.id + "'" +
                                ')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
                        },
                    }, ],
                    dom: 'tip',
                    // "ordering" : true,
                    order: [
                        [0, 'desc']
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
                        table.column(2).visible(true);
                    } else {
                        table.column(2).visible(false);
                    }
                });

                $('#search_category').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
            // end
        </script>

        <script type="text/javascript">
            $(function() {
                var table = $('#tb_sub_category').DataTable({
                    lengthMenu: [10],
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    ajax: "/tablesubcategory",
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        class: 'text-center fw-bold',
                        searchable: false,
                    }, {
                        data: 'sub_category',
                        name: 'sub_category',
                        class: 'text-center',
                        searchable: true
                    }, {
                        data: 'category',
                        name: 'category',
                        class: 'text-center',
                        searchable: true
                    }, {
                        data: 'action',
                        name: 'action',
                        class: 'text-center fw-bold',
                        "render": function(data, type, row) {
                            return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit_sub(' +
                                "'" + row.id + "'" + ',' + "'" + row.id_catsub + "'" + ',' + "'" +
                                row
                                .sub_category + "'" + ',' + "'" + row.id_cat + "'" + ',' + "'" + row
                                .category + "'" +
                                ')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete_sub(' +
                                "'" + row.id + "'" +
                                ')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
                        },
                    }, ],
                    dom: 'tip',
                    // "ordering" : true,
                    order: [
                        [0, 'desc']
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

                $('#search_sub_category').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
            // end
        </script>



        <script>
            // edit
            function openmodaledit(id, id_cat, category) {
                $('#modaledit').modal('show');
                document.getElementById('e_id').value = id;
                document.getElementById('e_id_cat').value = id_cat;
                document.getElementById('e_category').value = category;
            }

            function submitformedit() {
                var value = document.getElementById('e_id').value;
                document.getElementById('form_edit').action = "../category/editact/" + value;
                document.getElementById("form_edit").submit();
            }

            // delete
            function openmodaldelete(id) {
                $('#modaldelete').modal('show');
                document.getElementById('del_id').value = id;
            }

            function submitformdelete() {
                var value = document.getElementById('del_id').value;
                document.getElementById('form_delete').action = "../category/destroy/" + value;
                document.getElementById("form_delete").submit();
            }

            // sub category
            function openmodaledit_sub(id, id_catsub, sub_category, id_cat, category) {
                $('#modaledit_sub').modal('show');
                document.getElementById('esub_id').value = id;
                document.getElementById('esub_id_catsub').value = id_catsub;
                document.getElementById('esub_sub_category').value = sub_category;

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/editselectcategory') }}",
                    data: {
                        id_cat: id_cat,
                        category: category,
                    },
                    success: function(data) {
                        $("#editselectcategory").html(data);
                    }
                });
            }

            function submitformedit_sub() {
                var value = document.getElementById('esub_id').value;
                document.getElementById('form_edit_sub').action = "../category/editactsub/" + value;
                document.getElementById("form_edit_sub").submit();
            }

            // delete
            function openmodaldelete_sub(id) {
                $('#modaldelete_sub').modal('show');
                document.getElementById('delsub_id').value = id;
            }

            function submitformdelete_sub() {
                var value = document.getElementById('delsub_id').value;
                document.getElementById('form_delete_sub').action = "../category/destroysub/" + value;
                document.getElementById("form_delete_sub").submit();
            }
        </script>
    @endsection

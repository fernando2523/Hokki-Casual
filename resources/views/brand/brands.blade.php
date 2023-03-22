@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">MANAGEMENT STOCK</a></li>
                    <li class="breadcrumb-item active">BRAND PAGE</li>
                </ul>

                <h1 class="page-header">
                    Brand
                </h1>
            </div>
            <div class="ms-auto">
            </div>
            <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-theme" data-bs-toggle="modal"
                    data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Brand</a></div>
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

        <div class="modal fade" id="modaladd" data-bs-backdrop="static" style="padding-top:10%;">
            <div class="modal-dialog modal-ml">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">ADD BRAND</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" enctype="multipart/form-data"
                        action="{{ url('/brand/brands/store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-12 mt-2 form-group position-relative mb-2 profile-img" align="center">
                                    <script type="text/javascript">
                                        var loadeditFile = function(event) {
                                            var previewimg = document.getElementById('previewimg');
                                            previewimg.src = URL.createObjectURL(event.target.files[0]);
                                        };
                                    </script>
                                    <img class="mb-2" id="previewimg" width="178px" src="/product/defaultimg.png">
                                    <input type="file" class="form-control form-control-sm" id="file" name="file"
                                        onchange="loadeditFile(event)">
                                </div>
                                <div class="card-arrow">
                                    <div class="card-arrow-top-left"></div>
                                    <div class="card-arrow-top-right"></div>
                                    <div class="card-arrow-bottom-left"></div>
                                    <div class="card-arrow-bottom-right"></div>
                                </div>
                                <div class="col-12 form-group mt-2 mb-2">
                                    <label class="form-label">Name Brand</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                        name="brand" required placeholder="Silahkan masukan nama brand yang sesuai."
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

        <script type="text/javascript">
            $('#file').change(function() {

                if (file === "") {
                    document.getElementById("previewimg").src = '/brand/defaultimg.png';
                } else {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#previewimg').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }

            });
        </script>

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3" style="height: 650px;">
                        <!-- BEGIN input-group -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">DATA BRAND</span>
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
                                    <input type="text" class="form-control ps-35px" id="search_brand"
                                        placeholder="Search brand.." />
                                </div>
                            </div>
                        </div>
                        <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_brand">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                    <th class="text-center" width="7%" style="color: #a8b6bc !important;">IMAGE</th>
                                    <th class="text-center" width="70%" style="color: #a8b6bc !important;">BRAND</th>
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

        @include('brand.delete')
        @include('brand.edit')

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
                var table = $('#tb_brand').DataTable({
                    lengthMenu: [5],
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    ajax: "/tablebrand",
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        class: 'text-center fw-bold',
                        searchable: false,
                    }, {
                        data: 'img',
                        name: 'img',
                        class: 'text-center',
                        "render": function(data, type, row) {
                            if (row.img === "") {
                                return '<span><img src="/brand/defaultimg.png" alt="" width="75" height="75" class="rounded"></span>';
                            } else {
                                return '<span><img src="/brand/' + row.img +
                                    '" alt="" width="75"  height="75" class="rounded"></span>';
                            }
                        },
                    }, {
                        data: 'brand',
                        name: 'brand',
                        class: 'text-center',
                        searchable: true
                    }, {
                        data: 'action',
                        name: 'action',
                        class: 'text-center fw-bold',
                        "render": function(data, type, row) {
                            return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit(' +
                                "'" + row.id + "'" + ',' + "'" + row.id_brand + "'" + ',' + "'" +
                                row
                                .brand + "'" + ',' + "'" + row.img + "'" +
                                ')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete(' +
                                "'" + row.id + "'" +
                                ',' +
                                "'" + row.img + "'" +
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
                            targets: [3]
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

                $('#search_brand').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
            // end
        </script>



        <script>
            // edit
            function openmodaledit(id, id_brand, brand, img) {
                $('#modaledit').modal('show');
                document.getElementById('e_id').value = id;
                document.getElementById('e_id_brand').value = id_brand;
                document.getElementById('e_brand').value = brand;

                if (img != "") {
                    document.getElementById("e_img").src = '../../brand/' + img;
                } else {
                    document.getElementById("e_img").src = '../../brand/defaultimg.png';
                }
            }

            // function submitformedit() {
            //     var value = document.getElementById('e_id').value;
            //     document.getElementById('form_edit').action = "../brand/editact/" + value;
            //     document.getElementById("form_edit").submit();
            // }

            // delete
            function openmodaldelete(id, img) {
                $('#modaldelete').modal('show');
                document.getElementById('del_id').value = id;
                document.getElementById('del_img').value = img;
            }

            function submitformdelete() {
                var value = document.getElementById('del_id').value;
                document.getElementById('form_delete').action = "../brand/destroy/" + value;
                document.getElementById("form_delete").submit();
            }
        </script>
    @endsection

@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">ACCOUNT</a></li>
                    <li class="breadcrumb-item active">RESELLER PAGE</li>
                </ul>

                <h1 class="page-header">
                    Reseller
                </h1>
            </div>
            <div class="ms-auto">
            </div>
            <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-theme" data-bs-toggle="modal"
                    data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Reseller</a></div>
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
                        <h5 class="modal-title text-theme">ADD RESELLER</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" enctype="multipart/form-data"
                        action="{{ url('/reseller/resellers/store') }}">
                        @csrf
                        <div class="modal-body">
                            <div>
                                <input type="hidden" class="validate" name="users" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="row form-group">

                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-12 mt-2 form-group position-relative mb-2 profile-img"
                                            align="center">
                                            <script type="text/javascript">
                                                var loadeditFile = function(event) {
                                                    var previewimg = document.getElementById('previewimg');
                                                    previewimg.src = URL.createObjectURL(event.target.files[0]);
                                                };
                                            </script>
                                            <img class="mb-2" id="previewimg" width="178px"
                                                src="/product/defaultimg.png">
                                            <input type="file" class="form-control" id="file" name="file"
                                                onchange="loadeditFile(event)">
                                        </div>
                                        <div class="card-arrow">
                                            <div class="card-arrow-top-left"></div>
                                            <div class="card-arrow-top-right"></div>
                                            <div class="card-arrow-bottom-left"></div>
                                            <div class="card-arrow-bottom-right"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-12 form-group mb-3">
                                            <label class="form-label">Name Reseller</label>
                                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                                name="nama" required placeholder="Please provide a name supplier"
                                                autocomplete="OFF">
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>

                                        <div class="col-12 form-group mb-3">
                                            <label class="form-label">No Telp</label>
                                            <input class="form-control form-control-sm text-theme is-invalid" type="number"
                                                name="tlp" placeholder="Please provide a No Telp" autocomplete="OFF">
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
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
                    document.getElementById("previewimg").src = '/reseller/defaultimg.png';
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
                    <div class="card-body p-3">
                        <!-- BEGIN input-group -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">DATA RESELLER</span>
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
                                    <input type="text" class="form-control ps-35px" id="search_reseller"
                                        placeholder="Search reseller.." />
                                </div>
                            </div>
                        </div>
                        <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_reseller">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-center" width="2%"
                                        style="color: #a8b6bc !important;font-size: 12px!important;">NO</th>
                                    <th class="text-center" width="7%" style="color: #a8b6bc !important;">IMAGE</th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">ID RESELLER
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">USERNAME
                                    </th>
                                    <th class="text-center" width="40%" style="color: #a8b6bc !important;">NAMA</th>
                                    <th class="text-center" width="12%" style="color: #a8b6bc !important;">TLP</th>
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

        @include('reseller.delete')
        @include('reseller.edit')
        @include('reseller.create')
        @include('reseller.delete_user')

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
                var table = $('#tb_reseller').DataTable({
                    lengthMenu: [5],
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    ajax: "/tablereseller",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id',
                            class: 'text-center fw-bold fs-14px',
                            searchable: false
                        },
                        {
                            data: 'img',
                            name: 'img',
                            class: 'text-center',
                            "render": function(data, type, row) {
                                if (row.img === "") {
                                    return '<span><img src="/reseller/defaultimg.png" alt="" width="75" height="75" class="rounded"></span>';
                                } else {
                                    return '<span><img src="/reseller/' + row.img +
                                        '" alt="" width="75"  height="75" class="rounded"></span>';
                                }
                            },
                        },
                        {
                            data: 'id_reseller',
                            name: 'id_reseller',
                            class: 'text-center text-theme fw-bold',
                            searchable: false
                        },
                        {
                            data: 'users',
                            name: 'users',
                            class: 'text-center text-warning fw-bold',
                            searchable: false,
                            "render": function(data, type, row) {
                                isi = '';
                                hasil = row.users.length;

                                if (hasil === 0) {
                                    isi =
                                        '<span>' + row.username +
                                        '</span><a class="btn btn-success btn-sm d-block" style="cursor: pointer;margin-right: 20px;margin-left: 20px;" onclick="openmodalcreate(' +
                                        "'" + row.id + "'" + ',' +
                                        "'" + row.username + "'" + ',' +
                                        "'" + row.nama + "'" + ',' +
                                        "'" + row.img + "'" +
                                        ')"><i class="fa fa-check fa-fw"></i> Active</a > '
                                } else {
                                    isi =
                                        '<span>' + row.username +
                                        '</span><a class="btn btn-danger btn-sm d-block" align="center" style="cursor: pointer;margin-right: 20px;margin-left: 20px;" onclick="openmodaldeleteuser(' +
                                        "'" + row.id + "'" + ',' +
                                        "'" + row.username + "'" +
                                        ')"><i class="fa fa-times fa-fw"></i> Disable</a>'
                                }

                                return isi;
                            },
                        },
                        {
                            data: 'nama',
                            name: 'nama',
                            class: 'text-center  fw-bold',
                            searchable: true
                        },
                        {
                            data: 'tlp',
                            name: 'tlp',
                            class: 'text-center  fw-bold',
                            searchable: false
                        },
                        {
                            data: 'action',
                            name: 'action',
                            class: 'text-center fw-bold',
                            "render": function(data, type, row) {
                                return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit(' +
                                    "'" + row.id + "'" + ',' + "'" + row.id_reseller + "'" + ',' + "'" +
                                    row.nama + "'" + ',' + "'" + row.tlp + "'" + ',' + "'" + row.img +
                                    "'" +
                                    ')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete(' +
                                    "'" + row.id + "'" +
                                    ',' +
                                    "'" + row.img + "'" +
                                    ')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
                            },
                        },
                    ],
                    dom: 'tip',
                    // "ordering" : true,
                    order: [
                        [2, 'desc']
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
                        table.column(6).visible(true);
                    } else {
                        table.column(6).visible(false);
                    }
                });


                $('#search_reseller').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
            // end
        </script>



        <script>
            // edit
            function openmodaledit(id, id_reseller, nama, tlp, img) {
                $('#modaledit').modal('show');
                document.getElementById('e_id').value = id;
                document.getElementById('e_id_reseller').value = id_reseller;
                document.getElementById('e_nama').value = nama;
                document.getElementById('e_tlp').value = tlp;

                if (img == "") {
                    document.getElementById("e_img").src = '../../reseller/defaultimg.png';
                } else {
                    document.getElementById("e_img").src = '../../reseller/' + img;
                }
            }

            function submitformedit() {
                var value = document.getElementById('e_id').value;
                document.getElementById('form_edit').action = "../resellers/editact/" + value;
                document.getElementById("form_edit").submit();
            }

            // delete
            function openmodaldelete(id, img) {
                $('#modaldelete').modal('show');
                document.getElementById('del_id').value = id;
                document.getElementById('del_img').value = img;
            }

            function submitformdelete() {
                var value = document.getElementById('del_id').value;
                document.getElementById('form_delete').action = "../resellers/destroy/" + value;
                document.getElementById("form_delete").submit();
            }

            function openmodalcreate(id, username, nama, img) {
                $('#modalcreate').modal('show');
                document.getElementById('id').value = id;
                document.getElementById('email').value = username;
                document.getElementById('nama').value = nama;
                document.getElementById('imgs').value = img;
            }

            function submitformcreate() {
                document.getElementById('form_create').action = "/register";
                document.getElementById("form_create").submit();
            }

            function openmodaldeleteuser(id, username) {
                $('#modaldeleteuser').modal('show');
                document.getElementById('delu_id').value = id;
                document.getElementById('delu_username').value = username;
            }

            function submitformdeleteuser() {
                var value = document.getElementById('delu_id').value;
                document.getElementById('form_deleteuser').action = "../resellers/destroy_user/" + value;
                document.getElementById("form_deleteuser").submit();
            }
        </script>
    @endsection

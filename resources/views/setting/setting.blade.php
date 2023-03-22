@extends('layouts.main')
@section('container')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN container -->
        <div class="container">
            <!-- BEGIN row -->
            <div class="row justify-content-center">
                <!-- BEGIN col-10 -->
                <div class="col-xl-10">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-9 -->
                        <div class="col-xl-9">
                            <!-- BEGIN #general -->
                            <div class="mb-5">
                                <h4><i class="far fa-user fa-fw text-theme"></i> General Setting</h4>
                                <p>View and update your general account information and settings.</p>
                                <div class="card">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex align-items-center">
                                            <div class="flex-1 text-break">
                                                <div>USERNAME</div>
                                                <div class="text-white text-opacity-50">{{ Auth::user()->email }}</div>
                                            </div>
                                        </div>
                                        <div class="list-group-item d-flex align-items-center">
                                            <div class="flex-1 text-break">
                                                <div>Name</div>
                                                <div class="text-white text-opacity-50">{{ Auth::user()->name }}</div>
                                            </div>
                                        </div>

                                        <div class="list-group-item d-flex align-items-center">
                                            <div class="flex-1 text-break text-theme">
                                                <div>Update</div>
                                                <div class="text-opacity-50 text-theme">
                                                    Your Personal Data.
                                                </div>
                                                {{-- <div>Password</div>
                                            <div class="text-white text-opacity-50">******************</div> --}}
                                            </div>
                                            <div>
                                                @foreach ($datas as $data)
                                                    <a class="btn btn-outline-theme w-150px" style="cursor: pointer;"
                                                        onclick="openmodaledit('{{ $data->id }}','{{ $data->name }}','{{ $data->email }}')">Update
                                                        Data</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-arrow">
                                        <div class="card-arrow-top-left"></div>
                                        <div class="card-arrow-top-right"></div>
                                        <div class="card-arrow-bottom-left"></div>
                                        <div class="card-arrow-bottom-right"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END #general -->

                            <!-- BEGIN #resetSettings -->
                            <div class="mb-5">
                                <div class="card">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex align-items-center">
                                            <div class="flex-1 text-break text-warning">
                                                <div>Password</div>
                                                <div class="text-warning text-opacity-50">
                                                    *********************
                                                </div>
                                            </div>
                                            <div>
                                                @foreach ($datas2 as $data2)
                                                    <a class="btn btn-outline-warning w-150px" style="cursor: pointer;"
                                                        onclick="openmodalpassword('{{ $data2->id }}')">New
                                                        Password</a>
                                                @endforeach
                                            </div>
                                        </div>
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
                        <!-- END col-9-->
                        <!-- BEGIN col-3 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END col-10 -->
            </div>
            <!-- END row -->
        </div>
        <!-- END container -->
    </div>
    <!-- END #content -->
    @include('setting.edit')
    @include('setting.password')

    <script>
        // edit
        function openmodaledit(id, name, email) {
            $('#modaledit').modal('show');
            document.getElementById('id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('email').value = email;
        }

        function submitformedit() {
            var value = document.getElementById('id').value;
            document.getElementById('form_edit').action = "../setting/editsetting/" + value;
            document.getElementById("form_edit").submit();
        }

        function openmodalpassword(id) {
            $('#modalpassword').modal('show');
            document.getElementById('pass_id').value = id;
        }

        function submitformpassword() {
            if (document.forms["form_password"]["password_new"].value == "") {
                alert("Password Required !! Cannot Null");
                document.forms["form_password"]["password_new"].focus();
                return false;
            }

            var value = document.getElementById('pass_id').value;
            document.getElementById('form_password').action = "../setting/changepassword/" + value;
            document.getElementById("form_password").submit();
        }
    </script>
@endsection

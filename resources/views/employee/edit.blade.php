<meta name="csrf-token" content="{{ csrf_token() }}">
<form id="form_edit" class="was-validated" enctype="multipart/form-data" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:3%;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">EDIT EMPLOYEE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <input type="hidden" id="e_id" name="e_id">
                    </div>
                    <div class="row form-group">
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12 mt-2 form-group position-relative mb-2 profile-img" align="center">
                                    <script type="text/javascript">
                                        var loadeditFile2 = function(event) {
                                            var e_img = document.getElementById('e_img');
                                            e_img.src = URL.createObjectURL(event.target.files[0]);
                                        };
                                    </script>
                                    <img class="mb-2" id="e_img" width="180px" src="/product/defaultimg.png">
                                    <input type="file" class="form-control" name="file"
                                        onchange="loadeditFile2(event)">
                                </div>
                                <div class="card-arrow">
                                    <div class="card-arrow-top-left"></div>
                                    <div class="card-arrow-top-right"></div>
                                    <div class="card-arrow-bottom-left"></div>
                                    <div class="card-arrow-bottom-right"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-8 mt-1">
                            <div class="row">
                                <div class="col-6 form-group position-relative mb-3">
                                    <label class="form-label">Username</label>
                                    <input class="form-control formm-control-sm text-theme is-invalid" type="text"
                                        name="e_username" id="e_username" required
                                        placeholder="Silahkan masukan username" autocomplete="OFF">
                                </div>
                                <div class="col-6 form-group position-relative mb-3">
                                    <label class="form-label">Nama</label>
                                    <input class="form-control formm-control-sm text-theme is-invalid" type="text"
                                        name="e_name" id="e_name" required placeholder="Silahkan masukan nama"
                                        autocomplete="OFF">
                                </div>
                                <div class="col-6 form-group mb-3">
                                    <label class="form-label">Telepon</label>
                                    <input class="form-control formm-control-sm text-theme is-invalid" type="number"
                                        name="e_tlp" id="e_tlp" placeholder="Opsional.." autocomplete="OFF">
                                </div>
                                <div class="col-6 form-group mb-2">
                                    <label class="form-label">Domisili <small
                                            class="text-warning">(kota)</small></label>
                                    <input class="form-control formm-control-sm text-theme is-invalid" type="text"
                                        name="e_domisili" id="e_domisili" placeholder="domisili" autocomplete="OFF"
                                        required>
                                </div>
                                <div id="selectrole" class="col-6 form-group position-relative mb-2">

                                </div>
                                <div id="load_editstores" class="col-6 form-group position-relative mb-3">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="submit" onclick="submitformedit()">Save</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#file').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#e_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
</form>
<script>
    // CSRF for all ajax call
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

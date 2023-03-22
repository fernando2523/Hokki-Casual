<form id="form_edit" class="was-validated" enctype="multipart/form-data" method="POST" action="{{ url('/brand/editact') }}">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:7%;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">EDIT BRAND</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <input type="hidden" id="e_id" name="e_id">
                        <input type="hidden" id="e_id_brand" name="e_id_brand">
                    </div>

                    <div class="row form-group">
                        <div class="col-12 mt-2 form-group position-relative mb-2 profile-img" align="center">
                            <script type="text/javascript">
                                var loadeditFile2 = function(event) {
                                    var e_img = document.getElementById('e_img');
                                    e_img.src = URL.createObjectURL(event.target.files[0]);
                                };
                            </script>
                            <img class="mb-2" id="e_img" width="178px" src="/product/defaultimg.png">
                            <input type="file" class="form-control form-control-sm" id="file" name="file"
                                onchange="loadeditFile2(event)">
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
                                name="e_brand" id="e_brand" required
                                placeholder="Silahkan masukan nama brand yang sesuai." autocomplete="OFF">
                        </div>
                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="submit">Save</button>
                    </div>

                </div>
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
                    $('#e_img').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }

        });
    </script>
</form>

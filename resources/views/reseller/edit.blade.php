<form id="form_edit" class="was-validated" enctype="multipart/form-data" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:7%;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">EDIT RESELLER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body was-validated">
                    <div>
                        <input type="hidden" id="e_id">
                        <input type="hidden" id="e_id_reseller" name="e_id_reseller">
                        {{-- <input type="hidden" id="e_img2" name="e_img2"> --}}
                    </div>

                    <div class="row form-group">
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12 mt-2 form-group position-relative mb-2 profile-img" align="center">
                                    <script type="text/javascript">
                                        var loadeditFile = function(event) {
                                            var e_img = document.getElementById('e_img');
                                            e_img.src = URL.createObjectURL(event.target.files[0]);
                                        };
                                    </script>
                                    <img class="mb-2" id="e_img" width="178px" src="/reseller/defaultimg.png">
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
                                        name="e_nama" id="e_nama" required
                                        placeholder="Please provide a name supplier" autocomplete="OFF">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">No Telp</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="number"
                                        name="e_tlp" id="e_tlp" placeholder="Please provide a No Telp"
                                        autocomplete="OFF">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="button" onclick="submitformedit()">Save</button>
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

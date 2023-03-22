<form id="form_password" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modalpassword" data-bs-backdrop="static" style="padding-top:3%;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">UPDATE PASSWORD</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <input type="hidden" id="pass_id">
                    </div>

                    <div class="row form-group">
                        <div class="col-12 form-group mb-3 text-center">
                            <label class="form-label">New Password</label>
                            <input id="password_new" type="text"
                                class="form-control form-control-lg bg-white bg-opacity-5" name="password_new" required
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="button" onclick="submitformpassword()">Save</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>

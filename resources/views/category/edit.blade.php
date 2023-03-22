<form id="form_edit" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:12%;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">EDIT CATEGORY</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <input type="hidden" id="e_id">
                        <input type="hidden" id="e_id_cat" name="e_id_cat">
                    </div>

                    <div class="row form-group">

                        <div class="row form-group">
                            <div class="col-12 form-group mb-3">
                                <label class="form-label">Name Category</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                    name="e_category" id="e_category" required
                                    placeholder="Please provide a name category" autocomplete="OFF">
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
</form>

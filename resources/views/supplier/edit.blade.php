<form id="form_edit" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:12%;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">EDIT SUPPLIER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <input type="hidden" id="e_id">
                        <input type="hidden" id="e_id_sup" name="e_id_sup">
                    </div>

                    <div class="row form-group">
                        <div class="col-6 form-group mb-3">
                            <label class="form-label">Name Supplier</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text"
                                name="e_supplier" id="e_supplier" required placeholder="Please provide a name supplier"
                                autocomplete="OFF">
                        </div>

                        <div class="col-6 form-group mb-3">
                            <label class="form-label">No Telp</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="number"
                                name="e_tlp" id="e_tlp" placeholder="Please provide a No Telp" autocomplete="OFF">
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

<form id="form_edit_sub" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaledit_sub" data-bs-backdrop="static" style="padding-top:12%;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">EDIT SUB CATEGORY</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <input type="hidden" id="esub_id">
                        <input type="hidden" id="esub_id_catsub" name="esub_id_catsub">
                        <input type="hidden" id="esub_id_cat" name="esub_id_cat">
                    </div>

                    <div class="row form-group">

                        <div class="col-12 form-group mb-3 position-relative">
                            <label class="form-label">Category</label>
                            <select class="form-select text-theme" name="esub_id_cat" required>
                                <option id="esub_default_category" disabled selected>Choose Category</option>
                                @foreach ($getcategory as $gets)
                                    <option value="{{ $gets->id_cat }}">{{ $gets->category }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Category.
                            </div>
                        </div>
                        <div class="col-12 form-group mb-3 mt-3">
                            <label class="form-label">Name Sub Category</label>
                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                name="esub_sub_category" id="esub_sub_category" required
                                placeholder="Please provide a name sub category" autocomplete="OFF">
                        </div>

                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="button" onclick="submitformedit_sub()">Save</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>

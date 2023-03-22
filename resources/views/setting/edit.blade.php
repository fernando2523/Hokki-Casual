<form id="form_edit" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:3%;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">UPDATE DATA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <input type="hidden" id="id">
                        <input type="hidden" id="email" name="email">
                    </div>

                    <div class="row form-group">
                        <div class="col-12 form-group mb-3">
                            <label class="form-label">Name</label>
                            <input id="name" type="text"
                                class="form-control form-control-lg bg-white bg-opacity-5" placeholder="name"
                                name="name" required autocomplete="off" autofocus>
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

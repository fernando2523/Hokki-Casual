<form id="form_deleteuser" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaldeleteuser" data-bs-backdrop="static" style="padding-top:3%;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">DISABLE ACCOUNT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center text-danger" style="padding-bottom: 0px;font-weight: bold;">
                    <p>Are You Sure Want To Disable this account?</p>
                </div>
                <input type="hidden" id="delu_id">
                <input type="hidden" id="delu_username" name="delu_username">
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-default" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-danger" type="button"
                        onclick="submitformdeleteuser()">Disable</button>
                </div>
            </div>
        </div>
    </div>
</form>

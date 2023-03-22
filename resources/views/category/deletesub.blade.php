<form id="form_delete_sub" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaldelete_sub" data-bs-backdrop="static" style="padding-top:3%;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning">DELETE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center text-warning" style="padding-bottom: 0px;font-weight: bold;">
                    <p>Are You Sure Want To Delete This Item?</p>
                </div>
                <input type="hidden" id="delsub_id" name="delsub_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-default" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-warning" type="button"
                        onclick="submitformdelete_sub()">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>

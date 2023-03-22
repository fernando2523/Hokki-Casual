<form id="form_deleteaccount" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaldeleteaccount" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-warning">DELETE EMPLOYEE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center text-warning" style="padding-bottom: 0px;font-weight: bold;">
               <p>Are You Sure Want To delete this employee?</p>
            </div>
            <input type="hidden" id="delacc_id">
            <input type="hidden" id="delacc_username" name="delacc_username">
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-default" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-outline-warning" type="button" onclick="submitformdeleteaccount()">Delete</button>
            </div>
        </div>
    </div>
</div>
</form>


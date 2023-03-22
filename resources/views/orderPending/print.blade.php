<form id="form_print" class="was-validated" method="POST" target="_blank">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modalprint" data-bs-backdrop="static" style="padding-top:7%;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success">PRINT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center text-success" style="padding-bottom: 0px;font-weight: bold;">

                    <div class="mb-3">
                        <label class="fs-14px fw-bold" id="p_id_reseller_label"></label>
                    </div>

                    <div class="mb-3">
                        <select class="form-select form-select-sm" name="type_print" id="type_print">
                            <option value="THIS_NOTA" selected>THIS NOTA</option>
                            <option value="ALL_NOTA">ALL NOTA PENDING</option>
                        </select>
                    </div>

                </div>
                <input type="hidden" id="p_id" name="p_id">
                <input type="hidden" id="p_id_invoice" name="p_id_invoice">
                <input type="hidden" id="p_id_reseller" name="p_id_reseller">
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-default" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-success" type="button" onclick="submitformprint()">Print</button>
                </div>
            </div>
        </div>
    </div>
</form>

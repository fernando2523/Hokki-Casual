<form method="POST" action="/remove_display">
    @csrf
    <div class="modal fade" id="remove_display" data-bs-backdrop="static" style="padding-top:3%;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning">DELETE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center text-warning" style="padding-bottom: 0px;font-weight: bold;">
                    <p>Are You Sure Want To Remove Display?</p>
                </div>
                <input type="hidden" id="id_display" name="id_display">
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-default" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-warning" type="submit">Remove</button>
                </div>
            </div>
        </div>
    </div>
</form>

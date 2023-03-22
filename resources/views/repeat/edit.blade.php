<form id="form_edit" enctype="multipart/form-data" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaledit" data-bs-backdrop="static" style="margin-top: 2%;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="produk"></h5> &nbsp;|&nbsp;
                    <h5 class="modal-title text-default" id="brand"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div id="repeatorder">
                    </div>
                    {{-- <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="button" onclick="submitformedit()">Save</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</form>

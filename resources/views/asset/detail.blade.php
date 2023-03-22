<form id="form_detail" enctype="multipart/form-data" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaldetail" data-bs-backdrop="static" style="margin-top: 2%;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white">DETAIL</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="load_detail_asset">
                    </div>
                    {{-- <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="button" onclick="submitformdetail()">Save</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</form>

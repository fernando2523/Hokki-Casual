<form id="form_rincian" enctype="multipart/form-data" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modalrincian" data-bs-backdrop="static" style="padding-top:2%;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rincian Nota : &nbsp;</h5>
                    <h5 class="modal-title text-theme" id="id_transaction"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div id="rincian_refund">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

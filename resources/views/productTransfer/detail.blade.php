<form id="form_detail" method="POST" action="/transfer">
    @csrf
    <div class="modal fade" id="modaldetail" data-bs-backdrop="static" style="margin-top: 2%;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white">PINDAH STOK ANTAR GUDANG</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="load_product_transfer">
                    </div>
                    {{-- <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="button" onclick="submitformdetail()">Save</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</form>

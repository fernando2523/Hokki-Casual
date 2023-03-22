<form id="form_barcode" target="_blank" class="was-validated" enctype="multipart/form-data" method="POST"
    action="/print/printtest">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modalbarcode" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">PRINT BARCODE <i class="fa-xl bi bi-upc-scan ms-1"></i></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12" align="center">
                            <span><img src="/product/defaultimg.png" alt="" width="300" height="300"
                                    class="rounded"></span>
                        </div>
                        <div class="col-12 mt-2 mb-3" align="center">
                            <span>
                                <label class="fw-bold"><span id="produk_name"></span></label><br>
                                <label class="fw-bold text-theme"><span id="produk_id"></span></label>
                            </span>

                            <input type="hidden" id="v_id_produk" name="v_id_produk">
                            <input type="hidden" id="v_id_ware" name="v_id_ware">
                            <input type="hidden" id="v_id_area" name="v_id_area">
                            <input type="hidden" id="v_produk" name="v_produk">

                        </div>
                        <hr>
                        {{-- <div class="col-12" align="center">
                            <div class="form-group mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="tipe_print" type="radio"
                                        onchange="select_type_print(this.value)" id="check_custom" value="custom">
                                    <label class="form-check-label fw-bold" for="check_custom">CUSTOM PRINT</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="tipe_print" type="radio"
                                        onchange="select_type_print(this.value)" id="check_bypo" value="bypo">
                                    <label class="form-check-label fw-bold" for="check_bypo">PURCHASE ORDER</label>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    <div id="barcode_detail">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-theme fw-bold" type="BUTTON" onclick="submitformbarcode()">
                        PRINT
                        <i class="fa-xl bi bi-upc-scan ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function select_type_print(val) {
        var id_produk = document.getElementById('v_id_produk').value;
        var id_ware = document.getElementById('v_id_ware').value;
        var id_area = document.getElementById('v_id_area').value;

        $.ajax({
            type: 'POST',
            url: "{{ URL::to('/barcode_detail') }}",
            data: {
                id_produk: id_produk,
                id_ware: id_ware,
                id_area: id_area,
                val: val
            },
            success: function(data) {
                $("#barcode_detail").html(data);
            }
        });

    }

    function selectpo() {
        var select = document.getElementById('idpo');
        var value = select.options[select.selectedIndex].value;
        var v_id_produk = document.getElementById('v_id_produk').value;
        var v_id_ware = document.getElementById('v_id_ware').value;

        $.ajax({
            type: 'POST',
            url: "{{ URL::to('/select_size_po') }}",
            beforeSend: function() {
                $('#select_size_po').prop('disabled', true);
            },
            data: {
                value: value,
                v_id_produk: v_id_produk,
                v_id_ware: v_id_ware,
            },
            success: function(data) {
                $('#select_size_po').prop('disabled', false);
                $("#select_size_po").html(data);
            }
        });
    }
</script>

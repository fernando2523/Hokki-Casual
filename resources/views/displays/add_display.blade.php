<meta name="csrf-token" content="{{ csrf_token() }}">
<form onsubmit="return confirm('Apakah Size sudah Benar?');" class="was-validated" method="POST" action="/add_display">
    @csrf
    <div class="modal fade" id="add_display" data-bs-backdrop="static" style="padding-top: 5%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white">ADD PRODUCT DISPLAY</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id_area" name="id_area">
                    <input type="hidden" id="id_store" name="id_store">
                    <input type="hidden" value="1" id="qty" name="qty">
                    <input type="hidden" id="users" name="users">

                    <div class="col-12 form-group mb-2">
                        <label class="form-label">ID Produk</label>
                        <input class="form-control form-control-sm text-theme border-theme" type="text"
                            name="id_produk" id="id_produk" readonly>
                    </div>

                    <div class="col-12 form-group mb-2">
                        <label class="form-label">Produk</label>
                        <input class="form-control form-control-sm text-theme border-theme" type="text"
                            name="produk" id="produk" readonly>
                    </div>

                    <div class="col-12 form-group mb-2">
                        <label class="form-label">Brand</label>
                        <input class="form-control form-control-sm text-theme border-theme" type="text"
                            name="brand" id="brand" readonly>
                    </div>

                    <div class="col-12 form-group mb-2">
                        <label class="form-label">Stock From</label>
                        <select class="form-select form-select-sm text-theme" id="id_ware" name="id_ware" required>
                            <option value="" selected disabled>SELECT WAREHOUSE..</option>
                            @foreach ($warehouse as $ware)
                                <option value="{{ $ware->id_ware }}">{{ $ware->warehouse }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 form-group mb-2">
                        <label class="form-label">Size</label>
                        <select class="form-select form-select-sm text-theme" id="size" name="size" required>
                            <option value="" selected disabled>SELECT SIZE..</option>
                            @for ($i = 35; $i < 46; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="form-group">
                        <button class="btn btn-theme" type="submit">Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
<script>
    // CSRF for all ajax call
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

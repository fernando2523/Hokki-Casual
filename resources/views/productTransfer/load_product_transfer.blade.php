<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="card-body col-12 profile-img" align="center">
                @foreach ($dataimg as $data)
                    @if ($data->id_produk === $id_produk)
                        @if ($data->img === null or $data->img === '')
                            <img class="mb-2" id="previewimg" width="206px;" src="/product/defaultimg.png">
                        @else
                            <img class="mb-2" id="previewimg" width="206px;" src="/product/{{ $data->img }}">
                        @endif
                    @endif
                @endforeach
            </div>

            <div class="col-12 mb-3">
                <label class="form-label fw-bold">Produk</label>
                <input class="form-control text-left form-control-sm text-theme" type="text" name="produk" required
                    readonly value="{{ $produk }}">
            </div>
            <div class="col-6  mb-3">
                <label class="form-label fw-bold">ID Produk</label>
                <input class="form-control form-control-sm text-theme" type="text" name="id_produk" id="id_produk"
                    required readonly value="{{ $id_produk }}">
            </div>
            <div class="col-6  mb-3">
                <label class="form-label fw-bold">Brand</label>
                <input class="form-control form-control-sm text-theme" type="text" name="brand" required readonly
                    value="{{ $brand }}">
            </div>
            <div class="col-6  mb-3">
                <label class="form-label fw-bold">Quality</label>
                <input class="form-control form-control-sm text-theme" type="text" name="quality" required readonly
                    value="{{ $quality }}">
            </div>
            <div class="col-6  mb-3">
                <label class="form-label fw-bold">Category</label>
                <input class="form-control form-control-sm text-theme" type="text" name="category" required readonly
                    value="{{ $category }}">
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="row">
            <div class="col-6 form-group position-relative mb-3">
                <label class="form-label fw-bold">WAREHOUSE ASAL</label>
                <select class="form-select form-select-sm text-theme" name="warehouse_asal">
                    <option value="{{ $id_ware }}" selected>{{ $getwarehouse_awal[0]->warehouse }}</option>
                </select>
            </div>

            <div class="col-6 form-group position-relative mb-3">
                <label class="form-label fw-bold">WAREHOUSE TUJUAN</label>
                <select class="form-select form-select-sm" name="warehouse_tujuan" id="warehouse_tujuan" required>
                    <option value="" disabled selected>Pilih Warehouse Tujuan</option>
                    @foreach ($getwarehouse_tujuan as $tujuan)
                        <option value="{{ $tujuan->id_ware }}">{{ $tujuan->warehouse }}</option>
                    @endforeach
                </select>
                <div class="invalid-tooltip">
                    Silahkan pilih warehouse tujuan.
                </div>
            </div>

            <div class="col-12 mb-3">
                <table class="table table-bordered table-sm mt-3 ">
                    <thead>
                        <tr>
                            <th class="text-center text-white" style="height: 21px;">SIZE</th>
                            <th class="text-center text-white" style="height: 21px;">QTY</th>
                            <th class="text-center text-white" style="height: 21px;width: 40%;">TRANSFER QTY</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        $max = 0;
                        ?>
                        @foreach ($variationss as $key => $value)
                            @if ($value->id_produk === $id_produk)
                                <tr>
                                    <td>
                                        <input class="form-control text-center" type="text" name="size[]"
                                            value="{{ $value->size }}" readonly style="width: 100%;height: 21px;">
                                    </td>
                                    <td>
                                        <input class="form-control text-center fw-bold text-success" type="number"
                                            name="qty_old[]" value="{{ $value->qty }}" readonly
                                            style="width: 100%;height: 21px;">
                                    </td>
                                    <td>
                                        @if (intval($value->qty) === 0)
                                            <input class="form-control text-center" type="text" id="qty[]"
                                                name="qty[]" value="0"
                                                style="width: 100%;height: 21px;font-weight: bold;" autocomplete="off"
                                                readonly>
                                        @else
                                            <input class="form-control text-center text-theme " type="text"
                                                id="qty[]" name="qty[]" value="0"
                                                onkeydown="return isNumberKey(event,this,'{{ $value->qty }}')"
                                                onkeyup="return valids(this,'{{ $value->qty }}')"
                                                style="width: 100%;height: 21px;font-weight: bold;" autocomplete="off"
                                                required>
                                        @endif
                                    </td>
                                </tr>
                                <?php
                                $count = $count + 1;
                                $max = $max + $value->qty;
                                ?>
                            @endif
                        @endforeach
                        <input type="hidden" id="count_qty" value="{{ $count }}">
                        <input type="hidden" id="max" value="{{ $max }}">
                    </tbody>
                </table>
            </div>
            <div class="form-group" align="right">
                <button class="btn btn-theme" type="button" onclick="submitformdetail()">Save</button>
            </div>
        </div>
    </div>
</div>



<script>
    function isNumberKey(evt, e, qty_old) {
        var aCode = event.which ? event.which : event.keyCode;
        if (aCode > 31 && (aCode < 48 || aCode > 57)) return false;
        return true;

    }

    function valids(e, qty_old) {
        var val = parseInt(e.value);

        if (val > 0) {
            if (val > qty_old) {
                // alert('Quantity Lebih Dari Stock Ready');
                e.classList.add("is-invalid");
            } else {
                e.classList.remove("is-invalid");
                e.classList.add("is-valid");
            }

            return e.value = parseInt(e.value);
        } else {
            e.classList.remove("is-invalid");
            e.classList.remove("is-valid");
            return e.value = 0;
        }
    }
</script>

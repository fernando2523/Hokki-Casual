@if (count($get_oldqty) === 0)
    <div align="center">
        <p>Stock Belum Tersedia</p>
        <p>Silahkan Repeat Stock di Page Repeat Produk atau <a href="../repeat/repeatorders">Klik Disini</a></p>
    </div>
@else
    <div class="row form-group">
        <div class="col-4">
            <select class="form-select form-select-sm text-theme fw-bold" required id="tipe_so" name="tipe_so"
                onchange="get_id_so()">
                <option value="" disabled selected>Tipe SO</option>
                <option value="so_baru">SO BARU</option>
                <option value="so_lanjutan">SO LANJUTAN</option>
            </select>
        </div>

        <script>
            function get_id_so() {
                var select = document.getElementById('tipe_so');
                var tipe_so = select.options[select.selectedIndex].value;

                $.ajax({
                    type: 'GET',
                    url: "{{ URL::to('/get_idso') }}",
                    data: {
                        tipe_so: tipe_so,
                    },
                    beforeSend: function() {
                        document.getElementById('id_so').value = 'Process Get ID';
                    },
                    success: function(data) {
                        document.getElementById('id_so').value = data;
                    }
                });
            }
        </script>

        <div class="col-3">
            <input class="form-control form-control-sm" type="text" required id="id_so" name="id_so"
                placeholder="ID SO" value="" readonly>
        </div>

        <div class="col-5">
            <select class="form-select form-select-sm text-theme fw-bold" required id="so_modal" name="so_modal">
            </select>
        </div>

        <table class="table table-bordered table-sm mt-3" id="variations" id="hasil_variation">
            <thead>
                <tr>
                    <th class="text-center text-white" style="height: 10px;">SIZE</th>
                    <th class="text-center text-white" style="height: 10px;">QTY OLD</th>
                    <th class="text-center text-white" style="height: 21px;">QTY NEW</th>
                    <th class="text-center text-white" style="height: 21px;">+ / -</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($get_oldqty as $data)
                    <tr>
                        <td>
                            <input class="form-control form-control-sm text-center text-white" type="text"
                                name="so_size[]" value="{{ $data->size }}" readonly style="width: 100%;">
                        </td>
                        <td>
                            <input class="form-control form-control-sm text-center text-white" type="text"
                                name="so_qty_old[]" value="{{ $data->qty }}" onkeydown="return isNumberKey(event)"
                                readonly style="width: 100%;font-weight: bold;" autocomplete="off">
                        </td>
                        <td>
                            <input class="form-control form-control-sm text-center text-danger is-invalid"
                                type="text" name="so_qty_new[]" value="0" min="0"
                                onkeydown="return isNumberKey(event)" onkeyup="return valids(this)"
                                style="width: 100%;font-weight: bold;" autocomplete="off" required>
                        </td>
                        <td>
                            <select class="form-select form-select-sm text-theme fw-bold" name="so_status[]">
                                <option value="PLUS">+</option>
                                <option value="MINUS">-</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="form-group mt-2" align="right">
        <button class="btn btn-theme" type="submit">Save</button>
    </div>
@endif

<script>
    function isNumberKey(evt) {
        var aCode = event.which ? event.which : event.keyCode;
        if (aCode > 31 && (aCode < 48 || aCode > 57)) return false;
        return true;
    }

    function valids(e) {
        var val = parseInt(e.value);

        if (val > 0) {
            return e.value = parseInt(e.value);
        } else {
            e.classList.remove("is-invalid");
            e.classList.remove("is-valid");
            return e.value = 0;
        }
    }
</script>

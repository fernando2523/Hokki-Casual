<div>
    <link href="{{ URL::asset('/assets/plugins/select-picker/dist/picker.min.css') }}" rel="stylesheet" />
    <label class="form-label">Area / Kota <span class="text-danger fw-bold">*</span></label>
    <select class="form-select text-theme selectpicker" name="e_id_area" id="e_id_area" required>
        <option data-e_kota="{{ $area }}" value="{{ $id_area }}" selected>
            {{ $area }}</option>
        @foreach ($getarea as $gets)
            <option data-e_kota="{{ $gets->kota }}" value="{{ $gets->id_area }}">
                {{ $gets->kota }}</option>
        @endforeach
    </select>
    <input type="hidden" name="e_kota" id="e_kota">
    <input type="hidden" name="e_kota_default" value="{{ $area }}">
    <div class="invalid-tooltip">
        Silahkan pilih area yang sesuai.
    </div>
</div>
<script src="{{ URL::asset('/assets/plugins/select-picker/dist/picker.min.js') }}"></script>
<script>
    $('#e_id_area').picker({
        search: true,
    });

    $('#e_id_area').on('sp-change', function() {
        var e_kota = $('#e_id_area').find(":selected").data('e_kota');
        document.getElementById('e_kota').value = e_kota;
    });
</script>

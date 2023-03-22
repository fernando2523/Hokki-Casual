<select class="form-select fw-bold border-theme text-theme" id="mdl_warehouse">
    <option value="" disabled selected>Pilih Warehouse..</option>
    @foreach ($data as $data)
        <option data-warehouse="{{ $data->warehouse }}" value="{{ $data->id_ware }}">{{ $data->warehouse }}</option>
    @endforeach
</select>

<script>
    $('#mdl_warehouse').on('change', function() {
        var id_produk = $('#mdl_id_produk').val();
        var id_ware = $(this).val();
        var size = $('#c_size').val();
        load_size(id_produk, id_ware, size);
    });
</script>

<div>
    <label class="form-label">Warehouse</label>
    <select class="form-select form-select-sm text-theme" name="e_id_ware" required>
        <option value="" disabled selected>Pilih Warehouse</option>
        @foreach ($getwarehouse as $gets)
            @if ($gets->id_ware === $id_ware)
                <option value="{{ $id_ware }}" selected>{{ $gets->warehouse }}</option>
            @else
                <option value="{{ $gets->id_ware }}">{{ $gets->warehouse }}</option>
            @endif
        @endforeach
    </select>
    <div class="invalid-tooltip">
        Silahkan pilih warehouse yang sesuai.
    </div>
</div>

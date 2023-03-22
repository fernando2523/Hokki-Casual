<div>
    <label class="form-label">Store</label>
    <select class="form-select text-theme" name="e_id_store" required>
        @foreach ($datastore as $stores)
            @if ($id_store === 'SUPER-ADMIN')
                <option value="{{ $id_store }}">{{ $id_store }}</option>
            @else
                @if ($stores->id_store === $id_store)
                    <option value="{{ $id_store }}" selected>{{ $stores->store }}</option>
                @else
                    <option value="{{ $stores->id_store }}">{{ $stores->store }}</option>
                @endif
            @endif
        @endforeach
    </select>
    <div class="invalid-tooltip">
        Silahkan pilih store yang sesuai.
    </div>
</div>

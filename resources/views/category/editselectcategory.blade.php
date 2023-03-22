<div>
    <label class="form-label">Category</label>
    <select class="form-select text-theme" name="esub_id_cat" required>
        <option id="esub_default_category" disabled selected>Choose Category</option>
        @foreach ($getcategory as $gets)
            @if ($gets->id_cat === $id_cat_default)
                <option value="{{ $id_cat_default }}" selected>{{ $category_default }}</option>
            @else
                <option value="{{ $gets->id_cat }}">{{ $gets->category }}</option>
            @endif
        @endforeach
    </select>
    <div class="invalid-tooltip">
        Silahkan pilih category yang sesuai.
    </div>
</div>

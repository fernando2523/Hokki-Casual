@if (Auth::user()->role === 'SUPER-ADMIN')
    <div>
        <label class="form-label">Store</label>
        <select class="form-select form-select-sm text-theme" name="e_store" required>
            @if (Auth::user()->role === 'SUPER-ADMIN')
                @foreach ($getstore as $gets)
                    @if ($gets->store === $storedefault)
                        <option value="{{ $gets->store }}" selected>{{ $gets->store }}
                        </option>
                    @else
                        <option value="{{ $gets->store }}">{{ $gets->store }}
                        </option>
                    @endif
                @endforeach
            @endif
        </select>
        <div class="invalid-tooltip">
            Mohon pilih store yang sesuai.
        </div>
    </div>
    <hr style="margin-top: 25px;">
@else
    <div hidden>
        <label class="form-label">Store</label>
        <select class="form-select form-select-sm text-theme" name="e_store" required>
            <option value="{{ $storedefault }}" selected>{{ $storedefault }}
            </option>
        </select>
    </div>
@endif

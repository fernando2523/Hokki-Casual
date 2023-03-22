<div>
    <label class="form-label">Role</label>
    <select class="form-select text-theme" name="e_role" required>
        @foreach ($getrole as $gets)
            @if ($gets->role === $roledefault)
                <option value="{{ $roledefault }}" selected>{{ $roledefault }}</option>
            @else
                <option value="{{ $gets->role }}">{{ $gets->role }}</option>
            @endif
        @endforeach
    </select>
    <div class="invalid-tooltip">
        Silahan pilih role yang sesuai.
    </div>
</div>

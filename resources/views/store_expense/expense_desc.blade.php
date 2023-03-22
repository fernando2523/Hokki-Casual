@if ($desc_default === '')
    <div>
        <label class="form-label">Desc</label>
        <textarea class="form-control form-control-sm text-theme is-invalid" type="text" name="e_desc" placeholder="Opsional.."
            autocomplete="OFF" rows="2"></textarea>
    </div>
@else
    <div>
        <label class="form-label">Desc</label>
        <textarea class="form-control form-control-sm text-theme is-invalid" type="text" name="e_desc"
            placeholder="Opsional.." autocomplete="OFF" rows="2">{{ $desc_default }} </textarea>
    </div>
@endif

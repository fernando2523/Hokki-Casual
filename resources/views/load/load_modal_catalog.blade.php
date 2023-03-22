@if ($count == 0)
    <center>Stock Belum Ada</center>
@else
    @foreach ($data as $data)
        @if ($data->qty != '0')
            <div class="col-3">
                <input type="radio" id="size_select{{ $data->id }}" name="mdl_size" data-qty="{{ $data->qty }}"
                    value="{{ $data->size }}">
                @if (count($display) > 0 and $display[0]['size'] === $data->size)
                    <label class="border-warning p-0 pt-2 pb-2 text-warning" onclick="display_validation('display')"
                        for="size_select{{ $data->id }}"
                        style="cursor: pointer;">{{ $data->size }}={{ $data->qty }}</label>
                @else
                    <label class="border-theme p-0 pt-2 pb-2" onclick="display_validation('nondisplay')"
                        for="size_select{{ $data->id }}"
                        style="cursor: pointer;">{{ $data->size }}={{ $data->qty }}</label>
                @endif

            </div>
        @else
            <div class="col-3">
                <input type="radio" id="size_select{{ $data->id }}" name="mdl_size"
                    data-qty="{{ $data->qty }}" value="{{ $data->size }}" disabled>
                <label class="border-default text-default p-0 pt-2 pb-2"
                    for="size_select{{ $data->id }}">{{ $data->size }}={{ $data->qty }}</label>
            </div>
        @endif
    @endforeach
    <div class="fw-bold mt-3 mb-2">Stock Display:</div>
    <div class="col-6">
        <input class="form-check-input" type="radio" value="nondisplay" id="nondisplay" name="type_product" disabled
            checked />
        <label class="form-check-label" for="nondisplay">Non Display</label>
    </div>
    <div class="col-6">
        <input class="form-check-input" type="radio" value="display" id="display" name="type_product" disabled />
        <label class="form-check-label" for="display">Display Used</label>
    </div>
@endif


<script>
    function display_validation(validation) {
        if (validation === 'display') {
            document.querySelector('input[id="nondisplay"]').checked = false;

            document.querySelector('input[id="nondisplay"]').disabled = false;
            document.querySelector('input[id="display"]').disabled = false;
        } else {
            document.querySelector('input[id="nondisplay"]').checked = true;

            document.querySelector('input[id="nondisplay"]').disabled = true;
            document.querySelector('input[id="display"]').disabled = true;
        }
    }
</script>

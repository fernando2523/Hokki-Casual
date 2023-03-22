<div class="col-12 form-group mb-2" align="center">
    <label class="form-label fw-bold text-white">{{ $produk }}</label><br>
    <label class="form-label fw-bold text-white">{{ $id_produk }}</label>
</div>
<div class="col-12 form-group" align="center">
    @foreach ($get_variation as $vars)
        @if ($vars->id_produk === $id_produk and $vars->id_ware === $id_ware and $vars->idpo === $idpo)
            @if ($vars->qty != '0')
                <span class="text-lime fw-bold">
                    [{{ $vars->size }} = {{ $vars->qty }}]
                </span>
            @else
                <span class="text-danger fw-bold">
                    [{{ $vars->size }} = {{ $vars->qty }}]
                </span>
            @endif
        @endif
    @endforeach
</div>

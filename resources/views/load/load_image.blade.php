<script type="text/javascript">
    var loadeditFile2 = function(event) {
        var previewimg2 = document.getElementById('previewimg2');
        previewimg2.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@foreach ($dataimg as $data)
    @if ($data->id_produk === $id_produk)
        @if ($data->img === null or $data->img === '')
            <img class="mb-2" id="previewimg2" width="221px" src="/product/defaultimg.png">
        @else
            <img class="mb-2" id="previewimg2" width="221px" src="/product/{{ $data->img }}">
        @endif
    @endif
@endforeach
<input type="file" class="form-control form-control-sm mt-3" name="file" onchange="loadeditFile2(event)">
<script type="text/javascript">
    $('#file').change(function() {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#previewimg2').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });
</script>

@if ($search === 'SNEAKERS UNISEX')
<table class="table table-bordered table-sm" id="variations" id="hasil_variation">
    <thead>
        <tr>
            <th class="text-center text-white" style="height: 10px;">SIZE</th>
            <th class="text-center text-white" style="height: 10px;">QTY</th>
        </tr>
    </thead>

    <tbody id="tbody_item">
        @php
        $i = 0;
        $size = 35;
        @endphp
        @while ($i < 11) <tr>
            <td>
                <input class="form-control text-center text-white" type="text" name="size[]" value="{{ $size + $i }}" readonly style="width: 100%;height: 15px;">
            </td>
            <td>
                <input class="form-control text-center text-white" type="text" name="qty[]" value="0" onkeydown="return isNumberKey(event)" onkeyup="return valids(this)" style="width: 100%;height: 15px;font-weight: bold;" autocomplete="off">
            </td>
            </tr>
            @php $i++; @endphp
            @endwhile
    </tbody>
</table>
@else
<table class="table table-bordered table-sm" id="variations" id="hasil_variation">
    <thead>
        <tr>
            <th class="text-center text-white" style="height: 10px;">CUSTOM</th>
            <th class="text-center text-white" style="height: 10px;">QTY</th>
        </tr>
    </thead>

    <tbody id="tbody_item">
        <tr>
            <td>
                <input class="form-control text-center" type="text" name="size[]" value="" style="width: 100%">
            </td>
            <td>
                <input class="form-control text-center text-info" type="text" name="qty[]" value="0" onkeydown="return isNumberKey(event)" onkeyup="return valids(this)" style="width: 100%;font-weight: bold;" autocomplete="off">
            </td>
        </tr>
    </tbody>
</table>
<button type="button" class="btn btn-success btn-sm" onclick="addtable()">Add</button>
<script>
    function addtable() {
        var tbody = document.getElementById('tbody_item');
        var row = tbody.insertRow(-1);
        var size = row.insertCell(0);
        var qty = row.insertCell(1);
        var aksi = row.insertCell(2);

        size.innerHTML = "<input class='form-control text-center text-white' type='text' name='size[]' style='width: 100%'>";
        qty.innerHTML =
            "<input class='form-control text-center text-white' onkeydown='return isNumberKey(event)' onkeyup='return valids(this)' type='text' name='qty[]' style='width: 100%'>";
        aksi.innerHTML =
            '<td style="width: 11px;"><button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">X</button></td>';
    }

    function deleteRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("variations").deleteRow(i);
    }
</script>
@endif
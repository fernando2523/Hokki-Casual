<!-- default table -->
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th scope="col">Size</th>
            <th scope="col">Qty</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $datas)
            <tr>
                <td>{{ $datas->size }}</td>
                <td>{{ $datas->qty }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

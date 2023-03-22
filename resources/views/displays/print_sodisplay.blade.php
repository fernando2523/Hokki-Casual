<style>
    table,
    td,
    th {
        border: 1px solid;
    }

    th {
        height: 40px;
    }

    td {
        height: 25px;
    }

    table {
        text-align: center;
        width: 100%;
        border-collapse: collapse;
        font-size: 10px;
    }
</style>

<title>Print SO Display | {{ $_GET['store'] }}</title>

<h2>LIST PRODUCT DISPLAY</h2>
<div style="font-size: 15px;margin-bottom:15px;">
    <span>STORE : {{ $_GET['store'] }}</span>
</div>

<table>
    <thead>
        <tr>
            <th style="width: 5%;">No.</th>
            <th style="width: 12%;">ID PRODUK</th>
            <th style="width: 45%;">PRODUK</th>
            <th style="width: 15%;">STATUS DISPLAY</th>
            <th style="width: 15%;">WAREHOUSE</th>
            <th style="width: 10%;">SIZE</th>
        </tr>
    </thead>
    <tbody>
        @for ($b = 0; $b < count($product); $b++)
            <tr>
                <td style="width: 5%;">{{ $b + 1 }}</td>
                <td style="width: 12%;">{{ $product[$b]['id_produk'] }}</td>
                <td style="width: 45%;">{{ $product[$b]['produk'] }}</td>
                <td style="width: 15%;"></td>
                <td style="width: 15%;"></td>
                <td style="width: 10%;"></td>
            </tr>
        @endfor
    </tbody>
</table>

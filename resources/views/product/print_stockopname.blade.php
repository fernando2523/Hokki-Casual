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

<title>Stock Opname</title>

<h2>LIST PRODUCT {{ $product[0]['warehouse'][0]['warehouse'] }}</h2>
{{-- <img src="{{ URL::asset('assets/img/footbox.png') }}" width="100" height="100"> --}}

<table>
    <thead>
        <tr style="background-color: rgb(180, 178, 178);">
            <th style="width: 5%;font-size: 15px;">No.</th>
            <th style="width: 9%;font-size: 15px;">BRAND</th>
            <th style="width: 10%;font-size: 15px;">ID PRODUK</th>
            <th style="width: 35%;font-size: 15px;">PRODUK</th>
            <th colspan="11" style="width: 35%;font-size: 15px;">SIZE</th>
            <th style="width: 5%;font-size: 15px;">QTY</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $nomor = 0;
        for ($x = 0; $x < count($datas); $x++) { 
            
        ?>
            @if (count($datas[$x]['variation']) > 0) 
            
            <?php $nomor++; ?>
            <tr>
                <td rowspan="3" style="width: 5%;font-weight: bold;">{{$nomor }}</td>
                <td rowspan="3" style="width: 9%;font-weight: bold;">{{$datas[$x]['brand']}}</td>
                <td rowspan="3" style="width: 10%;font-weight: bold;">{{$datas[$x]['id_produk']}}</td>
                <td rowspan="3" style="width: 35%;font-weight: bold;">{{$datas[$x]['produk']}}</td>
                
                    @if (count($datas[$x]['variation']) < 11)  
                        <?php 
                            $sisacol = 11 - count($datas[$x]['variation']);
                        ?>
                        <?php for ($v = 0; $v < count($datas[$x]['variation']); $v++) { ?>
                        
                            <td colspan="{{$sisacol+1}}" style="width: 5%;font-weight: bold;border-top: 0px;background-color: rgb(180, 178, 178);">{{ $datas[$x]['variation'][$v]->size }}</td>
                        
                        <?php } ?>
                        
                        <td style="width: 5%;font-weight: bold;border-top: 0px;background-color: rgb(180, 178, 178);">
                            <p>TOTAL</p>
                        </td>
                        
                        <tr>
                             <?php 
                             $total = 0;
                             for ($v = 0; $v < count($datas[$x]['variation']); $v++) { ?>
                        
                                <td colspan="{{$sisacol+1}}" style="width: 5%;font-weight: bold;background-color: rgb(238,255,83);">{{ $datas[$x]['variation'][$v]->qty }}</td>
                                
                            <?php 
                                $total = $total + $datas[$x]['variation'][$v]->qty;
                            } ?>
                        </tr>
                        
                        <td style="width: 5%;font-weight: bold;background-color: rgb(238,255,83);">
                            {{ $total }}
                        </td>
                        
                        <tr>
                            <td colspan="{{$sisacol+1}}" style="width: 5%;font-weight: bold;"></td>
                        </tr>
                    @else
                        <?php for ($v = 0; $v < count($datas[$x]['variation']); $v++) { ?>
                        
                            <td style="width: 5%;font-weight: bold;border-top: 0px;background-color: rgb(180, 178, 178);">{{ $datas[$x]['variation'][$v]->size }}</td>
                        
                        <?php } ?>
                        
                        <td style="width: 5%;font-weight: bold;border-top: 0px;background-color: rgb(180, 178, 178);">
                            <p>TOTAL</p>
                        </td>
                        
                        <tr>
                             <?php 
                             $total = 0;
                             for ($v = 0; $v < count($datas[$x]['variation']); $v++) { ?>
                        
                                <td style="width: 5%;font-weight: bold;background-color: rgb(238,255,83);">{{ $datas[$x]['variation'][$v]->qty }}</td>
                                
                            <?php 
                                $total = $total + $datas[$x]['variation'][$v]->qty;
                            } ?>
                        </tr>
                        
                        <td style="width: 5%;font-weight: bold;background-color: rgb(238,255,83);">
                            {{ $total }}
                        </td>
                        
                        <tr>
                            <td style="width: 5%;font-weight: bold;"></td>
                            <td style="width: 5%;font-weight: bold;"></td>
                            <td style="width: 5%;font-weight: bold;"></td>
                            <td style="width: 5%;font-weight: bold;"></td>
                            <td style="width: 5%;font-weight: bold;"></td>
                            <td style="width: 5%;font-weight: bold;"></td>
                            <td style="width: 5%;font-weight: bold;"></td>
                            <td style="width: 5%;font-weight: bold;"></td>
                            <td style="width: 5%;font-weight: bold;"></td>
                            <td style="width: 5%;font-weight: bold;"></td>
                            <td style="width: 5%;font-weight: bold;"></td>
                            <td style="width: 5%;font-weight: bold;"></td>
                        </tr>
                    @endif
                
                
                
            </tr>
          
          @endif
        <?php }; ?>
       

    </tbody>
</table>
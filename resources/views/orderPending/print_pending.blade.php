<style type="text/css">
    <!--
    .style10 {
        font-size: 10px;
        font-weight: bold;
        color: #000000;
    }

    .style12 {
        font-size: 10px;
        color: #000000;
    }

    .style14 {
        font-size: 10px
    }

    .style15 {
        color: #FFFFFF
    }
    -->
    @media
    print
    {
    body
    {
    margin-top:
    1mm;
    margin-bottom:
    5mm;
    margin-left:
    5mm;
    margin-right:
    5mm
    }
    }
</style>


<head>
    <title>Print Nota</title>
</head>

<body>
    <table width="30%" border="0" align="center" cellpadding="0" cellspacing="0">
        @if ($validate === 'THIS_NOTA')
            <tr>
                <td colspan="3" align="center">
                    <div align="center" class="style12">
                        <strong>{{ $details[0]->store_inv[0]['store'] }}</strong><br />
                        <strong>{{ $details[0]->store_inv[0]['address'] }}</strong><br />
                        7(Days) | 10:00 - 22:00
                </td>
            </tr>
        @else
            <tr>
                <td colspan="3" align="center">
                    <div align="center" class="style12">
                        <strong>YOUTHLAND APP</strong><br />
                        <strong>{{ $details[0]->store_inv[0]['address'] }}</strong><br />
                        7(Days) | 10:00 - 22:00
                </td>
            </tr>
        @endif

        @if ($validate === 'THIS_NOTA')
            <tr>
                <td colspan="3" align="center"
                    style="font-size: 10px;font-weight:bold;padding-top:10px;padding-bottom:10px;">-PENDING
                    NOTA {{ $id_reseller }}-
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding-bottom:-10px;"><span class="style12"><strong>Invoice
                        </strong></span><span class="style12"><strong>:
                            {{ '#' . $details[0]->id_invoice }}</strong></span></td>
                <td align="right" style="padding-bottom:-10px;">
                    <div><span class="style12"><strong>{{ $details[0]->tanggal }}</strong></span></div>
                </td>
            </tr>
        @else
            <tr>
                <td colspan="3" align="center" style="font-size: 10px;font-weight:bold;padding-top:10px;">-PENDING
                    NOTA {{ $id_reseller }}-
                </td>
            </tr>
        @endif

        <tr>
            <td colspan="3" align="center">___________________________________</td>
        </tr>
    </table>

    <table width="30%" border="0" align="center" cellpadding="0" cellspacing="0">

        @if ($validate === 'THIS_NOTA')
            @foreach ($details as $item)
                <tr>
                    <td colspan="2" align="left" class="style12" style="padding-top: 5px;padding-bottom: 5px;">
                        <span>{{ $item->produk }} ({{ $item->qty }}x Size {{ $item->size }})</span>
                        <br>
                        <span>Disc</span>
                    </td>

                    <td align="right" class="style12" style="padding-top: 5px;padding-bottom: 5px;">
                        <span>@currency($item->subtotal)</span><br>
                        <span>- @currency($item->diskon_item)</span>
                    </td>
                </tr>
            @endforeach

            <tr>
                <td colspan="2" align="left" class="style10">
                    <span><b>QTY : {{ $ammount[0]->qty }} Amount</b></span>
                </td>
                <td align="right" class="style10">
                    <span><b>@currency($grandtotal[0]->grandtotal)</b></span><br>
                    {{-- <span><b><i>Payment</i></b></span><br> --}}
                </td>
            </tr>

            <tr>
                <td colspan="3" style="padding-top: -8px;">___________________________________</td>
            </tr>
        @else
            {{-- {{ $key }} --}}
            <?php
            $qtysemua = 0;
            $totalsemua = 0;
            ?>
            @foreach ($details_all as $key => $details_all)
                <tr>
                    <td colspan="2" style="padding-top: 10px;"><span class="style12"><strong>Invoice
                            </strong></span><span class="style12"><strong>:
                                {{ '#' . $details_all->details_pending[0]['id_invoice'] }}</strong></span></td>

                    <td style="padding-top: 10px;" align="right">
                        <div><span
                                class="style12"><strong>{{ $details_all->details_pending[0]['tanggal'] }}</strong></span>
                        </div>
                    </td>
                </tr>

                <?php
                $qtysa = 0;
                $amountsa = 0;
                ?>

                @for ($i = 0; $i < count($details_all->details_pending); $i++)
                    <tr>
                        <td colspan="2" align="left" class="style12" style="padding-top: 5px;padding-bottom: 5px;">
                            <span>{{ $details_all->details_pending[$i]['produk'] }}
                                ({{ $details_all->details_pending[$i]['qty'] }}x Size
                                {{ $details_all->details_pending[$i]['size'] }})
                            </span>
                            <br>
                            <span>Disc</span>
                        </td>

                        <td align="right" class="style12" style="padding-top: 5px;padding-bottom: 5px;">
                            <span>@currency($details_all->details_pending[$i]['subtotal'])</span><br>
                            <span>- @currency($details_all->details_pending[$i]['diskon_item'])</span>
                        </td>
                    </tr>

                    <?php
                    $qtysa = $qtysa + intval($details_all->details_pending[$i]['qty']);
                    $amountsa = $amountsa + intVal($details_all->details_pending[$i]['subtotal']);
                    ?>
                @endfor


                <tr>
                    <td colspan="2" align="left" class="style10">
                        <span><b>QTY : {{ $qtysa }} Amount</b></span>
                    </td>
                    <td align="right" class="style10">
                        <span><b>@currency($amountsa)</b></span><br>
                        {{-- <span><b><i>Payment</i></b></span><br> --}}
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="left" style="padding-top: 5px">
                        <div align="center"><span class="style10"><B>Admin : <span
                                        class="style12">{{ $details[0]->users }}</B>
                    </td>

                    <td align="right">
                        <span style="font-size: 10px;font-weight: bold;color: red;">PENDING</span>
                    </td>
                </tr>

                <tr>
                    <td colspan="3" style="padding-top: -8px;">___________________________________</td>
                </tr>

                <?php
                $qtysemua = $qtysemua + $qtysa;
                $totalsemua = $totalsemua + $amountsa;
                ?>
            @endforeach

            <tr>
                <td colspan="2" align="left" class="style10" style="padding-top: 10px">
                    <span><b>QTY : {{ $qtysemua }} Amount</b></span>
                </td>
                <td align="right" class="style10" style="padding-top: 10px">
                    <span><b>@currency($totalsemua)</b></span><br>
                    {{-- <span><b><i>Payment</i></b></span><br> --}}
                </td>
            </tr>
        @endif




        {{-- <tr>
            <td align="right" colspan="3" class="style10" style="padding-top: 3px;">

                {{-- <span><i>Payment</i></span><br> --}}

        {{-- @if ($details[0]->bca != 0)
                    <span><b>Debit BCA :</b></span><br>
                    <span><b>@currency($details[0]->bca)</b></span><br>
                @endif

                @if ($details[0]->cash != 0)
                    <span><b>Cash :</b></span><br>
                    <span><b>@currency($details[0]->cash)</b></span><br>
                @endif

                @if ($details[0]->mandiri != 0)
                    <span><b>Debit Mandiri :</b></span><br>
                    <span><b>@currency($details[0]->mandiri)</b></span><br>
                @endif

                @if ($details[0]->qris != 0)
                    <span><b>QRIS :</b></span><br>
                    <span><b>@currency($details[0]->qris)</b></span><br>
                @endif --}}

        {{-- </td>
        </tr> --}}
    </table>
    <br>
    <table width="30%" border="0" align="center" cellpadding="0" cellspacing="0">
        @if ($validate === 'THIS_NOTA')
            <tr>
                <td align="center">
                    <div align="center"><span class="style10"><B>Admin : <span
                                    class="style12">{{ $details[0]->users }}</B>
                </td>
            </tr>
        @endif


        @if ($validate === 'THIS_NOTA')
            <tr>
                <td align="center">
                    <div>
                        <ul>
                            <li><span class="style12">Please Retain Receipt As Proof Of Purchase
                                    &nbsp;&nbsp;&nbsp;&nbsp;</span></li>
                            <li><span class="style12">Refunds / Returns Are Not Accepted
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </li>
                            <li><span class="style12">Size Exchange Will Require A Purchase Receipt Within 3 Days Period
                                    Since Date Of Purchase</span></li>
                        </ul>
                    </div>
                </td>
            </tr>

            <tr>
                <td align="center" style="padding-top: 15px;">
                    <div><span class="style12">We Thank You For You Purchase</span><br />
                        <span class="style14">{{ $details[0]->store_inv[0]['store'] }}</span><br />
                        <span class="style14"><span class="style12">07-01-2023 07:01:49pm</span></span>
                    </div>
                </td>

            </tr>
            <tr>
                <td><span class="style15">
                        <font color="white">___________________________________</font>
                    </span></td>
            </tr>
        @else
            <tr>
                <td align="center" style="padding-top: -10px;">
                    <div>
                        <ul>
                            <li><span class="style12">Please Retain Receipt As Proof Of Purchase
                                    &nbsp;&nbsp;&nbsp;&nbsp;</span></li>
                            <li><span class="style12">Refunds / Returns Are Not Accepted
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </li>
                            <li><span class="style12">Size Exchange Will Require A Purchase Receipt Within 3 Days
                                    Period
                                    Since Date Of Purchase</span></li>
                        </ul>
                    </div>
                </td>
            </tr>

            <tr>
                <td align="center" style="padding-top: 10px;">
                    <div><span class="style12">We Thank You For You Purchase</span><br />
                        <span class="style14">YOUTHLAND APP</span><br />
                    </div>
                </td>

            </tr>
            <tr>
                <td><span class="style15">
                        <font color="white">___________________________________</font>
                    </span></td>
            </tr>
        @endif


    </table>
</body>

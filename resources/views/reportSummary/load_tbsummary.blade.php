@foreach ($data as $key => $datas)
    <tr>
        @if ($datas->customer === 'RETAIL')
            <td align="center"><span class="fs-13px mt-2">{{ $current_page }}) </span></td>
            <td colspan="5" class="fw-bold pt-3 pb-3">
                <div align="left">
                    <span class="fs-12px text-white">{{ $datas->id_invoice }}</span> | {{ $datas->tanggal }}
                    {{-- <span style="padding-left: 5px;cursor: pointer;">
                        <i class="fa fa-print fa-lg text-info me-2 ms-2"></i></span>
                    <span style="padding-left: 5px;cursor: pointer;" onclick="cancel_order('{{ $datas->id_invoice }}')">
                        <i class="fa fa-times-circle fa-lg text-danger"></i></span> --}}
                    <br>
                    <span class="fs-11px text-white">{{ $datas->store[0]['store'] }}</span> | <span
                        class="fs-11px text-white">RETAIL</span><br>
                    <span class="badge bg-default text-dark">KASIR : {{ $datas->users }}</span>
                </div>
            </td>
        @else
            <td align="center"><span class="fs-13px mt-2">{{ $current_page }}) </span></td>
            <td colspan="5" class="fw-bold pt-3 pb-3">
                <div align="left">
                    <span class="fs-12px text-yellow">{{ $datas->id_invoice }}</span> | {{ $datas->tanggal }}
                    {{-- <span style="padding-left: 5px;cursor: pointer;">
                        <i class="fa fa-print fa-lg text-info me-2 ms-2"></i>
                    </span>
                    <span style="padding-left: 5px;cursor: pointer;" onclick="cancel_order('{{ $datas->id_invoice }}')">
                        <i class="fa fa-times-circle fa-lg text-danger"></i>
                    </span> --}}
                    <br>
                    <span class="fs-11px text-white">{{ $datas->store[0]['store'] }}</span> | <span
                        class="fs-11px text-yellow">RESELLER
                        :</span><span class="ms-1 text-yellow">{{ $datas->id_reseller }}</span><br>
                    <span class="badge bg-default text-dark">KASIR : {{ $datas->users }}</span>
                </div>
            </td>
        @endif
        <td colspan="5" class="fw-bold fs-12px" align="right" style="padding-top: 20px;">
            <span class="fw-bold text-white">Profit :
                @php
                    $total_profit = 0;
                    
                @endphp
                @for ($i = 0; $i < count($datas->details2); $i++)
                    @php
                        $total_modal = $datas->details2[$i]['subtotal'] -  $datas->details2[$i]['cost'];
                        $total_profit = $total_profit + $total_modal;
                    @endphp
                @endfor
                <span class="text-lime">
                    @currency($total_profit)
                </span>
            </span>
        </td>
    </tr>
    {{-- Looping --}}
    @for ($i = 0; $i < count($datas->details2); $i++)
        <tr class="tr-custom">
            <td class="text-center fw-bold" style="border-right-width: 1px;">
                {{ $i + 1 }}
            </td>
            <td class="text-left fw-bold" style="border-right-width: 1px;">
                <span>{{ $datas->details2[$i]['produk'] }}</span>
            </td>
            <td class="text-center" style="border-right-width: 1px;">
                {{ $datas->details2[$i]['id_produk'] }}
            </td>
            <td class="text-center text-white fw-bold" style="border-right-width: 1px;">
                {{ $datas->details2[$i]['size'] }}
            </td>
            <td class="text-center text-white fw-bold" style="border-right-width: 1px;">
                {{ $datas->details2[$i]['qty'] }}
            </td>
            <td class="text-center text-info fw-bold" style="border-right-width: 1px;">
                @currency($datas->details2[$i]['cost'])
            </td>
            <td class="text-center fw-bold" style="border-right-width: 1px;">
                @currency($datas->details2[$i]['selling_price'])
            </td>
            <td class="text-center fw-bold" style="border-right-width: 1px;">
                @currency($datas->details2[$i]['diskon_item'])
            </td>
            <td colspan="4" class="text-center fw-bold" style="border-right-width: 1px;">
                @currency($datas->details2[$i]['subtotal'])
            </td>
        </tr>
    @endfor
    {{-- Looping --}}
    <tr class="tr-custom">
        <td colspan="8" style="border-bottom: hidden;border-left: hidden;"></td>
        <td class="text-center text-theme fw-bold fs-11px" style="border-left-width: 1px;border-right-width: 1px;">
            CASH
        </td>
        <td class="text-center text-primary fw-bold fs-11px" style="border-left-width: 1px;border-right-width: 1px;">
            BCA
        </td>
        <td class="text-center text-info fw-bold fs-11px" style="border-left-width: 1px;border-right-width: 1px;">
            QRIS
        </td>
    </tr>
    <tr class="tr-custom">
        <td colspan="8" style="border-bottom: hidden;border-left: hidden;"></td>
        <td class="text-center fw-bold fs-11px" style="border-left-width: 1px;border-right-width: 1px;">
            @currency($datas->cash)
        </td>
        <td class="text-center fw-bold fs-11px" style="border-left-width: 1px;border-right-width: 1px;">
            @currency($datas->bca)
        </td>
        <td class="text-center fw-bold fs-11px" style="border-left-width: 1px;border-right-width: 1px;">
            @currency($datas->qris)
        </td>
    </tr>

    <tr>
        <td colspan="9" style="border-bottom: hidden;border-left: hidden;"></td>
        <td class="fw-bold fs-12px" align="right" style="border-bottom: hidden;border-left: hidden;">
            Ongkir :
        </td>
        <td class="fw-bold fs-12px" align="right" style="border-bottom: hidden;border-left: hidden;">
            @currency($datas->ongkir)
        </td>
    </tr>
    <tr>
        <td colspan="9" style="border-bottom: hidden;border-left: hidden;"></td>
        <td class="fw-bold fs-12px" align="right" style="border-bottom: hidden;border-left: hidden;">
            Discount Nota :
        </td>
        <td class="fw-bold fs-12px" align="right" style="border-bottom: hidden;border-left: hidden;">
            @currency($datas->diskon_all)
        </td>
    </tr>
    <tr>
        <td colspan="9" style="border-bottom: hidden;border-left: hidden;"></td>
        <td class="fw-bold fs-12px" align="right" style="border-bottom: hidden;border-left: hidden;">
            Amount :
        </td>
        <td class="fw-bold fs-12px" align="right" style="border-bottom: hidden;border-left: hidden;">
            @currency($datas->grandtotal)
        </td>
    </tr>

    <tr style="border-bottom: 3px solid #797979;">
        <td colspan="9" style="padding-top: 5px;padding-bottom: 20px;">
        </td>
    </tr>

    {{ $current_page++ }}
@endforeach
@if ($count == 0)
    <tr style="width: 100%">
        <td colspan="11" align="center">
            No More Data...
        </td>
    </tr>
    <input type="hidden" name="last_id[]" value="last">
@else
    <input type="hidden" name="last_id[]" value="{{ $datas->id_invoice }}">
@endif

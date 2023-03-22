@foreach ($datapo as $key => $data)
    <tr>
        <td colspan="6" class="fw-bold " style="padding-top: 20px;">
            <span class="fs-12px">{{ $current_page }})</span>
            <span class="fs-12px text-lime">#{{ $data->tanggal }} - {{ $data->idpo }}
            </span>
            @if (Auth::user()->role === 'SUPER-ADMIN' or Auth::user()->role === 'HEAD-AREA')
                <span style="padding-left: 5px;cursor: pointer;" onclick="deleteModal({{ $data->idpo }})"><i
                        class="fa fa-times-circle fa-lg text-danger"></i>
                </span>
            @endif
        </td>
        <td colspan="3" class="fw-bold fs-12px" align="right" style="padding-top: 20px;">
            <span>USER : {{ $data->users }}</span>
        </td>
    </tr>
    <?php
    $total_qty = 0;
    $total_cost = 0;
    ?>
    @for ($i = 0; $i < count($data->suppliers_details); $i++)
        <?php
        $total_qty = $total_qty + $data->suppliers_details[$i]['qty'];
        $total_cost = $total_cost + $data->suppliers_details[$i]['subtotal'];
        ?>
        <tr class="tr-custom">
            <td class="text-center fw-bold" style="border-right-width: 1px;">
                {{ $i + 1 }}
            </td>
            <td class="text-left fw-bold" style="border-right-width: 1px;">
                {{ $data->suppliers_details[$i]['produk'] }}
                <span style="cursor: pointer;"
                    onclick="showQty('{{ $data->suppliers_details[$i]['id_produk'] }}','{{ $data->suppliers_details[$i]['idpo'] }}','{{ $data->suppliers_details[$i]['id_ware'] }}','{{ $data->suppliers_details[$i]['produk'] }}','{{ $data->suppliers_details[$i]['id_act'] }}')">
                    <i class="fas fa-lg fa-fw me-2 fa-eye text-success"></i>
                </span>
            </td>
            @if (Auth::user()->role === 'SUPER-ADMIN' or Auth::user()->role === 'HEAD-AREA')
                <td class="text-center" style="border-right-width: 1px;">
                    <?php
                if (count($data->products) > 0) {
                    ?>

                    <span style="cursor: pointer;margin-right:5px;"
                        onclick="editPo('{{ $data->suppliers_details[$i]['id_produk'] }}','{{ $data->suppliers_details[$i]['idpo'] }}','{{ $data->suppliers_details[$i]['id_ware'] }}','{{ $data->suppliers_details[$i]['produk'] }}','{{ $data->suppliers_details[$i]['id_act'] }}')">
                        <i class="fas fa-lg fa-edit text-info"></i>
                    </span>
                    <?php    
            }
                ?>

                    <span style="cursor: pointer;"onclick="deleteitemModal({{ $data->suppliers_details[$i]['id'] }})">
                        <i class="fas fa-lg fa-times-circle text-danger"></i>
                    </span>

                </td>
            @endif

            <td class="text-center text-yellow fw-bold" style="border-right-width: 1px;">
                <?php
                if ($data->suppliers_details[$i]['tipe_order'] === 'RELEASE') {
                    ?>
                <span class="text-lime">{{ $data->suppliers_details[$i]['tipe_order'] }}</span>
                <?php
                } else if ($data->suppliers_details[$i]['tipe_order'] === 'TRANSFER') {
                    ?>
                <span class="text-info">{{ $data->suppliers_details[$i]['tipe_order'] }}</span>
                <?php
                }else if ($data->suppliers_details[$i]['tipe_order'] === 'REPEAT') {
                    ?>
                <span class="text-warning">{{ $data->suppliers_details[$i]['tipe_order'] }}</span>
                <?php
                }else if ($data->suppliers_details[$i]['tipe_order'] === 'SO_GUDANG') {
                    ?>
                <span class="text-yellow">{{ $data->suppliers_details[$i]['tipe_order'] }}</span>
                <?php
                }
                
                ?>

            </td>

            <td class="text-center fw-bold" style="border-right-width: 1px;">
                @foreach ($warehouse as $key => $ware)
                    @if ($data->suppliers_details[$i]['id_ware'] === $ware->id_ware)
                        {{ $ware->warehouse }}
                    @endif
                @endforeach
            </td>

            <td class="text-center fw-bold" style="border-right-width: 1px;">
                <?php
                if (count($data->suppliers_detail) > 0) {
                    $supplier = $data->suppliers_detail[0]['supplier'];
                    echo $supplier;
                } else {
                    $supplier = $data->id_sup;
                    $result = explode('#', $supplier);
                    echo $result[1];
                }
                ?>
            </td>
            <td class="text-center fw-bold" style="border-right-width: 1px;">
                {{ $data->suppliers_details[$i]['qty'] }}
            </td>
            <td class="text-center fw-bold" style="border-right-width: 1px;">
                @currency($data->suppliers_details[$i]['m_price'])
            </td>
            <td class="text-center fw-bold" style="border-right-width: 1px;">
                @currency($data->suppliers_details[$i]['subtotal'])
            </td>

        </tr>
    @endfor

    <tr class="tr-custom">
        <td colspan="6" style="border-bottom: hidden;border-left: hidden;"></td>
        <td class="text-center fw-bold fs-12px" style="border-left-width: 1px;border-right-width: 1px;">
            QTY
        </td>
        <td colspan="2" class="text-right fw-bold fs-12px" style="border-left-width: 1px;border-right-width: 1px;"
            align="right">
            <span style="margin-right: 25px;">TOTAL COST</span>
        </td>
    </tr>
    <tr class="tr-custom">
        <td colspan="6" style="border-bottom: hidden;border-left: hidden;"></td>
        <td class="text-center text-white fw-bold fs-12px" style="border-left-width: 1px;border-right-width: 1px;">
            {{ $total_qty }}
        </td>
        <td colspan="2" class="text-right text-white fw-bold fs-12px"
            style="border-left-width: 1px;border-right-width: 1px;" align="right">
            <span style="margin-right: 25px;">@currency($total_cost)</span>
        </td>
    </tr>

    <tr style="border-bottom: 3px solid #797979;">
        <td colspan="8" style="padding-top: 5px;padding-bottom: 20px;">
        </td>
    </tr>
    {{ $current_page++ }}
@endforeach
@if ($count == 0)
    <tr style="width: 100%">
        <td colspan="10" align="center">
            No More Data...
        </td>
    </tr>
    <input type="hidden" name="last_id[]" value="last">
@else
    <input type="hidden" name="last_id[]" value="{{ $data->id }}">
@endif

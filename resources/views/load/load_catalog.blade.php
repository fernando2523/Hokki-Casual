<style>
    .badge1 {
        position: relative;
    }

    .badge1[data-badge]:after {
        content: attr(data-badge);
        position: absolute;
        top: 7px;
        left: 7px;
        font-size: .7em;
        background: rgb(183, 107, 0);
        color: white;
        width: 18px;
        height: 18px;
        text-align: center;
        line-height: 18px;
        box-shadow: 0 0 1px #333;
    }

    .badge2 {
        position: relative;
    }

    .badge2[data-badge]:after {
        content: attr(data-badge);
        position: absolute;
        top: 7px;
        left: 7px;
        font-size: .7em;
        background: rgb(0, 128, 2);
        color: white;
        width: 18px;
        height: 18px;
        text-align: center;
        line-height: 18px;
        box-shadow: 0 0 1px #333;
    }

    .badge3 {
        position: relative;
    }

    .badge3[data-badge]:after {
        content: attr(data-badge);
        position: absolute;
        top: 7px;
        left: 7px;
        font-size: .7em;
        background: rgb(2, 0, 128);
        color: white;
        width: 18px;
        height: 18px;
        text-align: center;
        line-height: 18px;
        box-shadow: 0 0 1px #333;
    }
</style>


@foreach ($data as $product)
    <?php
    if ($product->image_product[0]['img'] == '') {
        $image_product = 'defaultimg.png';
    } else {
        $image_product = $product->image_product[0]['img'];
    }
    
    ?>

    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 pb-4">
        <!-- BEGIN card -->
        <div class="card open-modal" style="height: 100%" data-md_nameproduct="{{ $product->produk }}"
            data-image_product="{{ $image_product }}" data-md_warehouse="{{ $product->warehouse[0]['warehouse'] }}"
            data-md_price="{{ $image_product }}" data-id_produk="{{ $product->id_produk }}"
            data-id_area="{{ $product->id_area }}" data-id_brand="{{ $product->brand }}"
            data-quality="{{ $product->quality }}" data-n_price="{{ $product->n_price }}"
            data-r_price="{{ $product->r_price }}" data-g_price="{{ $product->g_price }}">
            @if ($product->quality == 'LOKAL')
                <div class="card-body p-1 badge1" data-badge="L" style="cursor: pointer;">
                @elseif ($product->quality == 'IMPORT')
                    <div class="card-body p-1 badge2" data-badge="I" style="cursor: pointer;">
                    @elseif ($product->quality == 'ORIGINAL')
                        <div class="card-body p-1 badge3" data-badge="O" style="cursor: pointer;">
            @endif
            <div class="img p-1">
                <img src="/product/{{ $image_product }}" width="100%" height="100%">
            </div>

            <div class="text-center h-20">
                <span class="fs-12px">{{ $product->produk }}</span>
            </div>
        </div>
        <div class="card-arrow">
            <div class="card-arrow-top-left"></div>
            <div class="card-arrow-top-right"></div>
            <div class="card-arrow-bottom-left"></div>
            <div class="card-arrow-bottom-right"></div>
        </div>
    </div>
    <!-- END card -->
    </div>
@endforeach
@if (count($data) === 0)
    <center>No More Data...</center>
    <input type="hidden" name="last_id[]" value="last">
@else
    <input type="hidden" name="last_id[]" value="loaded">
@endif

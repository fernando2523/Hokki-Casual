<div class="col-3">
    <div class="row">
        <div class="col-xl-6 mb-6">
            <div class="card">
                <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                    <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                        <div class="mb-1 text-default fw-bold text-center">NOTA</div>
                        <h4 class="text-white fs-12px text-center">{{ $nota[0]['id_invoice'] }} NOTA
                        </h4>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <!-- END -->
        <div class="col-xl-6 mb-6">
            <div class="card">
                <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                    <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                        <div class="mb-1 text-default fw-bold text-center">QTY</div>
                        <h4 class="text-white fs-12px text-center">{{ number_format($qty, 0, ',', '.') }} PCS
                        </h4>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-9">
    <div class="row">
        <div class="col-xl-2 mb-6">
            <div class="card">
                <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                    <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                        <div class="text-default mb-1 fw-bold text-center">ONGKIR</div>
                        <h4 class="text-default fs-12px text-center">
                            <?php $total_ongkir = 0; ?>
                            @foreach ($ongkir as $ongkirs)
                                <?php
                                $total_ongkir = $total_ongkir + intval($ongkirs->ongkir);
                                ?>
                            @endforeach
                            @currency($total_ongkir)
                        </h4>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 mb-6">
            <div class="card">
                <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                    <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                        <div class="text-default mb-1 fw-bold text-center">GROSS SALE</div>
                        <h4 class="text-white fs-12px text-center">
                            @php
                                $total_gross_sale = 0;
                            @endphp
                            @foreach ($gross_sale as $gross_sales)
                                @php
                                    $total_gross_sale = $total_gross_sale + intval($gross_sales->qty * $gross_sales->selling_price);
                                @endphp
                            @endforeach
                            @currency($total_gross_sale)
                        </h4>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 mb-6">
            <div class="card">
                <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                    <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                        <div class="text-default mb-1 fw-bold text-center">EXPENSES</div>
                        <h4 class="text-red fs-12px text-center">@currency($expenses)</h4>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 mb-6">
            <div class="card">
                <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                    <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                        <div class="text-default mb-1 fw-bold text-center">DISCOUNT</div>
                        {{-- <h4 class="text-yellow fs-12px text-center">@currency($discount)</h4> --}}
                        <h4 class="text-yellow fs-12px text-center">
                            @php
                                $total_diskon = 0;
                            @endphp
                            @foreach ($discount_all as $discount_alls)
                                @php
                                    $total_diskon = $total_diskon + intval($discount_alls->diskon_all);
                                @endphp
                            @endforeach
                            @currency($discount_item + $total_diskon)
                        </h4>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 mb-6">
            <div class="card">
                <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                    <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                        <div class="text-default mb-1 fw-bold text-center">NET SALES</div>
                        <h4 class="text-info fs-12px text-center">@currency($total_gross_sale - $expenses - ($discount_item + $total_diskon))</h4>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
    </div>
</div>

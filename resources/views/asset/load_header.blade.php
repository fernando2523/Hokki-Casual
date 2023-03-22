<div class="col-xl-2 mb-6">
    <div class="card">
        <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
            <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                <div class="mb-1 fw-bold">RELEASE</div>
                @if ($qtyrelease[0]->qtyreleases === null or $qtyrelease[0]->qtyreleases === '0')
                    <h4 class="text-theme">0</h4>
                @else
                    <h4 class="text-theme">{{ $qtyrelease[0]->qtyreleases }}</h4>
                @endif
            </div>
            <div class="opacity-5">
                <i class="bi bi-award fa-3x"></i>
            </div>
        </div>

        <!-- card-arrow -->
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
        <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
            <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                <div class="mb-1 fw-bold">REPEAT</div>
                @if ($qtyrepeat[0]->qtyrepeats === null or $qtyrepeat[0]->qtyrepeats === '0')
                    <h4 class="text-theme">0</h4>
                @else
                    <h4 class="text-theme">{{ $qtyrepeat[0]->qtyrepeats }}</h4>
                @endif
            </div>
            <div class="opacity-5">
                <i class="bi bi-award-fill fa-3x"></i>
            </div>
        </div>

        <!-- card-arrow -->
        <div class="card-arrow">
            <div class="card-arrow-top-left"></div>
            <div class="card-arrow-top-right"></div>
            <div class="card-arrow-bottom-left"></div>
            <div class="card-arrow-bottom-right"></div>
        </div>
    </div>
</div>
<!-- END -->
<div class="col-xl-2 mb-6">
    <div class="card">
        <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
            <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                <div class="mb-1 fw-bold">TRANSFER</div>
                @if ($qtytransfer[0]->qtytransfers === null or $qtytransfer[0]->qtytransfers === '0')
                    <h4 class="text-theme">0</h4>
                @else
                    <h4 class="text-theme">{{ $qtytransfer[0]->qtytransfers }}</h4>
                @endif
            </div>
            <div class="opacity-5">
                <i class="fa fa-exchange-alt fa-2x"></i>
            </div>
        </div>

        <!-- card-arrow -->
        <div class="card-arrow">
            <div class="card-arrow-top-left"></div>
            <div class="card-arrow-top-right"></div>
            <div class="card-arrow-bottom-left"></div>
            <div class="card-arrow-bottom-right"></div>
        </div>
    </div>
</div>
<!-- END -->

<!-- TOTAL STOCK -->
<div class="col-xl-3 mb-6">
    <div class="card">
        <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
            <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                <div class="mb-1 fw-bold">STOCK ASSETS QUANTITY</div>
                @if ($qtyasset[0]->totalqty === null or $qtyasset[0]->totalqty === '0')
                    <h4 class="text-theme">0</h4>
                @else
                    <h4 class="text-theme">{{ $qtyasset[0]->totalqty }}</h4>
                @endif
            </div>
            <div class="opacity-5">
                <i class="fa fa-cube fa-3x"></i>
            </div>
        </div>

        <!-- card-arrow -->
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
        <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
            <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                <div class="mb-1 fw-bold">ASSETS VALUATION</div>
                <h4 class="text-theme">
                    <?php $totalmodal = 0; ?>
                    @foreach ($assets_valuation as $assets_valuations)
                        @php
                            $totalmodal = $totalmodal + $assets_valuations->qty * $assets_valuations->supplier[0]['m_price'];
                        @endphp
                    @endforeach

                    @currency($totalmodal)
                </h4>
            </div>
            <div class="opacity-5">
                <i class="bi bi-cash-stack fa-3x"></i>
            </div>
        </div>

        <!-- card-arrow -->
        <div class="card-arrow">
            <div class="card-arrow-top-left"></div>
            <div class="card-arrow-top-right"></div>
            <div class="card-arrow-bottom-left"></div>
            <div class="card-arrow-bottom-right"></div>
        </div>
    </div>
</div>

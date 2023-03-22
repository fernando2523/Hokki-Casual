{{-- {{ $store . ' ' . $start . ' ' . $end }} --}}
<div class="row">
    <!-- BEGIN col-3 -->
    <div class="col-xl-12 col-lg-6">
        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <!-- BEGIN card -->
                <div class="card mb-3">

                    <div class="card-body row">
                        <div class="col-8">
                            <div class="d-flex fw-bold small mb-3">
                                <span class="flex-grow-1">SALES</span>
                            </div>
                            <div class="row align-items-center mb-2">
                                <h3 class="mb-0 fs-14px">{{ $get_sales }} Sales</h3>
                            </div>
                        </div>
                        <div class="col-3" align="right">
                            <i class="bi bi-receipt-cutoff fa-3x  text-theme"></i>
                        </div>
                    </div>

                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                    <!-- END card-arrow -->
                </div>
                <!-- END card -->
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card mb-3">

                    <div class="card-body row">
                        <div class="col-8">
                            <div class="d-flex fw-bold small mb-3">
                                <span class="flex-grow-1">QTY</span>
                            </div>
                            <div class="row align-items-center mb-2">
                                <h3 class="mb-0 fs-14px">{{ $get_qty }} Pcs</h3>
                            </div>
                        </div>
                        <div class="col-3" align="right">
                            <i class="bi bi-box fa-3x  text-theme"></i>
                        </div>
                    </div>

                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                    <!-- END card-arrow -->
                </div>
                <!-- END card -->
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card mb-3">

                    <div class="card-body row">
                        <div class="col-8">
                            <div class="d-flex fw-bold small mb-3">
                                <span class="flex-grow-1">EXPENDITURE</span>
                            </div>
                            <div class="row align-items-center mb-2">
                                @if ($get_expense > 0)
                                    <h3 class="mb-0 fs-14px">@currency($get_expense)</h3>
                                @else
                                    <h3 class="mb-0 fs-14px">Rp 0</h3>
                                @endif
                            </div>
                        </div>
                        <div class="col-3" align="right">
                            <i class="bi bi-cash-stack fa-3x  text-theme"></i>
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

            <div class="col-xl-3 col-lg-6">
                <!-- BEGIN card -->
                <div class="card mb-3">

                    <div class="card-body row">
                        <div class="col-8">
                            <div class="d-flex fw-bold small mb-3">
                                <span class="flex-grow-1">REVENUE</span>
                            </div>
                            <div class="row align-items-center mb-0">
                                <h3 class="mb-0 fs-14px">@currency($getTotalpayment)</h3>
                            </div>
                        </div>
                        <div class="col-3" align="right">
                            <i class="bi bi-currency-dollar fa-3x text-theme"></i>
                        </div>
                    </div>

                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                    <!-- END card-arrow -->
                </div>
                <!-- END card -->
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-6">
        <div class="row">
            <div class="col-xl-2 col-lg-6">
                <!-- BEGIN card -->
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body" align="center">
                        <!-- BEGIN title -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1 text-success">CASH</span>
                        </div>
                        <!-- END title -->
                        <!-- BEGIN stat-lg -->
                        <div class="row align-items-center mb-2">
                            <div class="col-12">
                                @currency($cash)
                            </div>
                        </div>
                        <!-- END stat-lg -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                    <!-- END card-arrow -->
                </div>
                <!-- END card -->
            </div>

            <div class="col-xl-2 col-lg-6">
                <!-- BEGIN card -->
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body" align="center">
                        <!-- BEGIN title -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1 text-info">BCA</span>
                        </div>
                        <!-- END title -->
                        <!-- BEGIN stat-lg -->
                        <div class="row align-items-center mb-2">
                            <div class="col-12">
                                @currency($bca)
                            </div>
                        </div>
                        <!-- END stat-lg -->
                        <!-- BEGIN stat-sm -->
                        <!-- END stat-sm -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                    <!-- END card-arrow -->
                </div>


            </div>

            <div class="col-xl-2 col-lg-6">
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body" align="center">
                        <!-- BEGIN title -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1" style="color: cyan;">MANDIRI</span>
                        </div>
                        <!-- END title -->
                        <!-- BEGIN stat-lg -->
                        <div class="row align-items-center mb-2">
                            <div class="col-12">
                                @currency($mandiri)
                            </div>
                        </div>
                        <!-- END stat-lg -->
                        <!-- BEGIN stat-sm -->
                        <!-- END stat-sm -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                    <!-- END card-arrow -->
                </div>
                <!-- END card -->
            </div>

            <div class="col-xl-2 col-lg-6">
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body" align="center">
                        <!-- BEGIN title -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1" style="color: cyan;">QRIS</span>
                        </div>
                        <!-- END title -->
                        <!-- BEGIN stat-lg -->
                        <div class="row align-items-center mb-2">
                            <div class="col-12">
                                @currency($qris)
                            </div>
                        </div>
                        <!-- END stat-lg -->
                        <!-- BEGIN stat-sm -->
                        <!-- END stat-sm -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                    <!-- END card-arrow -->
                </div>
                <!-- END card -->
            </div>

            <div class="col-xl-4 col-lg-6">
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body" align="center">
                        <div class="d-flex fw-bold small">
                            <span class="flex-grow-1 text-lime">TOTAL PAYMENT</span>
                        </div>
                        <div class="row align-items-center mb-2 mt-3">
                            <div class="col-12">
                                <h3 class="mb-0 fs-14px">@currency($totalpayment)</h3>
                            </div>
                        </div>
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                    <!-- END card-arrow -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6">
        <div class="card mb-3">
            <div class="card-body" style="height: 460px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">TOP 10 PRODUCTS</span>
                    <a href="#" data-toggle="card-expand"
                        class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless mb-2px small text-nowrap">
                        <tbody>
                            @foreach ($getTop_product as $topProduct)
                                <tr>
                                    <td width="70%">
                                        <span class="d-flex align-items-center"
                                            style="font-size: 11px;font-weight: bold;">
                                            <i class="bi bi-circle-fill fs-6px text-success me-2"></i>
                                            {{ $topProduct->produk }}
                                        </span>
                                    </td>
                                    <td class="text-right" align="right" width="20%" style="font-weight: bold;">
                                        <small>{{ $topProduct->id_brand }}</small>
                                    </td>
                                    <td align="right" width="10%">
                                        <span class="badge d-block bg-success bg-opacity-75 rounded-0 pt-5px w-100px"
                                            style="min-height: 18px;font-size: 10px;">
                                            {{ $topProduct->qtys }} Pcs
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <ul align="right" class="mt-3">
                        <a type="button" href="#" class="btn btn-outline-theme btn-sm">See
                            All</a>
                    </ul> --}}
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

    <div class="col-xl-6">
        <div class="card mb-3">
            <div class="card-body" style="height: 460px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">TOP 10 RESELLER</span>
                    <a href="#" data-toggle="card-expand"
                        class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless mb-2px small text-nowrap">
                        <tbody>
                            @foreach ($getTop_reseller as $topReseller)
                                <tr>
                                    <td width="80%">
                                        <span class="d-flex align-items-center"
                                            style="font-size: 11px;font-weight: bold;">

                                            <i class="bi bi-circle-fill fs-6px text-success me-2"></i>
                                            {{ $topReseller->id_reseller }}
                                        </span>
                                    </td>
                                    <td align="right" width="20%">
                                        <span class="badge d-block bg-success bg-opacity-75 rounded-0 pt-5px w-150px"
                                            style="min-height: 18px;font-size: 10px;">
                                            {{ $topProduct->qtys }} Pcs
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <ul align="right" class="mt-3">
                        <a type="button" href="#" class="btn btn-outline-theme btn-sm">See All</a>
                    </ul> --}}
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

{{-- <div class="row">
    <div class="col-xl-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">REPORT EARNING</span>
                </div>
                <div class="ratio ratio-21x9 mb-3">
                    <div id="chart-server"></div>
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
</div> --}}

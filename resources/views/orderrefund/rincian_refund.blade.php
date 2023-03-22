<div class="row">
    @if ($getdata[0]->customer === 'RESELLER')
        <div class="col-xl-12 mb-3">
            <div class="card" align="center">
                <div class="card-body d-flex align-items-center text-white m-5px bg-success bg-opacity-10">
                    <div class="flex-fill">
                        <h5 class="text-white" style="margin-bottom: -2px;">{{ $getdata[0]->id_reseller }}</h5>
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
    @endif

    <div class="col-xl-2 mb-3">
        <div class="card" align="center">
            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15"
                style="padding-top: 5px;padding-bottom: 0px;">
                <div class="flex-fill">
                    <div class="mb-1 fw-bold text-default">TANGGAL</div>
                    <h5 class="text-white">{{ $getdata[0]->tanggal }}</h5>
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
    <div class="col-xl-3 mb-3">
        <div class="card" align="center">
            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15"
                style="padding-top: 5px;padding-bottom: 0px;">
                <div class="flex-fill">
                    <div class="mb-1 fw-bold text-default">STORE</div>
                    <h5 class="text-white">{{ $getstore[0]->store }}</h5>
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
    <div class="col-xl-2 mb-3">
        <div class="card" align="center">
            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15"
                style="padding-top: 5px;padding-bottom: 0px;">
                <div class="flex-fill">
                    <div class="mb-1 fw-bold text-default">TOTAL QTY</div>
                    <h5 class="text-white">{{ $getdata[0]->totalqty }} PCS</h5>
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
    <div class="col-xl-2 mb-3">
        <div class="card" align="center">
            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15"
                style="padding-top: 5px;padding-bottom: 0px;">
                <div class="flex-fill">
                    <div class="mb-1 fw-bold text-default">DISCOUNT</div>
                    <h5 class="text-warning">@currency($discount)</h5>
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
    <div class="col-xl-3 mb-3">
        <div class="card" align="center">
            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15"
                style="padding-top: 5px;padding-bottom: 0px;">
                <div class="flex-fill">
                    <div class="mb-1 fw-bold text-default">TOTAL SALES</div>
                    <h5 class="text-white">@currency($getdata[0]->grandtotals)</h5>
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

    <div class="col-xl-4 mb-3">
        <div class="card" align="center">
            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15"
                style="padding-top: 5px;padding-bottom: 0px;">
                <div class="flex-fill">
                    <div class="mb-1 fw-bold text-lime">CASH</div>
                    <h5 class="text-white">@currency($getdata[0]->cash)</h5>
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

    <div class="col-xl-4 mb-3">
        <div class="card" align="center">
            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15"
                style="padding-top: 5px;padding-bottom: 0px;">
                <div class="flex-fill">
                    <div class="mb-1 fw-bold text-info">BCA</div>
                    <h5 class="text-white">@currency($getdata[0]->bca)</h5>
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

    <div class="col-xl-4">
        <div class="card" align="center">
            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15"
                style="padding-top: 5px;padding-bottom: 0px;">
                <div class="flex-fill">
                    <div class="mb-1 fw-bold" style="color: cyan;">QRIS</div>
                    <h5 class="text-white">@currency($getdata[0]->qris)</h5>
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

<div class="row">
    <!-- DATA ASSSET -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body p-3" style="height: auto;">
                <div class="input-group mb-3">
                    <div class="flex-fill position-relative">
                        <div class="input-group">
                            <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                style="z-index: 1020;">
                                <i class="fa fa-search opacity-5"></i>
                            </div>
                            <input type="text" class="form-control form-control-sm ps-35px"
                                id="search_rincianrefund" placeholder="Search.." />
                        </div>
                    </div>
                </div>
                <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_rincianrefund">
                    <thead style="font-size: 11px;">
                        <tr>
                            <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO
                            </th>
                            <th class="text-center" width="50%" style="color: #a8b6bc !important;">PRODUCT
                            </th>
                            <th class="text-center" width="5%" style="color: #a8b6bc !important;">SIZE
                            </th>
                            <th class="text-center" width="5%" style="color: #a8b6bc !important;">QTY
                            </th>
                        </tr>
                    </thead>

                    <tbody style="font-size: 11px;">
                    </tbody>
                </table>
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
</div>

<div class="row mt-3">
    <div class="col-xl-12 mb-6">
        <div class="card">
            <textarea class="form-control text-center form-control-sm text-white fw-bold" type="text" placeholder="Opsional.."
                autocomplete="OFF" rows="3" readonly>{{ $desc }} </textarea>

            <!-- card-arrow -->
            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
        </div>
    </div>
</div>

<link href="{{ URL::asset('/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"
    rel="stylesheet" />
<link href="{{ URL::asset('/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
    rel="stylesheet" />
<link href="{{ URL::asset('/assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}"
    rel="stylesheet" />

<script src="{{ URL::asset('/assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
</script>

<script type="text/javascript">
    $(function() {
        var table = $('#tb_rincianrefund').DataTable({
            lengthMenu: [10],
            responsive: true,
            processing: false,
            serverSide: true,
            ajax: "/table_rincian_refund/{{ $id_transaction }}",
            columns: [{
                data: 'DT_RowIndex',
                name: 'id',
                class: 'text-center fw-bold',
                searchable: false
            }, {
                data: 'produk',
                name: 'produk',
                class: 'text-center fw-bold',
                searchable: true
            }, {
                data: 'size',
                name: 'size',
                class: 'text-center fw-bold',
                searchable: true
            }, {
                data: 'qty',
                name: 'qty',
                class: 'text-center fw-bold',
                searchable: true
            }, ],
            dom: 'tip',
            // "ordering" : true,
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                    orderable: false,
                    targets: [0]
                },

            ],
        });

        $('#search_rincianrefund').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
    // end
</script>

  <!-- DATA ASSSET -->
  {{-- {{ $store . ' ' . $start . ' ' . $end }} --}}
  <div class="row mb-3">
      <div class="col-12">
          <div class="row">
              <div class="col-xl-2 mb-3">
                  <div class="card">
                      <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                          <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                              <div class="mb-1 text-default fw-bold text-center">QTY</div>
                              <h4 class="text-white fs-12px text-center">
                                  {{ $get_qty }} PCS
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
                              <div class="text-default mb-1 fw-bold text-center">GROSS SALE</div>
                              <h4 class="text-default fs-12px text-center">
                                  @php
                                      $total_gross = 0;
                                  @endphp
                                  @foreach ($get_gross as $gross)
                                      @php
                                          $total_gross = $total_gross + intval($gross->qty * $gross->selling_price);
                                      @endphp
                                  @endforeach
                                  @currency($total_gross)
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
                              <div class="text-default mb-1 fw-bold text-center">DISCOUNT</div>
                              <h4 class="text-yellow fs-12px text-center">
                                  @currency($get_discitem)
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
                              <div class="text-default mb-1 fw-bold text-center">NET SALES</div>
                              <h4 class="text-white fs-12px text-center">
                                  @php
                                      $netsales = $total_gross - $get_discitem;
                                  @endphp
                                  @currency($netsales)
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
                              <div class="text-default mb-1 fw-bold text-center">COSTS</div>
                              <h4 class="text-indigo fs-12px text-center">
                                  @php
                                      $total_cost = 0;
                                  @endphp
                                  @foreach ($get_costs as $costs)
                                      @php
                                          $total_cost = $total_cost + intval($costs->qty * $costs->m_price);
                                      @endphp
                                  @endforeach
                                  @currency($total_cost)
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
                              <div class="text-default mb-1 fw-bold text-center">PROFIT </div>
                              <h4 class="text-lime fs-12px text-center">
                                  @php
                                      $profit = $netsales - $total_cost;
                                  @endphp
                                  @currency($profit)
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
  </div>

  <div class="row">
      <div class="col-xl-12">
          <div class="card">
              <div class="card-body p-3">
                  <div class="input-group mb-3">
                      <div class="flex-fill position-relative">
                          <div class="input-group">
                              <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                  style="z-index: 1020;">
                                  <i class="fa fa-search opacity-5"></i>
                              </div>
                              <input type="text" class="form-control form-control-sm ps-35px" id="search_product"
                                  placeholder="Search products.." />
                          </div>
                      </div>
                  </div>
                  <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_product">
                      <thead style="font-size: 11px;">
                          <tr>
                              <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO
                              </th>
                              <th class="text-center" width="2%" style="color: #a8b6bc !important;">IMAGE
                              </th>
                              <th class="text-center" width="30%" style="color: #a8b6bc !important;">NAME
                              </th>
                              </th>
                              <th class="text-center" width="5%" style="color: #a8b6bc !important;">QTY
                              </th>
                              <th class="text-center" width="15%" style="color: #a8b6bc !important;">GROSS SALE
                              </th>
                              <th class="text-center" width="10%" style="color: #a8b6bc !important;">DISC ITEM
                              </th>
                              <th class="text-center" width="15%" style="color: #a8b6bc !important;">NET SALE
                              </th>
                              <th class="text-center" width="10%" style="color: #a8b6bc !important;">COST
                              </th>
                              <th class="text-center" width="15%" style="color: #a8b6bc !important;">PROFIT
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
              {{-- <input type="text" value="{{ $store }}" id="store2">
          <input type="text" value="{{ $start }}" id="start2">
          <input type="text" value="{{ $end }}" id="end2"> --}}
          </div>
      </div>
  </div>
  <!-- END -->
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
          var table = $('#tb_product').DataTable({
              lengthMenu: [15],
              responsive: true,
              processing: false,
              serverSide: true,
              ajax: "/tablereportproduct/{{ $store }}/{{ $start }}/{{ $end }}",
              columns: [{
                      data: 'DT_RowIndex',
                      name: 'id',
                      class: 'text-center fw-bold',
                      searchable: false
                  },  {
                      data: 'image_product',
                      name: 'image_product',
                      class: 'text-center',
                      "render": function(data, type, row) {
                        if (data.length > 0) {
                            var img = row.image_product[0]['img'];
                        } else {
                            var img = "";
                        }

                          if (img === "") {
                              return '<span><img src="/product/defaultimg.png" alt="" width="100" height="100" class="rounded"></span><span class="fw-bold text-default"><br>' +
                                  row.id_produk + '</span>';
                          } else {
                              return '<span><img src="/product/' + row.image_product[0]['img'] +
                                  '" alt="" width="95"  height="95" class="rounded"></span><span class="fw-bold text-default"><br>' +
                                  row.id_produk + '</span>';
                          }
                      },
                  }, {
                      data: 'produk',
                      name: 'produk',
                      class: 'text-left  fw-bold',
                      searchable: true,
                      "render": function(data, type, row, meta) {
                          return '<span class="fw-bold fs-14px text-white">' + row
                              .produk +
                              '</span><br><span class="fw-bold"><span class="fw-bold">' +
                              row.id_brand +
                              '</span>';
                      },
                  }, {
                      data: 'qty',
                      name: 'qty',
                      class: 'text-center fw-bold',
                      searchable: false,
                    //   "render": function(data, type, row, meta) {
                    //       return row.qtys[0]['qty'];
                    //   },
                  }, {
                      data: 'gross',
                      name: 'gross',
                      class: 'text-center fw-bold',
                      searchable: true,
                      "render": function(data, type, row, meta) {
                          let rupiah = Intl.NumberFormat('id-ID');

                          gross = 0;
                          for (i = 0; i < row.gross.length; i++) {
                              gross = parseInt(gross) + (parseInt(row
                                  .gross[i][
                                      'qty'
                                  ]) * parseInt(row
                                  .gross[i][
                                      'selling_price'
                                  ]));
                          }
                          totalgross = gross;

                          return rupiah.format(totalgross);
                      },
                  }, {
                      data: 'disc_item',
                      name: 'disc_item',
                      class: 'text-center fw-bold',
                      searchable: true,
                      "render": function(data, type, row, meta) {
                          let rupiah = Intl.NumberFormat('id-ID');

                          return rupiah.format(row.disc_item[0]['disc']);
                      },
                  },
                  {
                      data: 'gross',
                      name: 'gross',
                      class: 'text-center fw-bold',
                      searchable: true,
                      "render": function(data, type, row, meta) {
                          let rupiah = Intl.NumberFormat('id-ID');

                          gross = 0;
                          for (i = 0; i < row.gross.length; i++) {
                              gross = parseInt(gross) + (parseInt(row
                                  .gross[i][
                                      'qty'
                                  ]) * parseInt(row
                                  .gross[i][
                                      'selling_price'
                                  ]));
                          }
                          netsales = gross - row.disc_item[0]['disc'];

                          return rupiah.format(netsales);
                      },
                  },
                  {
                      data: 'costs',
                      name: 'costs',
                      class: 'text-center fw-bold',
                      searchable: true,
                      "render": function(data, type, row, meta) {
                          let rupiah = Intl.NumberFormat('id-ID');

                          costs = 0;
                          for (i = 0; i < row.costs.length; i++) {
                              costs = parseInt(costs) + (parseInt(row
                                  .costs[i][
                                      'qty'
                                  ]) * parseInt(row
                                  .costs[i][
                                      'm_price'
                                  ]));
                          }
                          totalcosts = costs;

                          return rupiah.format(totalcosts);
                      },
                  },
                  {
                      data: 'profit',
                      name: 'profit',
                      class: 'text-center fw-bold',
                      searchable: true,
                      "render": function(data, type, row, meta) {
                          let rupiah = Intl.NumberFormat('id-ID');

                          gross = 0;
                          for (i = 0; i < row.gross.length; i++) {
                              gross = parseInt(gross) + (parseInt(row
                                  .gross[i][
                                      'qty'
                                  ]) * parseInt(row
                                  .gross[i][
                                      'selling_price'
                                  ]));
                          }
                          netsales = gross - row.disc_item[0]['disc'];

                          costs = 0;
                          for (i = 0; i < row.costs.length; i++) {
                              costs = parseInt(costs) + (parseInt(row
                                  .costs[i][
                                      'qty'
                                  ]) * parseInt(row
                                  .costs[i][
                                      'm_price'
                                  ]));
                          }
                          totalcosts = costs;

                          totalprofit = netsales - totalcosts;

                          return rupiah.format(totalprofit);
                      },
                  },
              ],
              dom: 'tip',
              // "ordering" : true,
              order: [
                  [0, 'desc']
              ],
              columnDefs: [{
                      orderable: false,
                      targets: [1]
                  },

              ],
          });

          $('#search_product').on('keyup', function() {
              table.search(this.value).draw();
          });
      });
      // end
  </script>

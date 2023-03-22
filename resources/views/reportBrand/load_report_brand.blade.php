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
      <!-- DATA ASSSET -->
      <div class="col-xl-12">
          <div class="card">
              <div class="card-body p-3">
                  <!-- BEGIN input-group -->
                  <div class="input-group mb-3">
                      <div class="flex-fill position-relative">
                          <div class="input-group">
                              <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                  style="z-index: 1020;">
                                  <i class="fa fa-search opacity-5"></i>
                              </div>
                              <input type="text" class="form-control form-control-sm ps-35px" id="search_brand"
                                  placeholder="Search brand.." />
                          </div>
                      </div>
                  </div>
                  <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_brand">
                      <thead style="font-size: 11px;">
                          <tr>
                              <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO
                              </th>
                              <th class="text-left" width="30%" style="color: #a8b6bc !important;">BRAND
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
          </div>
      </div>
      <!-- END -->
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
          var table = $('#tb_brand').DataTable({
              lengthMenu: [15],
              responsive: true,
              processing: false,
              serverSide: true,
              ajax: "/tablereportbrand/{{ $store }}/{{ $start }}/{{ $end }}",
              columns: [{
                  data: 'DT_RowIndex',
                  name: 'id',
                  class: 'text-center fw-bold',
                  searchable: false
              }, {
                  data: 'id_brand',
                  name: 'id_brand',
                  class: 'text-left fw-bold text-white',
                  searchable: true,
              }, {
                  data: 'qty',
                  name: 'qty',
                  class: 'text-center fw-bold',
                  searchable: true,
                  "render": function(data, type, row, meta) {
                      return row.qty;
                  },
              }, {
                  data: 'selling_price',
                  name: 'selling_price',
                  class: 'text-center fw-bold',
                  searchable: true,
                  "render": function(data, type, row, meta) {
                      let rupiah = Intl.NumberFormat('id-ID');

                      return rupiah.format(row.selling_price);
                  },
              }, {
                  data: 'diskon_item',
                  name: 'diskon_item',
                  class: 'text-center fw-bold',
                  searchable: true,
                  "render": function(data, type, row, meta) {
                      let rupiah = Intl.NumberFormat('id-ID');

                      return rupiah.format(row.diskon_item);
                  },
              }, {
                  data: 'selling_price',
                  name: 'netsales',
                  class: 'text-center fw-bold',
                  searchable: true,
                  "render": function(data, type, row, meta) {
                      let rupiah = Intl.NumberFormat('id-ID');

                      netsales = row.selling_price - row.diskon_item

                      return rupiah.format(netsales);
                  },
              }, {
                  data: 'costs',
                  name: 'costs',
                  class: 'text-center fw-bold',
                  searchable: true,
                  "render": function(data, type, row, meta) {
                      let rupiah = Intl.NumberFormat('id-ID');

                      return rupiah.format(row.costs);
                  },
              }, {
                  data: 'costs',
                  name: 'profit',
                  class: 'text-center fw-bold',
                  searchable: true,
                  "render": function(data, type, row, meta) {
                      let rupiah = Intl.NumberFormat('id-ID');

                      netsales = row.selling_price - row.diskon_item

                      totalprofit = netsales - row.costs

                      return rupiah.format(totalprofit);
                  },
              }, ],
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

          $('#search_brand').on('keyup', function() {
              table.search(this.value).draw();
          });
      });
      // end
  </script>

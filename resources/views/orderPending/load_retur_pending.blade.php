 <!-- default table -->
 <input class="form-control" type="hidden" id="r_id_invoice" name="r_id_invoice" value="{{ $id_invoice }}">
 <input class="form-control" type="hidden" id="r_count" name="r_count" value="{{ $count }}">
 <table class="table table-borderless w-100 mb-0" id="table_retur">
     <thead>
         <tr>
             <th width="32%">Product</th>
             <th class="text-center" width="30%">Gudang</th>
             <th class="text-center" width="20%">Size Baru</th>
             <th class="text-center" width="10%">Qty</th>
             <th class="text-center" width="8%">Act</th>
         </tr>
     </thead>
     <tbody class="align-middle" id="table_retur_body">
         <tr class="text-center">
             <td>
                 <select class="form-select" name="r_produk[]" id="r_produk0" onchange="validate_product(this)">
                     <option data-max="KOSONG" value="" disabled selected>Pilih Product...</option>
                     @foreach ($data as $datas)
                         <option data-max="{{ $datas->qty }}" value="{{ $datas->id }}">{{ $datas->produk }}
                             ({{ $datas->size }}={{ $datas->qty }})
                         </option>
                     @endforeach
                 </select>
             </td>
             <td>
                 <select class="form-select" name="r_ware[]" id="r_ware0" disabled onchange="cek_size(this)">
                     <option data-max="KOSONG" value="" disabled selected>Pilih Gudang</option>
                 </select>
             </td>
             <td>
                 <select class="form-select" name="r_size[]" id="r_size0" disabled>
                     <option data-max="KOSONG" value="" disabled selected>Pilih Size</option>
                 </select>
             </td>
             <td>
                 <div class="d-flex">
                     <button type="button" class="btn btn-outline-theme" onclick="change_qty(this,'minus')">
                         <i class="fa fa-minus"></i>
                     </button>
                     <input type="text" class="form-control w-50px fw-bold mx-2 border-1 border-theme text-center"
                         name="r_qty[]" id="r_qty0" value="0" readonly />
                     <button type="button" class="btn btn-outline-theme" onclick="change_qty(this,'plus')">
                         <i class="fa fa-plus"></i>
                     </button>
                 </div>
             </td>
             <td>
                 <button class="btn btn-theme" style="width: 100%" type="button" onclick="add_rows()">+</button>
             </td>
         </tr>
     </tbody>
 </table>

 <div class="p-2">
     <label class="mb-2">Keterangan</label>
     <textarea style="resize: none;" class="form-control" name="ket" rows="2" placeholder="Keterangan..." required></textarea>
 </div>

 <script>
     function validate_product(r) {
         var id_invoice = document.getElementById("r_id_invoice").value;
         var id = r.value;

         var table = document.getElementById("table_retur");
         var tbo = table.tBodies[0].rows.length;

         var i = parseInt(r.parentNode.parentNode.rowIndex) - 1;
         document.getElementById("r_qty" + i).value = 0;
         var cek = 0;

         for (let index = 0; index < tbo; index++) {
             if (index == i) {
                 cek = 1;
             } else {
                 var produk = document.getElementById("r_produk" + index).value;
                 if (produk == r.value) {
                     alert('Produk Tidak Boleh Sama');
                     r.value = '';
                     cek = 0
                     break;
                 }
             }
         }

         if (cek == 1) {
             //  cek warehouse
             $.ajax({
                 url: "/get_warehouse",
                 type: "POST",
                 data: {
                     id_invoice: id_invoice,
                     id: id
                 },
                 beforeSend: function() {
                     $('#r_size' + i)
                         .empty()
                         .append(
                             '<option data-max="KOSONG" value="" selected>Pilih Size</option>')
                     $('#r_size' + i).prop("disabled", true);
                     $('#r_ware' + i)
                         .empty()
                         .append(
                             '<option value="" selected>Loading</option>')
                     $('#r_ware' + i).prop("disabled", true);
                 },
                 success: function(data) {
                     $('#r_ware' + i).prop("disabled", false);

                     $('#r_ware' + i)
                         .empty()
                         .append(
                             '<option value="" disabled selected>Pilih Gudang</option>')
                         .append(data);
                 }
             });
             //  cek warehouse
         } else {
             $('#r_ware' + i)
                 .empty()
                 .append(
                     '<option value="" selected>Pilih Gudang</option>')
             $('#r_ware' + i).prop("disabled", true);
             $('#r_size' + i)
                 .empty()
                 .append(
                     '<option data-max="KOSONG" value="" selected>Pilih Size</option>')
             $('#r_size' + i).prop("disabled", true);
         }
     }

     function cek_size(r) {
         var table = document.getElementById("table_retur");
         var tbo = table.tBodies[0].rows.length;

         var i = parseInt(r.parentNode.parentNode.rowIndex) - 1;
         document.getElementById("r_qty" + i).value = 0;
         var gudang = document.getElementById("r_ware" + i).value;
         var id = document.getElementById("r_produk" + i).value;
         //  cek size
         $.ajax({
             url: "/cek_size_retur",
             type: "POST",
             data: {
                 gudang: gudang,
                 id: id
             },
             beforeSend: function() {
                 $('#r_size' + i)
                     .empty()
                     .append(
                         '<option value="" selected>Loading</option>')
                 $('#r_size' + i).prop("disabled", true);
             },
             success: function(data) {
                 $('#r_size' + i).prop("disabled", false);

                 $('#r_size' + i)
                     .empty()
                     .append(
                         '<option data-max="KOSONG" value="" disabled selected>Pilih Size</option>')
                     .append(data);
             }
         });
         //  cek size
     }

     function add_rows() {
         var count = document.getElementById("r_count").value;
         var table = document.getElementById("table_retur");
         var tbo = table.tBodies[0].rows.length;

         if (parseInt(tbo) == parseInt(count)) {
             alert('Maaf, Refund Tidak Bisa Melebihi Total Product Dalam Invoice Ini');
         } else {
             document.getElementById("table_retur_body").insertRow(-1).innerHTML = `
            <tr class="text-center ">
                <td>
                    <select class="form-select" name="r_produk[]" id="r_produk` + tbo + `" onchange="validate_product(this)">
                        <option data-max="KOSONG" value="" disabled selected>Pilih Product...</option>
                        <?php
                        foreach ($data as $datas) {
                        ?> 
                            <option data-max="{{ $datas->qty }}" value="{{ $datas->id }}">{{ $datas->produk }} ({{ $datas->size }}={{ $datas->qty }})</option>
                        <?php
                        }
                        ?>           
                    </select>
                </td>
                <td>
                 <select class="form-select" name="r_ware[]" id="r_ware` + tbo + `" disabled onchange="cek_size(this)">
                     <option data-max="KOSONG" value="" disabled selected>Pilih Gudang</option>
                 </select>
             </td>
                <td>
                    <select class="form-select" name="r_size[]" id="r_size` + tbo + `" disabled>
                        <option data-max="KOSONG" value="" disabled selected>Pilih Size</option>
                    </select>
                </td>
                <td>
                    <div class="d-flex">
                     <button type="button" class="btn btn-outline-theme" onclick="change_qty(this,'minus')">
                         <i class="fa fa-minus"></i>
                     </button>
                     <input type="text" class="form-control w-50px fw-bold mx-2 border-1 border-theme text-center"
                     name="r_qty[]" id="r_qty` + tbo + `" value="0" readonly />
                     <button type="button" class="btn btn-outline-theme" onclick="change_qty(this,'plus')">
                         <i class="fa fa-plus"></i>
                     </button>
                 </div>
                </td>
                <td>
                    <button class="btn btn-danger" style="width: 100%" type="button" onclick="deleteRow(this)">x</button>
                </td>
            </tr>
        `;
         }

     }

     function deleteRow(r) {
         var i = r.parentNode.parentNode.rowIndex;
         var r = i - 1;

         document.getElementById("table_retur").deleteRow(i);
     }

     function change_qty(r, params) {
         var i = r.parentNode.parentNode.parentNode.rowIndex;
         var r = i - 1;

         var value = document.getElementById("r_qty" + r).value;

         if (params == 'minus') {
             if (value == 0) {} else {
                 document.getElementById("r_qty" + r).value = parseInt(value) - 1;
             }
         } else if (params == 'plus') {
             var max_qty = $('#r_produk' + r).find(':selected').data("max");
             var max_new_qty = $('#r_size' + r).find(':selected').data("max");

             if (max_qty == 'KOSONG' || max_new_qty == 'KOSONG') {
                 alert('Silahkan Pilih Product Retur dan Size');
             } else {
                 if (value == max_qty || value == max_new_qty) {
                     alert('Melebihi total Quantity Pembelian atau Stock Ready');
                 } else {
                     document.getElementById("r_qty" + r).value = parseInt(value) + 1;
                 }
             }
         }
     }
 </script>

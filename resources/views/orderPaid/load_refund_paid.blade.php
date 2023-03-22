 <!-- default table -->
 <input class="form-control" type="hidden" id="r_id_invoice" name="r_id_invoice" value="{{ $id_invoice }}">
 <input class="form-control" type="hidden" id="r_count" name="r_count" value="{{ $count }}">
 <table class="table table-borderless w-100 mb-0" id="table_refund">
     <thead>
         <tr>
             <th width="80%">Product</th>
             <th class="text-center" width="10%">Qty</th>
             <th class="text-center" width="10%">Act</th>
         </tr>
     </thead>
     <tbody class="align-middle" id="table_refund_body">
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
                 <div class="d-flex">
                     <button type="button" class="btn btn-outline-theme" onclick="change_qty(this,'minus')">
                         <i class="fa fa-minus"></i>
                     </button>
                     <input type="text" class="form-control w-50px fw-bold mx-2 border-1 border-theme text-center"
                         name="r_qty[]" id="mdl_qty0" value="1" readonly />
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
         var table = document.getElementById("table_refund");
         var tbo = table.tBodies[0].rows.length;

         var i = parseInt(r.parentNode.parentNode.rowIndex) - 1;

         for (let index = 0; index < tbo; index++) {
             if (index == i) {} else {
                 var produk = document.getElementById("r_produk" + index).value;
                 if (produk == r.value) {
                     alert('Produk Tidak Boleh Sama');
                     r.value = '';
                     break;
                 }
             }
         }
     }

     function add_rows() {
         var count = document.getElementById("r_count").value;
         var table = document.getElementById("table_refund");
         var tbo = table.tBodies[0].rows.length;

         if (parseInt(tbo) == parseInt(count)) {
             alert('Maaf, Refund Tidak Bisa Melebihi Total Product Dalam Invoice Ini');
         } else {
             document.getElementById("table_refund_body").insertRow(-1).innerHTML = `
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
                    <div class="d-flex">
                     <button type="button" class="btn btn-outline-theme" onclick="change_qty(this,'minus')">
                         <i class="fa fa-minus"></i>
                     </button>
                     <input type="text" class="form-control w-50px fw-bold mx-2 border-1 border-theme text-center"
                     name="r_qty[]" id="mdl_qty` + tbo + `" value="1" readonly />
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

         document.getElementById("table_refund").deleteRow(i);
     }

     function change_qty(r, params) {
         var i = r.parentNode.parentNode.parentNode.rowIndex;
         var r = i - 1;

         var value = document.getElementById("mdl_qty" + r).value;
         if (params == 'minus') {
             if (value == 1) {} else {
                 document.getElementById("mdl_qty" + r).value = parseInt(value) - 1;
             }
         } else if (params == 'plus') {
             var max_qty = $('#r_produk' + r).find(':selected').data("max");

             if (max_qty == 'KOSONG') {
                 alert('Silahkan Pilih product Refund');
             } else {
                 if (value == max_qty) {
                     alert('Quantity tidak bisa melebihi total Quantity Pembelian');
                 } else {
                     document.getElementById("mdl_qty" + r).value = parseInt(value) + 1;
                 }
             }
         }
     }
 </script>

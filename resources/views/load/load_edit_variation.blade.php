 @foreach ($variationss as $key => $value)
     @if ($value->id_produk === $id_produk and $value->id_ware === $id_ware)
         <tr>
             <td>
                 <input class="form-control form-control-sm text-center" type="text" name="size[]"
                     value="{{ $value->size }}" readonly style="width: 100%;height: 15px;">
             </td>
             <td>
                 @if ($value->qty === '0')
                     <input class="form-control form-control-sm text-center text-danger  is-invalid" type="number"
                         name="qty[]" value="{{ $value->qty }}" onkeypress="return isNumberKey(event)"
                         style="width: 100%;font-weight: bold;" autocomplete="off" required>
                 @else
                     <input class="form-control form-control-sm text-center text-theme is-invalid" type="number"
                         name="qty[]" value="{{ $value->qty }}" onkeypress="return isNumberKey(event)"
                         style="width: 100%;font-weight: bold;" autocomplete="off" required>
                 @endif

             </td>
         </tr>
     @endif
 @endforeach

        <div class="form-group col-6 mb-3">
            <input class="form-control form-control-sm text-theme text-center" type="text" name="e_idpo"
                value="#{{ $idpo }}" readonly autocomplete="OFF">
        </div>
        <div class="form-group col-6 mb-3">
            <input class="form-control form-control-sm text-theme text-center" type="text" value="{{ $id_sup }}"
                name="e_id_sup" required autocomplete="OFF">
        </div>
        <div class="form-group col-6 mb-3">
            <input class="form-control form-control-sm text-theme text-center" type="text"
                value="{{ $m_price }}" name="e_m_price" required autocomplete="OFF">
        </div>
        <div class="form-group col-6 mb-3">
            <input class="form-control form-control-sm text-theme text-center" type="text"
                value="{{ $tipe_order }}" name="e_tipe_order" required autocomplete="OFF">
        </div>

        <div class="col-12 form-group was-">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th class="text-center text-white" style="height: 10px;">SIZE</th>
                        <th class="text-center text-white" style="height: 10px;">QTY</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($variationss as $key => $value)
                        @if ($value->id_produk === $id_produk and $value->id_ware === $id_ware and $value->idpo === $idpo and $value->id_act === $id_act)
                            <tr>
                                <td>
                                    <input class="form-control form-control-sm text-center" type="text"
                                        name="size[]" value="{{ $value->size }}" readonly
                                        style="width: 100%;height: 15px;">
                                </td>
                                <td>
                                    @if ($value->qty === '0')
                                        <input class="form-control form-control-sm text-center text-danger  is-invalid"
                                            type="number" name="e_qty_old[]" value="{{ $value->qty }}"
                                            onkeypress="return isNumberKey(event)"
                                            style="width: 100%;font-weight: bold;" autocomplete="off" required>
                                    @else
                                        <input class="form-control form-control-sm text-center text-theme is-invalid"
                                            type="number" name="e_qtynew[]" value="{{ $value->qty }}"
                                            onkeypress="return isNumberKey(event)"
                                            style="width: 100%;font-weight: bold;" autocomplete="off" required>
                                    @endif

                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

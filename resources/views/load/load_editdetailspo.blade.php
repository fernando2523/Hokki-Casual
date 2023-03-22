<div class="row">
    <div class="col-6">
        @foreach ($datapo as $datapos)
            <input type="hidden" value="{{ $datapos->id_produk }}" name="id_produk">
            <input type="hidden" value="{{ $datapos->produk }}" name="produk">
            <input type="hidden" value="{{ $datapos->idpo }}" name="idpo">
            <div class="row mb-3">
                <div class="col-6">
                    <div class="form-group mb-3" align="left">
                        <label class="form-label">ID PO</label>
                        <input type="text" class="form-control text-center" value="{{ $datapos->idpo }}"
                            name="idpo_new">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group mb-3" align="left">
                        <label class="form-label">Supplier</label>
                        <select class="form-control text-center" name="id_sup">
                            <option class="text-dark" value="{{ $datapos->id_sup }}" selected>
                                {{ $datapos->suppliers_detail[0]['supplier'] }}</option>
                            @foreach ($supplier as $suppliers)
                                <option class="text-dark" value="{{ $suppliers->id_sup }}">{{ $suppliers->supplier }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group mb-3" align="left">
                        <label class="form-label">Modal Price</label>
                        <input type="text" class="form-control text-center" value="{{ $datapos->m_price }}"
                            name="m_price">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group mb-3" align="left">
                        <label class="form-label">Tipe Order</label>
                        <select class="form-control text-center" name="tipe_order">
                            <option class="text-dark" value="{{ $datapos->tipe_order }}" selected>
                                {{ $datapos->tipe_order }}</option>
                            @if ($datapos->tipe_order = 'RELEASE')
                                <option class="text-dark" value="REPEAT">REPEAT</option>
                            @else
                                <option class="text-dark" value="RELEASE">RELEASE</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-6">
        <!-- default table -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Size</th>
                    <th scope="col">Old Stock</th>
                    <th scope="col">New Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $datas)
                    <tr>
                        <td><input class="form-control text-center text-theme" name="size[]" type="text"
                                value="{{ $datas->size }}" readonly>
                        </td>
                        <td><input class="form-control text-center text-theme" name="qty_old[]" type="text"
                                value="{{ $datas->qty }}" readonly></td>
                        <td><input class="form-control text-center text-warning" name="qty_new[]" type="text"
                                value="{{ $datas->qty }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-body bg-white bg-opacity-10">
            <div class=" row">

                <div class="col-12">
                    <div class="row">
                        <div class="col-5">
                            <label for="idpo">ID PURCHASE ORDER</label>
                            <select class="form-select form-select-sm fw-bold text-success" required name="idpo"
                                id="idpo" onchange="selectpo()">
                                <option value="" disabled selected>ID PO</option>
                                @foreach ($get_idpo as $gets_idpo)
                                    <option value="{{ $gets_idpo->idpo }}">{{ $gets_idpo->idpo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="select_size_po">SIZE</label>
                            <select class="form-select form-select-sm fw-bold text-success" required name="size"
                                id="select_size_po" disabled>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="qty_po">QTY</label>
                            <input class="form-control form-select-sm fw-bold text-success" type="text"
                                value="" id="qty_po" name="qty">
                        </div>
                    </div>
                </div>

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

<script>
    $("#select_size_po").change(function() {
        var val = $(this).find(':selected').data("qty");
        $("#qty_po").val(val);
    });

    $("#idpo").change(function() {
        $("#qty_po").val('0');
    });
</script>

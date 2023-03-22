<meta name="csrf-token" content="{{ csrf_token() }}">
<form id="form_edit" class="was-validated" enctype="multipart/form-data" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:7%;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">EDIT EXPENSES</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="e_id" id="e_id">
                    <input type="hidden" name="e_id_costs" id="e_id_costs">
                    <div class="row form-group">
                        <div class="col-12 form-group position-relative mb-3" id="expense_select_store">
                        </div>

                        <div class="col-12 form-group mb-3 mt-1">
                            <label class="form-label">Store Expenses</label>
                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                name="e_item" id="e_item" required placeholder="Mohon di isi nama pengeluaran"
                                autocomplete="OFF">
                        </div>

                        <div class="col-12 form-group mb-3" id="expense_desc">
                        </div>

                        <div class="col-12 form-group mb-3">
                            <label class="form-label">Total Price</label>
                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                name="e_totalprice" id="e_totalprice" required placeholder="0" autocomplete="OFF"
                                type-currency="IDR">
                        </div>
                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="button" onclick="submitformedit()">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
            element.addEventListener('keyup', function(e) {
                let cursorPostion = this.selectionStart;
                let value = parseInt(this.value.replace(/[^,\d]/g, ''));
                let originalLenght = this.value.length;
                if (isNaN(value)) {
                    this.value = "";
                } else {
                    this.value = value.toLocaleString('id-ID', {
                        currency: 'IDR',
                        style: 'currency',
                        minimumFractionDigits: 0
                    });
                    cursorPostion = this.value.length - originalLenght + cursorPostion;
                    this.setSelectionRange(cursorPostion, cursorPostion);
                }
            });
        });
    </script>
</form>
<script>
    // CSRF for all ajax call
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

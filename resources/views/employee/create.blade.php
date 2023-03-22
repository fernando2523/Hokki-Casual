{{-- <form id="form_edit" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf --}}
<div class="modal fade" id="modalcreate" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">ACCOUNT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST" id="form_create" action="/">
                    @csrf
                    <h2 class="text-center">CREATE ACCESS</h2>
                    <p class="text-white text-opacity-50 text-center">Make access login, for this user.</p>
                    <div class="mb-3">
                        <input id="id" type="hidden" class="validate" name="id">
                        <input id="roles" type="hidden" class="validate" name="roles">
                        <input id="id_store" type="hidden" class="validate" name="id_store">
                        <input id="imgs" type="hidden" class="validate" name="imgs">
                        <input id="name" type="hidden" class="form-control form-control-lg bg-white bg-opacity-5"
                            name="name" autocomplete="off">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" hidden>
                        <label class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input id="email" type="text" class="form-control form-control-lg bg-white bg-opacity-5 "
                            name="email" autocomplete="off">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" hidden>
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input id="password" type="password" class="form-control form-control-lg bg-white bg-opacity-5"
                            value="123456789" name="password" autocomplete="off">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" hidden>
                        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input class="form-control form-control-lg bg-white bg-opacity-5" id="password-confirm"
                            type="password" name="password_confirmation" value="123456789" autocomplete="off">
                    </div>

                    <div class="mb-3 mt-3">
                        <button type="submit" class="btn btn-outline-theme btn-lg d-block w-100"
                            onclick="submitformcreate()">ACTIVE ACCOUNT</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
{{-- </form> --}}

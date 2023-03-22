<!DOCTYPE html>
<html lang="en" class="bg-cover-6">

<head>
    <meta charset="utf-8" />
    <title>YOUTHLAND | Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- ================== BEGIN core-css ================== -->
    <link rel="icon" href="{{ URL::asset('assets/img/cover/iconhome.png') }}" type="image/x-icon">
    <link href="{{ URL::asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" />
    <!-- ================== END core-css ================== -->

</head>

<body class='pace-top'>
    <!-- BEGIN #app -->
    <div id="app" class="app app-full-height app-without-header">
        <!-- BEGIN login -->
        <div class="login">
            <!-- BEGIN login-content -->

            <div class="login-content">
                {{-- @if (session('error'))
            <div class="alert alert-danger">
                <b>Opps!</b> {{session('error')}}
            </div>
            @endif --}}
                <div class="mb-4">
                    {{-- <img src="assets/img/default/bisfinal.png" width="350px"> --}}
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <h1 class="text-center text-white  text-opacity-85">Sign In</h1>
                    <div class="text-white text-opacity-40 text-center mb-4">
                        For your protection, please verify your identity.
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control form-control-lg bg-white bg-opacity-5 @error('email') is-invalid @enderror"
                            name="email" placeholder="Username" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <div class="d-flex">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                        </div>
                        <input type="password" name="password"
                            class="form-control form-control-lg bg-white bg-opacity-5 @error('password') is-invalid @enderror"
                            placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-theme btn-lg d-block w-100 fw-500 mb-3">Sign
                        In</button>
                    {{-- <div class="text-center text-white text-opacity-50">
                    Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>.
                </div> --}}
                </form>
            </div>
            <!-- END login-content -->
        </div>
        <!-- END login -->
    </div>
    <!-- END #app -->



    <!-- ================== BEGIN core-js ================== -->
    <script src="{{ URL::asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
    <!-- ================== END core-js ================== -->

</body>

</html>

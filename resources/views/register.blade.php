<!DOCTYPE html>
<html lang="en" class="bg-cover-6">
<head>
	<meta charset="utf-8" />
	<title>BIS | Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	
    <!-- ================== BEGIN core-css ================== -->
	<link href="{{ URL::asset('assets/css/vendor.min.css'); }}" rel="stylesheet" />
	<link href="{{ URL::asset('assets/css/app.min.css'); }}" rel="stylesheet" />
	<!-- ================== END core-css ================== -->
	
</head>
<body class='pace-top'>
	<!-- BEGIN #app -->
	<div id="app" class="app app-full-height app-without-header">
		<!-- BEGIN register -->
		<div class="register">
			<!-- BEGIN register-content -->
			<div class="register-content">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
					<h1 class="text-center">Sign Up</h1>
					<p class="text-white text-opacity-50 text-center">ID is all you need to access all the Admin services.</p>
					<div class="mb-3">
						<label class="form-label">Name <span class="text-danger">*</span></label>
						<input  id="name" type="text" class="form-control form-control-lg bg-white bg-opacity-5 @error('name') is-invalid @enderror" placeholder="name" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                        
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
					</div>
					<div class="mb-3">
						<label class="form-label">Email Address <span class="text-danger">*</span></label>
						<input id="email" type="email" class="form-control form-control-lg bg-white bg-opacity-5 @error('email') is-invalid @enderror" placeholder="username@address.com" name="email" value="{{ old('email') }}" required autocomplete="off">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
					</div>
					<div class="mb-3">
						<label class="form-label">Password <span class="text-danger">*</span></label>
						<input id="password" type="password" class="form-control form-control-lg bg-white bg-opacity-5 @error('password') is-invalid @enderror" name="password" required autocomplete="off">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
					</div>
					<div class="mb-3">
						<label class="form-label">Confirm Password <span class="text-danger">*</span></label>
						<input class="form-control form-control-lg bg-white bg-opacity-5" id="password-confirm" type="password" name="password_confirmation" required autocomplete="off">
					</div>
					<div class="mb-4">
						<label class="form-label">Role <span class="text-danger">*</span></label>
						<select class="form-select form-select-lg bg-white bg-opacity-5" name="role" id="role" required>
							<option disabled selected>Select Role</option>
							<option value="STAFF-ASSET">STAFF-ASSET</option>
							<option value="STAFF-ADMIN">STAFF-ADMIN</option>
						</select>
					</div>
					{{-- <div class="mb-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="customCheck1" />
							<label class="form-check-label" for="customCheck1">I have read and agree to the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</label>
						</div>
					</div> --}}
					<div class="mb-3 mt-3">
						<button type="submit" class="btn btn-outline-theme btn-lg d-block w-100">Sign Up</button>
					</div>
					
				</form>
			</div>
			<!-- END register-content -->
		</div>
		<!-- END register -->
	</div>
	<!-- END #app -->
	
	<!-- ================== BEGIN core-js ================== -->
	<script src="{{ URL::asset('assets/js/vendor.min.js'); }}"></script>
	<script src="{{ URL::asset('assets/js/app.min.js'); }}"></script>
	<!-- ================== END core-js ================== -->
	
</body>
</html>
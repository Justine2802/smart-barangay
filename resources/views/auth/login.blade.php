@extends('layouts.public')

@section('title', 'Login - Smart Barangay')

@section('content')
	<div class="row">
		<div class="col-md-10 mx-auto">
			<div class="card shadow-sm">
				<div class="card-body">
					<h3 class="card-title text-center mb-4">Sign in to your account</h3>
					<p class="text-center text-muted mb-4">Enter your credentials to access your account</p>

					@if(session('status'))
						<div class="alert alert-info">{{ session('status') }}</div>
					@endif

					@if($errors->any())
						<div class="alert alert-danger">
							<ul class="mb-0">
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form method="POST" action="{{ route('login.attempt') }}">
						@csrf

						<div class="row g-3">
							<div class="col-12">
								<label for="email" class="form-label">Email Address *</label>
								<input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
								@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>

							<div class="col-12">
								<label for="password" class="form-label">Password *</label>
								<input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
								@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
							</div>

							<div class="col-md-6">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
									<label class="form-check-label" for="remember">Remember me</label>
								</div>
							</div>

							<div class="col-md-6 text-end">
								@if (Route::has('password.request'))
									<a class="btn btn-link" href="{{ route('password.request') }}">Forgot your password?</a>
								@endif
							</div>

							<div class="col-12 text-center mt-3">
								<button type="submit" class="btn btn-warning btn-lg" style="background-color:#FA812F; border-color:#FA812F;">Log in</button>
							</div>

							<div class="col-12 text-center mt-3">
								<small class="text-muted">Don't have an account? <a href="{{ route('register') }}">Create account</a></small>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection


@extends('layouts.public')

@section('title', 'Create Account - Smart Barangay')

@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Create Account</h3>
                    <p class="text-center text-muted">Register to start requesting barangay documents online</p>

                    <form method="POST" action="{{ route('register.submit') }}">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name *</label>
                                <input id="first_name" name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                                @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name *</label>
                                <input id="last_name" name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                                @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email Address *</label>
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">Phone Number *</label>
                                <input id="phone_number" name="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" required>
                                @error('phone_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="barangay_id_number" class="form-label">Barangay ID Number</label>
                                <input id="barangay_id_number" name="barangay_id_number" type="text" class="form-control @error('barangay_id_number') is-invalid @enderror" value="{{ old('barangay_id_number') }}">
                                @error('barangay_id_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label for="complete_address" class="form-label">Complete Address *</label>
                                <input id="complete_address" name="complete_address" type="text" class="form-control @error('complete_address') is-invalid @enderror" value="{{ old('complete_address') }}" required>
                                @error('complete_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">Password *</label>
                                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                                <div class="form-text">At least 8 characters</div>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password *</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="terms">I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></label>
                                    @error('terms')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="col-12 text-center mt-3">
                                <button type="submit" class="btn btn-warning btn-lg" style="background-color:#FA812F; border-color:#FA812F;">Create Account</button>
                            </div>

                            <div class="col-12 text-center mt-3">
                                <small class="text-muted">Already have an account? <a href="{{ route('login') }}">Log in</a></small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

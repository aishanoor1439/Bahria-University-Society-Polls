@extends('layouts.app')

@section('title', 'Reset Password')

@section('styles')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
        background-color: #f5f7fa !important;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
@endsection

@section('content')
<div class="society-background" id="societyBackground"></div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card login-card animate__animated animate__fadeIn">
                <div class="card-body p-md-5">
                    <div class="text-center mb-5">
                        <div class="logo-container floating">
                            <img src="{{ asset('assets/img/Logo.png') }}" style="width: 180px;" alt="logo" class="img-fluid">
                        </div>
                        <h4 class="mt-4 mb-3 fw-bold" style="color: var(--primary-color);">Bahria University Society Polls</h4>
                        <p class="text-muted">Reset Your Password</p>
                    </div>

                    @if (session('status'))
                    <div class="alert alert-success animate__animated animate__fadeInDown">
                        <i class="fas fa-check-circle me-2"></i> {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.update') }}" class="animate__animated animate__fadeIn animate__delay-1s">
                        @csrf
                        <input type="hidden" name="token">

                        <div class="form-outline mb-4">
                            <label class="form-label" for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                            <input type="email" id="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" />
                        </div>

                        <div class="form-outline mb-4 password-input-container">
                            <label class="form-label" for="password"><i class="fas fa-lock me-2"></i>New Password</label>
                            <input type="password" id="password" class="form-control" name="password" required autocomplete="new-password" />
                            <i class="fas fa-eye password-toggle" id="togglePassword" onclick="togglePasswordVisibility('password')"></i>
                        </div>

                        <div class="form-outline mb-4 password-input-container">
                            <label class="form-label" for="password-confirm"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                            <i class="fas fa-eye password-toggle" id="togglePasswordConfirm" onclick="togglePasswordVisibility('password-confirm')"></i>
                        </div>

                        <div class="text-center pt-1 mb-4">
                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 w-100 py-3 fw-bold" type="submit">
                                <i class="fas fa-key me-2"></i> Reset Password
                            </button>
                        </div>

                        <div class="d-flex align-items-center justify-content-center pb-4">
                            <a href="{{ route('admin.login') }}" class="btn btn-custom btn-lg">
                                <i class="fas fa-arrow-left me-2"></i> Back to Login
                            </a>
                        </div>

                        @if ($errors->any()))
                        <div class="alert alert-danger animate__animated animate__shakeX">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>@endsection

@push('scripts')
<script>
    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = passwordInput.nextElementSibling;
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
@endpush
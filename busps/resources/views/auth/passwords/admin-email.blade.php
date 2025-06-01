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
                        <h4 class="mt-4 mb-3 fw-bold" style="color: var(--primary-color);">Reset Your Password</h4>
                        <p class="text-muted">Create a new secure password</p>
                    </div>

                    @if (session('status'))
                    <div class="alert alert-success animate__animated animate__fadeInDown">
                        <i class="fas fa-check-circle me-2"></i> {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.email') }}" class="animate__animated animate__fadeIn animate__delay-1s">
                        @csrf

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example22"><i class="fas fa-envelope me-2"></i>Email</label>
                            <input type="email" id="form2Example22" class="form-control" name="email" placeholder="Enter your email" required />
                        </div>

                        <div class="form-outline mb-4 password-input-container">
                            <label class="form-label" for="newPassword"><i class="fas fa-lock me-2"></i>New Password</label>
                            <input type="password" id="newPassword" class="form-control" name="password" placeholder="Create a password" required />
                            <i class="fas fa-eye password-toggle" id="toggleNewPassword" onclick="togglePasswordVisibility('newPassword', 'toggleNewPassword')"></i>
                        </div>

                        <div class="form-outline mb-4 password-input-container">
                            <label class="form-label" for="confirmPassword"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                            <input type="password" id="confirmPassword" class="form-control" name="password_confirmation" placeholder="Confirm your password" required />
                            <i class="fas fa-eye password-toggle" id="toggleConfirmPassword" onclick="togglePasswordVisibility('confirmPassword', 'toggleConfirmPassword')"></i>
                        </div>

                        <div class="text-center pt-1 mb-4">
                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 w-100 py-3 fw-bold" type="submit">
                                <i class="fas fa-key me-2"></i> Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePasswordVisibility(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
@endpush
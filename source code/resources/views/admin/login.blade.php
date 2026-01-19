@extends('layouts.app')

@section('title', 'Login')

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
                        <p class="text-muted">Access your Account</p>
                    </div>

                    @if (session('success'))
                    <div class="alert alert-success animate__animated animate__fadeInDown">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('admin.login.submit') }}" method="POST" class="animate__animated animate__fadeIn animate__delay-1s">
                        @csrf

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example11"><i class="fas fa-envelope me-2"></i>Email</label>
                            <input type="email" id="form2Example11" class="form-control" name="email" placeholder="Enter your email" required />
                        </div>

                        <div class="form-outline mb-4 password-input-container">
                            <label class="form-label" for="form2Example22"><i class="fas fa-lock me-2"></i>Password</label>
                            <input type="password" id="form2Example22" class="form-control" name="password" placeholder="Enter your password" required />
                            <i class="fas fa-eye password-toggle" id="togglePassword" onclick="togglePasswordVisibility()"></i>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" />
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <a href="{{ route('admin.password.request') }}" style="color: var(--primary-color);">Forgot password?</a>
                        </div>

                        <div class="text-center pt-1 mb-4">
                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 w-100 py-3 fw-bold" type="submit">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </button>
                        </div>

                        <div class="d-flex align-items-center justify-content-center pb-3">
                            <p class="mb-0 me-2">Don't have an account?</p>
                        </div>

                        <div class="d-flex align-items-center justify-content-center pb-4">
                            <a href="{{ route('admin.register') }}" class="btn btn-custom btn-lg">
                                <i class="fas fa-user-plus me-2"></i> Register Now
                            </a>
                        </div>

                        @if ($errors->any())
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
</div>
@endsection

@push('scripts')
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('form2Example22');
        const toggleIcon = document.getElementById('togglePassword');

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
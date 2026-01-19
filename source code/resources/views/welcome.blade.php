@extends('layouts.app')

@section('title', 'Welcome')

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
                        <p class="text-muted">Welcome to the Voting System</p>
                    </div>

                    @if (session('success'))
                    <div class="alert alert-success animate__animated animate__fadeInDown">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                    @endif

                    <div class="text-center animate__animated animate__fadeIn animate__delay-1s">
                        <h5 class="mb-4">Please select your login type:</h5>

                        <div class="row g-3">

                                    <div class="col-12">
                                        <a href="{{ route('user.login') }}" class="btn btn-lg w-100 py-3 fw-bold d-flex align-items-center justify-content-center custom-btn">
                                            <i class="fas fa-user-graduate me-3 fa-lg" style="color: #2d1d61;"></i>
                                            <div class="text-start">
                                                <div class="fw-bold" style="color: #5c6c72;">Student Login</div>
                                                <small style="color: #5c6c72; opacity: 0.75;">Access as student voter</small>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-12">
                                        <a href="{{ route('admin.login') }}" class="btn btn-lg w-100 py-3 fw-bold d-flex align-items-center justify-content-center custom-btn">
                                            <i class="fas fa-user-shield me-3 fa-lg" style="color: #2d1d61;"></i>
                                            <div class="text-start">
                                                <div class="fw-bold" style="color: #5c6c72;">Admin Login</div>
                                                <small style="color: #5c6c72; opacity: 0.75;">Access as administrator</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="mt-4 pt-3 border-top">
                                    <p class="text-muted mb-3">New to the system?</p>
                                    <a href="{{ route('user.register') }}" class="btn btn-custom btn-lg">
                                        <i class="fas fa-user-plus me-2"></i> Register as Student
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger animate__animated animate__shakeX mt-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if(!session()->has('LoggedStudentInfo'))
<script>
    console.log('Session doesnt exist client-side!');
</script>
@endif
@endpush
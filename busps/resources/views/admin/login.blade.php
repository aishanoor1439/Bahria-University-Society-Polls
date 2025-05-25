<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUSPs-Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #2d1d61, #c4a461, #c4a461, #2d1d61);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #2d1d61, #2d1d61, #2d1d61, #2d1d61);
        }

        .btn-custom {
            color: #2d1d61;
            border-color: #2d1d61;

        }

        .btn-custom:hover {
            background-color: #c5e3f4;
            color: #2d1d61 !important;
            border-color: #2d1d61;
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }

        /* Added styles for centering */
        .center-form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            width: 100%;
            max-width: 500px;
            /* Adjust this value as needed */
        }
    </style>
</head>

<body>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10 center-form">
                <div class="card rounded-3 text-black login-card">
                    <div class="card-body p-md-5 mx-md-4">
                        <div class="text-center">
                            <img src="{{ asset('assets/img/Logo.png') }}" style="width: 180px;" alt="logo">
                            <h4 class="mt-1 mb-5 pb-1">Login to your Account</h4>
                        </div>

                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <form action="{{ route('admin.login.submit') }}" method="POST">
                            @csrf

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form2Example11">Email</label>
                                <input type="email" id="form2Example11" class="form-control" name="email"
                                    />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form2Example22">Password</label>
                                <input type="password" id="form2Example22" class="form-control" name="password" />
                            </div>

                            <div class="text-center pt-1 mb-5 pb-1">
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Sign in
                                </button>
                                <a class="text-muted" href="{{ route('admin.password.request') }}">Forgot password?</a>
                            </div>

                            <div class="d-flex align-items-center justify-content-center pb-3">
                                <p class="mb-0 me-2">Don't have an account?</p>
                            </div>

                            <div class="d-flex align-items-center justify-content-center pb-4">
                                <a href="{{ route('admin.register') }}" class="btn btn-custom">
                                    Register
                                </a>
                            </div>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif


                        </form>

                        <!-- Toastr for error messages (if needed) -->
                        @if(session('error'))
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
                        <script>
                            toastr.error("{{ session('error') }}");
                        </script>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
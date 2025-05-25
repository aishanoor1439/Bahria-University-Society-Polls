<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUSPs-Reset Password</title>
    <!-- Updated Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;
            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #2d1d61, #2d1d61, #2d1d61, #2d1d61);
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
        }

        .btn-link-custom {
            text-decoration: none;
            color: inherit;
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
                            <h4 class="mt-1 mb-5 pb-1">Reset Password</h4>
                        </div>

                        <form method="POST" action="{{ route('admin.password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example22">Email</label>
                                <input type="email" id="form2Example22" class="form-control" name="email" value="{{$email}}" required/>
                            </div>

                            <div class="text-center pt-1 mb-5 pb-1">
                                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 w-100" type="submit">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
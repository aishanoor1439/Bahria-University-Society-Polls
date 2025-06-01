<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | BUSPs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('styles')
    <style>
        :root {
            --primary-color: #2d1d61;
            --secondary-color: #2d1d61;
            --accent-color: #ff6b6b;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            background-color: #c5e3f4;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .society-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .society-icon {
            position: absolute;
            opacity: 0.1;
            animation: float 15s linear infinite;
            /* font-size: 100px; */
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
            }
        }

        .gradient-custom-2 {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            background-size: 200% 200%;
            animation: gradientBG 8s ease infinite;
            border: none;
            box-shadow: 0 4px 15px rgba(45, 29, 97, 0.3);
            transition: all 0.3s ease;
        }

        .gradient-custom-2:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(45, 29, 97, 0.4);
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .btn-custom {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: rgba(45, 29, 97, 0.1);
            color: var(--primary-color) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(45, 29, 97, 0.2);
        }

        .login-card {
            width: 100%;
            max-width: 500px;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(45, 29, 97, 0.25);
            transform: scale(1.02);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            width: 22px;
            height: 22px;
            transition: transform 0.3s ease;
        }

        .password-toggle:hover {
            transform: translateY(-50%) scale(1.1);
        }

        .password-input-container {
            position: relative;
        }

        .logo-container {
            transition: all 0.5s ease;
        }

        .logo-container:hover {
            transform: rotate(5deg) scale(1.05);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .alert {
            border-radius: 8px;
            transition: all 0.5s ease;
        }

        .alert-danger {
            background-color: #ffebee;
            border-color: #ef9a9a;
        }

        .alert-success {
            background-color: #e8f5e9;
            border-color: #a5d6a7;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
    @yield('content')

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    @if(session('error'))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        toastr.error("{{ session('error') }}", "Registration Error", {
            positionClass: "toast-top-center",
            progressBar: true,
            closeButton: true,
            timeOut: 5000,
            extendedTimeOut: 2000,
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        });
    </script>
    @endif

    <script>
        function createSocietyIcons() {
            const container = document.getElementById('societyBackground');
            const societies = [{
                    icon: 'fa-code',
                    name: 'Developers Society'
                },
                {
                    icon: 'fa-user-graduate',
                    name: 'Character Building'
                },
                {
                    icon: 'fa-hands-helping',
                    name: 'Community Services'
                },
                {
                    icon: 'fa-theater-masks',
                    name: 'Dramatics Society'
                },
                {
                    icon: 'fa-comments',
                    name: 'Debating Society'
                },
                {
                    icon: 'fa-calendar-check',
                    name: 'Event Management'
                },
                {
                    icon: 'fa-camera',
                    name: 'Media Club'
                },
                {
                    icon: 'fa-music',
                    name: 'Music Club'
                }
            ];

            for (let i = 0; i < 30; i++) {
                const icon = document.createElement('i');
                const society = societies[Math.floor(Math.random() * societies.length)];

                icon.className = `society-icon fas ${society.icon}`;
                icon.title = society.name;
                icon.style.left = `${Math.random() * 100}%`;
                icon.style.fontSize = `${Math.random() * 25 + 20}px`;
                icon.style.animationDuration = `${Math.random() * 10 + 10}s`;
                // icon.style.animationDelay = `${Math.random() * 5}s`;

                container.appendChild(icon);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            createSocietyIcons();

            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('animate__animated', 'animate__pulse');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('animate__animated', 'animate__pulse');
                });
            });
        });
    </script>
</body>

</html>
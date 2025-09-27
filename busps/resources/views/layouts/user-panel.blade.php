<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="icon" href="{{ asset('assets/img/Logo-bg.png') }}" type="image/png">
    <title>@yield('title') | BUSPs</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/paper-dashboard.css')}}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">
    <link href="{{ asset('assets/css/themify-icons.css')}}" rel="stylesheet">

    <style>

        :root {
            --primary-dark: #2d1d61;
            --primary-light: #c5e3f4;
            --sidebar-link: #7f85a0;
            --light-bg: #ffffff;
            --text-dark: #5c6c72;
            --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 8px 25px rgba(0, 0, 0, 0.12);
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            overflow-x: hidden;
            line-height: 1.6;
        }

        .main-panel,
        .navbar-default,
        .footer,
        .card {
            background-color: white;
        }

        .sidebar {
            background: white;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.05);
        }

        .sidebar .nav li a {
            color: var(--sidebar-link);
            margin: 5px 15px;
            border-radius: 4px;
            padding: 12px 15px;
            border-left: 4px solid transparent;
            transition: var(--transition);
            text-decoration: none;
            display: block;
        }

        .sidebar .nav li a:hover,
        .sidebar .nav li.active a {
            color: var(--primary-dark);
            background-color: rgba(45, 29, 97, 0.05);
            border-left: 4px solid var(--primary-dark);
        }

        .sidebar .nav li a i {
            margin-right: 10px;
            font-size: 1.3em;
            width: 20px;
            text-align: center;
        }

        .logo-container {
            padding: 25px 0;
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .navbar-default {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: none;
            margin-bottom: 0;
            min-height: 70px;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-dark) !important;
            letter-spacing: 0.5px;
            font-size: 1.4em;
            padding: 15px 0;
            display: flex;
            align-items: center;
        }

        .navbar-default .navbar-nav > li > a {
            color: var(--text-dark);
            padding: 15px 20px;
            transition: var(--transition);
            font-weight: 500;
        }

        .navbar-default .navbar-nav > li > a:hover,
        .navbar-default .navbar-nav > li > a:focus {
            color: var(--primary-dark) !important;
            background-color: rgba(45, 29, 97, 0.05);
        }

        .navbar-default .dropdown-menu {
            background-color: white;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            min-width: 200px;
            margin-top: 5px;
        }

        .navbar-default .dropdown-menu > li > a {
            color: var(--text-dark) !important;
            padding: 10px 20px;
            transition: var(--transition);
            font-size: 0.9em;
        }

        .navbar-default .dropdown-menu > li > a:hover,
        .navbar-default .dropdown-menu > li > a:focus {
            color: var(--primary-dark) !important;
            background-color: rgba(45, 29, 97, 0.05) !important;
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            background: white;
            margin-bottom: 25px;
            transition: var(--transition);
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--card-shadow-hover);
            transform: translateY(-2px);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px 25px;
            font-weight: 600;
        }

        .card-body {
            padding: 25px;
        }

        .card-title {
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 0;
            font-size: 1.1em;
        }

        .stat-card {
            transition: var(--transition);
            box-shadow: var(--card-shadow);
            border-radius: var(--border-radius);
            border: none;
            overflow: hidden;
            height: 100%;
        }

        .stat-card:hover {
            box-shadow: var(--card-shadow-hover);
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3em;
            flex-shrink: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #3a2a7a 100%);
            color: white;
            border: none;
            font-weight: 500;
            padding: 15px 20px;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            vertical-align: middle;
        }

        .table tbody td {
            padding: 15px 20px;
            border-color: rgba(0, 0, 0, 0.05);
            vertical-align: middle;
            font-size: 0.95em;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(197, 227, 244, 0.3);
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: white;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(45, 29, 97, 0.08);
            transform: translateX(5px);
            transition: var(--transition);
        }

        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            transition: var(--transition);
            border: none;
            font-size: 0.9em;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #3a2a7a 100%);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(45, 29, 97, 0.3);
            color: white;
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-dark);
            color: var(--primary-dark);
            background: transparent;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
        }

        .btn-custom {
            color: var(--primary-dark);
            border: 2px solid var(--primary-dark);
            font-weight: 600;
            transition: var(--transition);
            background: transparent;
        }

        .btn-custom:hover {
            background-color: rgba(45, 29, 97, 0.1);
            color: var(--primary-dark) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(45, 29, 97, 0.2);
        }

        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.8em;
        }

        .footer {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px 0;
            margin-top: 20px;
            background: white;
        }

        .copyright {
            color: var(--text-dark);
            font-size: 0.9em;
            text-align: right;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
                height: 100vh;
                transition: transform 0.3s ease;
                width: 280px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-panel {
                width: 100%;
                transition: all 0.3s ease;
            }

            .navbar-header {
                float: none;
                width: 100%;
            }

            .navbar-toggle {
                display: block;
                float: left;
                margin: 8px 15px;
            }

            .navbar-collapse {
                border-top: 1px solid transparent;
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
            }

            .navbar-collapse.collapse {
                display: none !important;
            }

            .navbar-nav {
                float: none !important;
                margin: 7.5px -15px;
            }

            .navbar-nav > li {
                float: none;
            }

            .navbar-nav > li > a {
                padding-top: 10px;
                padding-bottom: 10px;
            }
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 20px;
            }

            .card-header {
                padding: 15px 20px;
            }

            .stat-card .card-body {
                padding: 15px;
            }

            .stat-icon {
                width: 40px;
                height: 40px;
                font-size: 1.1em;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .btn {
                padding: 8px 16px;
                font-size: 0.85em;
            }
        }

        @media (max-width: 576px) {
            .container-fluid {
                padding: 10px;
            }

            .card-body {
                padding: 15px;
            }

            .navbar-brand {
                font-size: 1.2em;
                padding: 10px 0;
            }

            .card-header {
                padding: 15px;
            }

            .table thead th,
            .table tbody td {
                padding: 10px 12px;
                font-size: 0.85em;
            }

            .stat-card .card-body {
                padding: 12px;
            }
        }

        .text-primary-custom {
            color: var(--primary-dark) !important;
        }

        .bg-primary-light {
            background-color: var(--primary-light) !important;
        }

        .border-radius-custom {
            border-radius: var(--border-radius) !important;
        }

        .shadow-custom {
            box-shadow: var(--card-shadow) !important;
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                transition: none !important;
                animation: none !important;
            }
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-active-color="white">
            <div class="sidebar-wrapper">
                <div class="logo-container">
                    <img src="{{ asset('assets/img/Logo.png') }}" style="width: 150px;" alt="logo" class="img-fluid">
                </div>

                <ul class="nav">
                    <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('user.dashboard') }}">
                            <i class="ti-panel" style="color: var(--primary-dark);"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('student.societies.index') ? 'active' : '' }}">
                        <a href="{{ route('student.societies.index') }}">
                            <i class="ti-view-list-alt" style="color: var(--primary-dark);"></i>
                            <p>Societies</p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('student.elections.societies.index') ? 'active' : '' }}">
                        <a href="{{ route('student.elections.societies.index') }}">
                            <i class="ti-calendar" style="color: var(--primary-dark);"></i>
                            <p>Elections</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <a class="navbar-brand" href="{{ route('user.dashboard') }}">
                            <span>@yield('title')</span>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-settings" style="color: var(--primary-dark);"></i>
                                    <p>Settings</p>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('user.password.request') }}">Change Password</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ti-power-off" style="color: var(--primary-dark);"></i>
                                    <p>Logout</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright pull-right">
                        &copy; <script>document.write(new Date().getFullYear())</script> BUKC. All rights reserved.
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="{{ asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap-checkbox-radio.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap-notify.js')}}"></script>
    <script src="{{ asset('assets/js/paper-dashboard.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Remove Chartist initialization to prevent errors
            // Only initialize if demo exists and charts are present
            if (typeof demo !== 'undefined' && $('.ct-chart').length > 0) {
                try {
                    demo.initChartist();
                } catch (e) {
                    console.log('Chartist not available for this page');
                }
            }

            // Sidebar toggle functionality
            $('.navbar-toggle').click(function() {
                $('.sidebar').toggleClass('active');
                $('.main-panel').toggleClass('active');
            });

            // Close sidebar when clicking on a link (mobile)
            $('.sidebar .nav li a').click(function() {
                if ($(window).width() < 992) {
                    $('.sidebar').removeClass('active');
                    $('.main-panel').removeClass('active');
                }
            });

            // Fix for paper-dashboard.js errors
            setTimeout(function() {
                if (typeof initRightMenu !== 'undefined') {
                    try {
                        initRightMenu();
                    } catch (e) {
                        console.log('initRightMenu not available');
                    }
                }
            }, 100);

            // Add active class to current route
            var currentUrl = window.location.href;
            $('.sidebar .nav li a').each(function() {
                if (this.href === currentUrl) {
                    $(this).parent().addClass('active');
                }
            });
        });

        // Handle window resize
        $(window).resize(function() {
            if ($(window).width() > 991) {
                $('.sidebar').removeClass('active');
                $('.main-panel').removeClass('active');
            }
        });
    </script>

    <!-- Botpress Chatbot -->
    <script src="https://cdn.botpress.cloud/webchat/v3.1/inject.js" defer></script>
    <script src="https://files.bpcontent.cloud/2025/07/09/09/20250709095445-8LFA03QU.js" defer></script>

    @yield('scripts')
</body>

</html>
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
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/paper-dashboard.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/demo.css')}}" rel="stylesheet" />
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
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            overflow-x: hidden;
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
        }

        .sidebar .nav li a:hover,
        .sidebar .nav li.active a {
            color: var(--primary-dark);
            border-left: 4px solid var(--primary-dark);
        }

        .sidebar .nav li a i {
            margin-right: 10px;
            font-size: 1.5em;
        }

        .logo-container {
            padding: 25px 0;
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .navbar-default {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-dark) !important;
            letter-spacing: 0.5px;
            font-size: 1.4em;
        }

        .navbar-default .navbar-nav>li>a:hover,
        .navbar-default .navbar-nav>li>a:focus {
            color: var(--primary-dark) !important;
        }

        .navbar-default .dropdown-menu {
            background-color: var(--primary-light) !important;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-default .dropdown-menu>li>a {
            color: var(--light-bg) !important;
            padding: 10px 20px;
        }

        .navbar-default .dropdown-menu>li>a:hover,
        .navbar-default .dropdown-menu>li>a:focus {
            color: var(--primary-dark) !important;
            background-color: transparent !important;
        }

        .navbar-default .navbar-nav>.dropdown>a .caret {
            border-top-color: #abb4c8;
            border-bottom-color: #abb4c8;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            background: white;
        }

        .card .header h4.title{
            color: var(--primary-dark);
            font-weight: 600;
        }

        .card .header .text-center h4.title{
            color: var(--primary-dark);
            font-weight: 600;
        }

        .table thead th {
            background-color: var(--primary-dark);
            color: white;
            border: none;
            font-weight: 500;
            padding: 15px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: var(--primary-light);
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: var(--light-bg);
        }

        .btn {
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-manage {
            background-color: var(--primary-light);
            color: var(--light-bg);
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-manage:hover {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.2s ease;
        }


        .gradient-custom-2 {
            background: var(--primary-dark);
            color: var(--light-bg);
            background-size: 200% 200%;
            animation: gradientBG 8s ease infinite;
            border: none;
            box-shadow: 0 4px 15px rgba(45, 29, 97, 0.3);
            transition: all 0.3s ease;
        }

        .gradient-custom-2:hover {
            background: var(--primary-dark);
            color: var(--light-bg);
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
            color: var(--primary-dark);
            border: 2px solid var(--primary-dark);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: rgba(45, 29, 97, 0.1);
            color: var(--primary-dark) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(45, 29, 97, 0.2);
        }

        .btn-info,
        .btn-warning,
        .btn-danger {
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            padding: 0;
        }

        .badge{
            background-color: var(--primary-light);
        }

        .footer {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px 0;
        }

        .footer.ul.li :hover {
            color: var(--primary-dark);
        }

        .text-muted{
            color: var(--sidebar-link);
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
                height: 100vh;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-panel {
                width: 100%;
            }
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
                    <li>
                        <a href="{{ route('user.dashboard') }}">
                            <i class="ti-panel" style="color: var(--primary-light);"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.societies.index') }}">
                            <i class="ti-view-list-alt" style="color: var(--primary-light);"></i>
                            <p>Societies</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.elections.societies.index') }}">
                            <i class="ti-calendar" style="color: var(--primary-light);"></i>
                            <p>Elections</p>
                        </a>
                    </li>
                    <li>
                        <a href="notifications.html">
                            <i class="ti-bell" style="color: var(--primary-light);"></i>
                            <p>Notifications</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <a class="navbar-brand" href="#">
                            <span>@yield('title')</span>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell" style="color: var(--primary-light);"></i>
                                    <p class="notification">5</p>
                                    <p>Notifications</p>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">New election created</a></li>
                                    <li><a href="#">3 new members joined</a></li>
                                    <li><a href="#">System update available</a></li>
                                    <li><a href="#">Weekly report generated</a></li>
                                    <li><a href="#">New message received</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-settings" style="color: var(--primary-light);"></i>
                                    <p>Settings</p>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('user.password.request') }}">Change Password</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('user.logout') }}" class="dropdown-toggle" w
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout<i class="ti-arrow-right" style="color: var(--primary-light);"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">BUSPs</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright pull-right">
                        &copy; <script>
                            document.write(new Date().getFullYear())
                        </script> BUKC. All rights reserved.
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
    <script src="{{ asset('assets/js/chartist.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap-notify.js')}}"></script>
    <script src="{{ asset('assets/js/paper-dashboard.js')}}"></script>
    <script src="{{ asset('assets/js/demo.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            demo.initChartist();

            $('.navbar-toggle').click(function() {
                $('.sidebar').toggleClass('active');
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title') | BUSPs</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/paper-dashboard.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/demo.css')}}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">
    <link href="{{ asset('assets/css/themify-icons.css')}}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-dark: #2d1d61;        /* Deep purple-blue */
            --primary-light: #c5e3f4;      /* Soft sky blue */
            --light-bg: #f8f9fa;           /* Off-white background */
            --accent-color: #ff9f43;       /* Vibrant orange for accents */
            --success-color: #2ecc71;      /* Fresh green */
            --warning-color: #f39c12;     /* Golden yellow */
            --danger-color: #e74c3c;      /* Bright red */
            --text-dark: #2c3e50;          /* Dark text for contrast */
            --text-light: #ecf0f1;        /* Light text for dark backgrounds */
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            overflow-x: hidden;
        }
        
        /* Sidebar with gradient and shadow */
        .sidebar {
            background: linear-gradient(135deg, var(--primary-dark), #3a267a);
            box-shadow: 5px 0 25px rgba(45, 29, 97, 0.3);
            transition: all 0.5s cubic-bezier(0.55, 0, 0.1, 1);
        }
        
        .sidebar .nav li a {
            color: var(--text-light);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            border-left: 4px solid transparent;
            margin: 5px 15px;
            border-radius: 4px;
            padding: 12px 15px;
        }
        
        .sidebar .nav li a:hover,
        .sidebar .nav li.active a {
            background: rgba(255, 255, 255, 0.15);
            border-left: 4px solid var(--accent-color);
            transform: translateX(5px);
        }
        
        .sidebar .nav li a i {
            color: var(--primary-light);
            margin-right: 10px;
            font-size: 1.2em;
        }
        
        .logo-container {
            padding: 25px 0;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Floating logo effect */
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        /* Modern navbar */
        .navbar-default {
            background: white;
            box-shadow: 0 4px 20px rgba(45, 29, 97, 0.1);
            border: none;
            border-radius: 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-dark) !important;
            letter-spacing: 0.5px;
            font-size: 1.4em;
        }
        
        /* Card design with glass morphism effect */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(45, 29, 97, 0.08);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            background: white;
            overflow: hidden;
            position: relative;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-dark), var(--accent-color));
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(45, 29, 97, 0.15);
        }
        
        .card .header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px;
            position: relative;
        }
        
        .card .header h4.title {
            color: var(--primary-dark);
            font-weight: 600;
            position: relative;
            display: inline-block;
        }
        
        .card .header h4.title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--primary-light);
            border-radius: 3px;
        }
        
        /* Button styles */
        .btn {
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: none;
        }
        
        .btn-primary {
            background-color: var(--primary-dark);
            background: linear-gradient(45deg, var(--primary-dark), #3a267a);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 29, 97, 0.3);
        }
        
        .btn-success {
            background-color: var(--success-color);
            background: linear-gradient(45deg, var(--success-color), #27ae60);
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            background: linear-gradient(45deg, var(--danger-color), #c0392b);
        }
        
        .btn-warning {
            background-color: var(--warning-color);
            background: linear-gradient(45deg, var(--warning-color), #e67e22);
        }
        
        .btn-info {
            background-color: var(--primary-light);
            color: var(--primary-dark);
        }
        
        /* Table styling */
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table thead th {
            background: linear-gradient(45deg, var(--primary-dark), #3a267a);
            color: white;
            border: none;
            font-weight: 500;
            padding: 15px;
            position: sticky;
            top: 0;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
        }
        
        .table tbody tr:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(45, 29, 97, 0.1);
        }
        
        .table tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        /* Label styling */
        .label {
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8em;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .label-success {
            background-color: var(--success-color);
        }
        
        .label-warning {
            background-color: var(--warning-color);
        }
        
        .label-danger {
            background-color: var(--danger-color);
        }
        
        /* Notification badge */
        .notification {
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            padding: 3px 7px;
            font-size: 0.7em;
            position: relative;
            top: -10px;
            left: -5px;
        }
        
        /* Dropdown menu */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 0;
            overflow: hidden;
        }
        
        .dropdown-menu li a {
            padding: 10px 20px;
            transition: all 0.2s ease;
        }
        
        .dropdown-menu li a:hover {
            background: var(--primary-light);
            color: var(--primary-dark);
            padding-left: 25px;
        }
        
        /* Footer styling */
        .footer {
            background: white;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px 0;
            color: var(--text-dark);
        }
        
        .footer a {
            color: var(--primary-dark);
            transition: all 0.2s ease;
        }
        
        .footer a:hover {
            color: var(--accent-color);
            text-decoration: none;
        }
        
        /* Responsive adjustments */
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
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-dark);
            border-radius: 10px;
        }
        
        /* Animated background elements */
        .bg-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .bg-element {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            background: var(--primary-light);
        }
        
        /* Pulse animation for active items */
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(45, 29, 97, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(45, 29, 97, 0); }
            100% { box-shadow: 0 0 0 0 rgba(45, 29, 97, 0); }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
    </style>
</head>

<body>
    <!-- Background decorative elements -->
    <div class="bg-elements">
        <div class="bg-element" style="width: 300px; height: 300px; top: -100px; left: -100px;"></div>
        <div class="bg-element" style="width: 200px; height: 200px; bottom: -50px; right: -50px;"></div>
    </div>
    
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-active-color="white">
            <div class="sidebar-wrapper">
                <div class="logo-container floating">
                    <img src="{{ asset('assets/img/Logo.png') }}" style="width: 140px;" alt="logo" class="img-fluid pulse">
                </div>

                <ul class="nav">
                    <li class="active">
                        <a href="dashboard.html">
                            <i class="ti-panel"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('societies.index') }}">
                            <i class="ti-view-list-alt"></i>
                            <p>Societies</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.elections.index') }}">
                            <i class="ti-calendar"></i>
                            <p>Elections</p>
                        </a>
                    </li>
                    <li>
                        <a href="notifications.html">
                            <i class="ti-bell"></i>
                            <p>Notifications</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Panel -->
        <div class="main-panel">
            <!-- Navbar -->
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
                            <span style="color: var(--primary-dark);">@yield('title')</span>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
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
                            <li>
                                <a href="#">
                                    <i class="ti-user"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="ti-settings"></i>
                                    <p>Settings</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <a href="#">About</a>
                            </li>
                            <li>
                                <a href="#">Features</a>
                            </li>
                            <li>
                                <a href="#">Contact</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright pull-right">
                        &copy; <script>document.write(new Date().getFullYear())</script> BUSPs. All rights reserved.
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- JavaScript Files -->
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
            
            // Create background elements dynamically
            function createBgElements() {
                const bgContainer = $('.bg-elements');
                for (let i = 0; i < 5; i++) {
                    const size = Math.random() * 200 + 50;
                    const posX = Math.random() * 100;
                    const posY = Math.random() * 100;
                    const opacity = Math.random() * 0.1 + 0.05;
                    const delay = Math.random() * 5;
                    
                    $('<div>').addClass('bg-element').css({
                        'width': size + 'px',
                        'height': size + 'px',
                        'left': posX + '%',
                        'top': posY + '%',
                        'opacity': opacity,
                        'animation': `float ${Math.random() * 10 + 10}s ease-in-out infinite ${delay}s`,
                        'background': `rgba(197, 227, 244, ${opacity})`
                    }).appendTo(bgContainer);
                }
            }
            
            createBgElements();
            
            // Custom notification
            $.notify({
                icon: 'fas fa-rocket',
                message: "Welcome to <b>BUSPs Election System</b> - Manage your elections with ease."
            }, {
                type: 'info',
                timer: 4000,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
            });
            
            // Add pulse animation to active sidebar item
            $('.sidebar .nav li.active a').addClass('pulse');
            
            // Responsive sidebar toggle
            $('.navbar-toggle').click(function() {
                $('.sidebar').toggleClass('active');
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
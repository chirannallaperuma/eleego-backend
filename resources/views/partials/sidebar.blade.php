<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS -->
    <link rel="stylesheet" href="public/dist/css/adminlte.min.css">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="public/dist/js/adminlte.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ url('/') }}" class="brand-link">
            <img src="{{ asset('dist/img/logo-sm.svg') }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">ELEEGO</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/user/new-user" class="nav-link">
                                    <i class="fa fa-plus-circle nav-icon"></i>
                                    <p>New User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/user/user-list" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>User List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-car"></i>
                            <p>Vehicles<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/vehicles/add" class="nav-link">
                                    <i class="fa fa-plus-circle nav-icon"></i>
                                    <p>New Vehicle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/vehicles" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>Vehicle List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Bookings<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/bookings/limousine" class="nav-link">
                                    <i class="fa fa-file-alt nav-icon"></i>
                                    <p>Limousine</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/bookings/rental" class="nav-link">
                                    <i class="fa fa-clipboard-list nav-icon"></i>
                                    <p>Rental</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</body>

</html>

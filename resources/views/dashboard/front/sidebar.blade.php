<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{ url('img/icon/icon-white.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: 0.9" />
        <span class="brand-text font-weight-light">Akane Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (auth()->user()->image)
                    <img src="{{ asset('storage/' . auth()->user()->image) }}" class="img-circle elevation-2"
                        alt="{{ auth()->user()->name }}" />
                @else
                    <img src="{{ url('img/user-icon/profile.png') }}" class="img-circle elevation-2" alt="User Image" />
                @endif

            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/news" class="nav-link {{ Request::is('dashboard/news*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>News</p>
                    </a>
                </li>
                <li class="nav-header">Administrator</li>
                <li class="nav-item">
                    <a href="/dashboard/categories"
                        class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/users" class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/feedback"
                        class="nav-link {{ Request::is('dashboard/feedback*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-comments"></i>
                        <p>Feedbacks</p>
                    </a>
                </li>
                <li class="nav-header">Other</li>
                <li class="nav-item">
                    <a href="/dashboard/account"
                        class="nav-link {{ Request::is('dashboard/account*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>My Account</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

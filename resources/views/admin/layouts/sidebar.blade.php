<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{route('admin.dashboard')}}" class=" {{ (request()->is('admin/dashboard')) ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fas fa-database"></i>
                        Admin Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{route('admins.index')}}" class=" {{ (request()->is('admin/admins*')) ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fas fa-users-cog"></i>
                        Admins
                    </a>
                </li>
                <li>
                    <a href="{{route('adminusers.index')}}" class=" {{ (request()->is('admin/adminusers*')) ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fas fa-users"></i>
                        Users
                    </a>
                </li>
                <li>
                    <a href="{{route('backend-products.index')}}" class=" {{ (request()->is('admin/backend-products*')) ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fas fa-tags"></i>
                        Products
                    </a>
                </li>
                <li>
                    <a href="{{route('backend-categories.index')}}" class=" {{ (request()->is('admin/backend-categories*')) ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fas fa-stream"></i>
                        Categories
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
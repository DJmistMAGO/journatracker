<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo d-flex justify-content-center align-items-center" style="height: 120px;">
        <div class="mt-3">
            <a href="{{url('/')}}" class="app-brand-link">
            <span class="app-brand-logo demo me-1">
                <img src="{{ asset('assets/img/spj/spj_logo.png') }}" alt="SPJ Logo" width="100" height="100">
            </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
            </a>
        </div>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1 mt-3">

        <li class="menu-header fw-medium">
            <span class="menu-header-text">Special Program in Journalism</span>
        </li>

        <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ url('/dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
            <div>Dashboards</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('publication*') ? 'active' : '' }}">
            <a href="{{ url('/publication') }}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-bookshelf"></i>
            <div>Publication Management</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('article-management*') ? 'active' : '' }}">
            <a href="{{ url('/article-management') }}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-book-edit-outline"></i>
            <div>Article Management</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('editorial-scheduling*') ? 'active' : '' }}">
            <a href="{{ url('/editorial-scheduling') }}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-book-clock-outline"></i>
            <div>Editorial Scheduling</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('incident-report*') ? 'active' : '' }}">
            <a href="{{ url('/incident-report') }}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-sticker-alert-outline"></i>
            <div>Incident Report</div>
            </a>
        </li>

        @role('admin')
            <li class="menu-item {{ request()->is('user-management*') ? 'active' : '' }}">
                <a href="{{ url('/user-management') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-account-cog"></i>
                <div>User Management</div>
                </a>
            </li>
        @endrole

        </ul>

    </aside>

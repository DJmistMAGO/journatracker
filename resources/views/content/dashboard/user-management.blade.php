@section('title', 'User - Management')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

{{-- @section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection --}}

@section('content')



<div class="layout-page">




        <!-- BEGIN: Navbar-->
                  <!-- Navbar -->
<nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
  <!--  Brand demo (display only for navbar-full and hide on below xl) -->

<!-- ! Not required for layout-without-menu -->
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0   d-xl-none ">
  <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
    <i class="icon-base ri ri-menu-line icon-md"></i>
  </a>
</div>

<div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">

    <!-- Search -->
  <div class="navbar-nav align-items-center">
    <div class="nav-item navbar-search-wrapper mb-0">
      <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
        <span class="d-inline-block text-body-secondary fw-normal" id="autocomplete"><div class="aa-Autocomplete" role="combobox" aria-expanded="false" aria-haspopup="listbox" aria-labelledby="autocomplete-0-label"><button type="button" class="aa-DetachedSearchButton" title="Search" id="autocomplete-0-label"><div class="aa-DetachedSearchButtonIcon" aria-label="Search"><svg class="aa-SubmitIcon" viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M16.041 15.856c-0.034 0.026-0.067 0.055-0.099 0.087s-0.060 0.064-0.087 0.099c-1.258 1.213-2.969 1.958-4.855 1.958-1.933 0-3.682-0.782-4.95-2.050s-2.050-3.017-2.050-4.95 0.782-3.682 2.050-4.95 3.017-2.050 4.95-2.050 3.682 0.782 4.95 2.050 2.050 3.017 2.050 4.95c0 1.886-0.745 3.597-1.959 4.856zM21.707 20.293l-3.675-3.675c1.231-1.54 1.968-3.493 1.968-5.618 0-2.485-1.008-4.736-2.636-6.364s-3.879-2.636-6.364-2.636-4.736 1.008-6.364 2.636-2.636 3.879-2.636 6.364 1.008 4.736 2.636 6.364 3.879 2.636 6.364 2.636c2.125 0 4.078-0.737 5.618-1.968l3.675 3.675c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414z"></path></svg></div><div class="aa-DetachedSearchButtonPlaceholder">Search [CTRL + K]</div><div class="aa-DetachedSearchButtonQuery"></div></button></div></span>
      </a>
    </div>
  </div>
  <!-- /Search -->

  <ul class="navbar-nav flex-row align-items-center ms-md-auto">

    <!-- Language -->
    <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <i class="icon-base ri ri-translate-2 icon-22px"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item active waves-effect" href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/lang/en" data-language="en" data-text-direction="ltr">
            <span>English</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item  waves-effect" href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/lang/fr" data-language="fr" data-text-direction="ltr">
            <span>French</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item  waves-effect" href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/lang/ar" data-language="ar" data-text-direction="rtl">
            <span>Arabic</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item  waves-effect" href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/lang/de" data-language="de" data-text-direction="ltr">
            <span>German</span>
          </a>
        </li>
      </ul>
    </li>
    <!--/ Language -->

        <!-- Style Switcher -->
    <li class="nav-item dropdown me-sm-2 me-xl-0">
      <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill waves-effect" id="nav-theme" href="javascript:void(0);" data-bs-toggle="dropdown" aria-label="Toggle theme (light)">
        <i class="ri-sun-line icon-base ri icon-22px theme-icon-active"></i>
        <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
        <li>
          <button type="button" class="dropdown-item align-items-center waves-effect active" data-bs-theme-value="light" aria-pressed="true">
            <span> <i class="icon-base ri ri-sun-line icon-md me-3" data-icon="sun-line"></i>Light</span>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item align-items-center waves-effect" data-bs-theme-value="dark" aria-pressed="false">
            <span> <i class="icon-base ri ri-moon-clear-line icon-md me-3" data-icon="moon-clear-line"></i>Dark</span>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item align-items-center waves-effect" data-bs-theme-value="system" aria-pressed="false">
            <span> <i class="icon-base ri ri-computer-line icon-md me-3" data-icon="computer-line"></i>System</span>
          </button>
        </li>
      </ul>
    </li>
    <!-- / Style Switcher-->

    <!-- Quick links  -->
    <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-sm-2 me-xl-0">
      <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill waves-effect" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
        <i class="icon-base ri ri-star-smile-line icon-22px"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-end p-0">
        <div class="dropdown-menu-header border-bottom">
          <div class="dropdown-header d-flex align-items-center py-2 my-50">
            <h6 class="mb-0 me-auto">Shortcuts</h6>
            <a href="javascript:void(0)" class="dropdown-shortcuts-add btn btn-text-secondary rounded-pill btn-icon waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Add shortcuts" data-bs-original-title="Add shortcuts">
              <i class="icon-base ri ri-add-line icon-20px text-heading"></i>
            </a>
          </div>
        </div>
        <div class="dropdown-shortcuts-list scrollable-container ps">
          <div class="row row-bordered overflow-visible g-0">
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                <i class="icon-base ri ri-calendar-line icon-26px text-heading"></i>
              </span>
              <a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/app/calendar" class="stretched-link">Calendar</a>
              <small>Appointments</small>
            </div>
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                <i class="icon-base ri ri-file-text-line icon-26px text-heading"></i>
              </span>
              <a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/app/invoice/list" class="stretched-link">Invoice App</a>
              <small>Manage Accounts</small>
            </div>
          </div>
          <div class="row row-bordered overflow-visible g-0">
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                <i class="icon-base ri ri-user-line icon-26px text-heading"></i>
              </span>
              <a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/app/user/list" class="stretched-link">User App</a>
              <small>Manage Users</small>
            </div>
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                <i class="icon-base ri ri-computer-line icon-26px text-heading"></i>
              </span>
              <a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/app/access-roles" class="stretched-link">Role Management</a>
              <small>Permission</small>
            </div>
          </div>
          <div class="row row-bordered overflow-visible g-0">
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                <i class="icon-base ri ri-pie-chart-2-line icon-26px text-heading"></i>
              </span>
              <a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1" class="stretched-link">Dashboard</a>
              <small>User Dashboard</small>
            </div>
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                <i class="icon-base ri ri-settings-4-line icon-26px text-heading"></i>
              </span>
              <a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/pages/account-settings-account" class="stretched-link">Setting</a>
              <small>Account Settings</small>
            </div>
          </div>
          <div class="row row-bordered overflow-visible g-0">
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                <i class="icon-base ri ri-question-line icon-26px text-heading"></i>
              </span>
              <a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/pages/faq" class="stretched-link">FAQs</a>
              <small>FAQs &amp; Articles</small>
            </div>
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                <i class="icon-base ri ri-tv-2-line icon-26px text-heading"></i>
              </span>
              <a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/modal-examples" class="stretched-link">Modals</a>
              <small>Useful Popups</small>
            </div>
          </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
      </div>
    </li>
    <!-- Quick links -->

    <!-- Notification -->
    <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
      <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill waves-effect" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
        <span class="position-relative">
          <i class="icon-base ri ri-notification-2-line icon-22px"></i>
          <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
        </span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end p-0">
        <li class="dropdown-menu-header border-bottom">
          <div class="dropdown-header d-flex align-items-center py-3">
            <h6 class="mb-0 me-auto">Notification</h6>
            <div class="d-flex align-items-center h6 mb-0">
              <span class="badge bg-label-primary rounded-pill me-2">8 New</span>
              <a href="javascript:void(0)" class="dropdown-notifications-all p-2" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark all as read" data-bs-original-title="Mark all as read">
                <i class="icon-base ri ri-mail-open-line text-heading"></i>
              </a>
            </div>
          </div>
        </li>
        <li class="dropdown-notifications-list scrollable-container ps">
          <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action dropdown-notifications-item waves-effect">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <img src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/1.png" alt="alt" class="rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="small mb-50">Congratulation Lettie 🎉</h6>
                  <small class="mb-1 d-block text-body">Won the monthly best seller gold badge</small>
                  <small class="text-body-secondary">1h ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"> <span class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"> <span class="icon-base ri ri-close-line"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item waves-effect">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="small mb-50">Charles Franklin</h6>
                  <small class="mb-1 d-block text-body">Accepted your connection</small>
                  <small class="text-body-secondary">12hr ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"> <span class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"> <span class="icon-base ri ri-close-line"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read waves-effect">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <img src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/2.png" alt="alt" class="rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="small mb-50">New Message ✉️</h6>
                  <small class="mb-1 d-block text-body">You have new message from Natalie</small>
                  <small class="text-body-secondary">1h ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"> <span class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"> <span class="icon-base ri ri-close-line"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item waves-effect">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <span class="avatar-initial rounded-circle bg-label-success">
                      <i class="icon-base ri ri-car-line"></i>
                    </span>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="small mb-50">Whoo! You have new order 🛒</h6>
                  <small class="mb-1 d-block text-body">ACME Inc. made new order $1,154</small>
                  <small class="text-body-secondary">1 day ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"> <span class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"> <span class="icon-base ri ri-close-line"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read waves-effect">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <img src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/9.png" alt="alt" class="rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="small mb-50">Application has been approved 🚀</h6>
                  <small class="mb-1 d-block text-body">Your ABC project application has been approved.</small>
                  <small class="text-body-secondary">2 days ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"> <span class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"> <span class="icon-base ri ri-close-line"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read waves-effect">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <span class="avatar-initial rounded-circle bg-label-success">
                      <i class="icon-base ri ri-pie-chart-2-line"></i>
                    </span>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="small mb-50">Monthly report is generated</h6>
                  <small class="mb-1 d-block text-body">July monthly financial report is generated </small>
                  <small class="text-body-secondary">3 days ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"> <span class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"> <span class="icon-base ri ri-close-line"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read waves-effect">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <img src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/5.png" alt="alt" class="rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="small mb-50">Send connection request</h6>
                  <small class="mb-1 d-block text-body">Peter sent you connection request</small>
                  <small class="text-body-secondary">4 days ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"> <span class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"> <span class="icon-base ri ri-close-line"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item waves-effect">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <img src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/6.png" alt="alt" class="rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="small mb-50">New message from Jane</h6>
                  <small class="mb-1 d-block text-body">Your have new message from Jane</small>
                  <small class="text-body-secondary">5 days ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"> <span class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"> <span class="icon-base ri ri-close-line"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read waves-effect">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <span class="avatar-initial rounded-circle bg-label-warning">
                      <i class="icon-base ri ri-error-warning-line"></i>
                    </span>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="small mb-50">CPU is running high</h6>
                  <small class="mb-1 d-block text-body">CPU Utilization Percent is currently at 88.63%,</small>
                  <small class="text-body-secondary">5 days ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"> <span class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"> <span class="icon-base ri ri-close-line"></span></a>
                </div>
              </div>
            </li>
          </ul>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></li>
        <li class="border-top">
          <div class="d-grid p-4">
            <a class="btn btn-primary btn-sm d-flex h-px-34 waves-effect waves-light" href="javascript:void(0);">
              <small class="align-middle">View all notifications</small>
            </a>
          </div>
        </li>
      </ul>
    </li>
    <!--/ Notification -->
    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
          <img src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/1.png" alt="alt" class="rounded-circle">
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
        <li>
          <a class="dropdown-item waves-effect" href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/pages/profile-user">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0 me-2">
                <div class="avatar avatar-online">
                  <img src="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/1.png" alt="alt" class="w-px-40 h-auto rounded-circle">
                </div>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-0 small">
                                    John Doe
                                  </h6>
                <small class="text-body-secondary">Admin</small>
              </div>
            </div>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <a class="dropdown-item waves-effect" href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/pages/profile-user">
            <i class="icon-base ri ri-user-3-line icon-22px me-2"></i>
            <span class="align-middle">My Profile</span>
          </a>
        </li>
                <li>
          <a class="dropdown-item waves-effect" href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/pages/account-settings-billing">
            <span class="d-flex align-items-center align-middle">
              <i class="flex-shrink-0 icon-base ri ri-file-text-line icon-22px me-2"></i>
              <span class="flex-grow-1 align-middle">Billing</span>
              <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger h-px-20 d-flex align-items-center justify-content-center">4</span>
            </span>
          </a>
        </li>
                <li>
          <div class="dropdown-divider my-1"></div>
        </li>
                <li>
          <div class="d-grid px-4 pt-2 pb-1">
            <a class="btn btn-danger d-flex waves-effect waves-light" href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/auth/login-basic">
              <small class="align-middle">Login</small>
              <i class="icon-base ri ri-logout-box-r-line ms-2 icon-16px"></i>
            </a>
          </div>
        </li>
              </ul>
    </li>
    <!--/ User -->
  </ul>
</div>
</nav>
<!-- / Navbar -->
                <!-- END: Navbar-->

        <!-- Content wrapper -->
        <div class="content-wrapper">

          <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">

          <div class="row g-6 mb-6">
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="me-1">
            <p class="text-heading mb-1">Users</p>
            <div class="d-flex align-items-center">
              <h4 class="mb-1 me-2">3</h4>
              <p class="text-success mb-1">(100%)</p>
            </div>
            <small class="mb-0">Total Users</small>
          </div>
          <div class="avatar">
            <div class="avatar-initial bg-label-primary rounded">
              <div class="icon-base ri ri-group-line icon-26px"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="me-1">
            <p class="text-heading mb-1">Verified Users</p>
            <div class="d-flex align-items-center">
              <h4 class="mb-1 me-2">0</h4>
              <p class="text-success mb-1">(+95%)</p>
            </div>
            <small class="mb-0">Recent analytics</small>
          </div>
          <div class="avatar">
            <div class="avatar-initial bg-label-danger rounded">
              <div class="icon-base ri ri-user-add-line icon-26px scaleX-n1"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="me-1">
            <p class="text-heading mb-1">Duplicate Users</p>
            <div class="d-flex align-items-center">
              <h4 class="mb-1 me-2">0</h4>
              <p class="text-danger mb-1">(0%)</p>
            </div>
            <small class="mb-0">Recent analytics</small>
          </div>
          <div class="avatar">
            <div class="avatar-initial bg-label-success rounded">
              <div class="icon-base ri ri-user-follow-line icon-26px"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="me-1">
            <p class="text-heading mb-1">Verification Pending</p>
            <div class="d-flex align-items-center">
              <h4 class="mb-1 me-2">3</h4>
              <p class="text-success mb-1">(+6%)</p>
            </div>
            <small class="mb-0">Recent analytics</small>
          </div>
          <div class="avatar">
            <div class="avatar-initial bg-label-warning rounded">
              <div class="icon-base ri ri-user-search-line icon-26px"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Users List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h6 class="card-title mb-0">Filters</h6>
  </div>
  <div class="card-datatable">
    <div id="DataTables_Table_0_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer"><div class="row m-3 my-0 justify-content-between"><div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto mt-md-0 mt-5"><div class="dt-length mb-md-5 mb-0"><select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select form-select-sm ms-0" id="dt-length-0"><option value="7">7</option><option value="10">10</option><option value="20">20</option><option value="50">50</option><option value="70">70</option><option value="100">100</option></select><label for="dt-length-0"></label></div></div><div class="d-md-flex align-items-center dt-layout-end col-md-auto ms-auto d-flex gap-md-4 justify-content-md-between justify-content-center gap-md-2 flex-wrap mt-0"><div class="dt-search"><input type="search" class="form-control form-control-sm" id="dt-search-0" placeholder="Search User" aria-controls="DataTables_Table_0"><label for="dt-search-0"></label></div><div class="dt-buttons btn-group flex-wrap d-md-flex d-block gap-4 mb-md-0 mb-5 justify-content-center"> <div class="btn-group"><button class="btn buttons-collection btn-label-secondary dropdown-toggle" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="icon-base ri ri-upload-2-line me-2 icon-sm"></i>Export</span></button></div> <button class="btn add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="icon-base ri ri-add-line icon-sm me-0 me-sm-2"></i><span class="d-none d-sm-inline-block">Add New User</span></span></button> </div></div></div><div class="justify-content-between dt-layout-table"><div class="d-md-flex justify-content-between align-items-center dt-layout-full"><div id="DataTables_Table_0_processing" class="dt-processing card" role="status" style="display: none;"><div><div></div><div></div><div></div><div></div></div></div><table class="datatables-users table dataTable dtr-column table-responsive" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 100%;"><colgroup><col data-dt-column="1" style="width: 73.9px;"><col data-dt-column="2" style="width: 218.875px;"><col data-dt-column="3" style="width: 249.15px;"><col data-dt-column="4" style="width: 150.85px;"><col data-dt-column="5" style="width: 241.625px;"></colgroup>
      <thead>
        <tr><th data-dt-column="0" class="control dt-orderable-none dtr-hidden" rowspan="1" colspan="1" aria-label="" style="display: none;"><span class="dt-column-title"></span><span class="dt-column-order"></span></th><th data-dt-column="1" rowspan="1" colspan="1" class="dt-orderable-none dt-type-numeric" aria-label="Id"><span class="dt-column-title">Id</span><span class="dt-column-order"></span></th><th data-dt-column="2" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc dt-ordering-desc" aria-sort="descending" aria-label="User: Activate to remove sorting" tabindex="0"><span class="dt-column-title" role="button">User</span><span class="dt-column-order"></span></th><th data-dt-column="3" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Email: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Email</span><span class="dt-column-order"></span></th><th data-dt-column="4" class="text-center dt-orderable-asc dt-orderable-desc" rowspan="1" colspan="1" aria-label="Verified: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Verified</span><span class="dt-column-order"></span></th><th data-dt-column="5" rowspan="1" colspan="1" class="dt-orderable-none" aria-label="Actions"><span class="dt-column-title">Actions</span><span class="dt-column-order"></span></th></tr>
      </thead><tbody><tr><td class="control dtr-hidden" tabindex="0" style="display: none;"></td><td class="dt-type-numeric"><span>1</span></td><td class="sorting_1">
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-4">
                    <span class="avatar-initial rounded-circle bg-label-primary">JD</span>
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account" class="text-truncate text-heading">
                    <span class="fw-medium">John Doe</span>
                  </a>
                </div>
              </div>
            </td><td><span class="user-email">johndoe@user.com</span></td><td class="text-center"><i class="icon-base ri fs-4 ri-shield-line text-danger"></i></td><td><div class="d-flex align-items-center gap-4"><button class="btn btn-icon btn-text-secondary btn-sm rounded-pill edit-record" data-id="75" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><i class="icon-base ri ri-edit-box-line icon-22px"></i></button><button class="btn btn-icon btn-text-secondary btn-sm rounded-pill delete-record" data-id="75"><i class="icon-base ri ri-delete-bin-7-line icon-22px"></i></button><button class="btn btn-icon btn-text-secondary btn-sm rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base ri ri-more-2-line icon-22px"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr><tr><td class="control dtr-hidden" tabindex="0" style="display: none;"></td><td class="dt-type-numeric"><span>2</span></td><td class="sorting_1">
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-4">
                    <span class="avatar-initial rounded-circle bg-label-success">GG</span>
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account" class="text-truncate text-heading">
                    <span class="fw-medium">Guest</span>
                  </a>
                </div>
              </div>
            </td><td><span class="user-email">guest@guest.com</span></td><td class="text-center"><i class="icon-base ri fs-4 ri-shield-line text-danger"></i></td><td><div class="d-flex align-items-center gap-4"><button class="btn btn-icon btn-text-secondary btn-sm rounded-pill edit-record" data-id="74" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><i class="icon-base ri ri-edit-box-line icon-22px"></i></button><button class="btn btn-icon btn-text-secondary btn-sm rounded-pill delete-record" data-id="74"><i class="icon-base ri ri-delete-bin-7-line icon-22px"></i></button><button class="btn btn-icon btn-text-secondary btn-sm rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base ri ri-more-2-line icon-22px"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr><tr><td class="control dtr-hidden" tabindex="0" style="display: none;"></td><td class="dt-type-numeric"><span>3</span></td><td class="sorting_1">
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-4">
                    <span class="avatar-initial rounded-circle bg-label-primary">AA</span>
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account" class="text-truncate text-heading">
                    <span class="fw-medium">Admin</span>
                  </a>
                </div>
              </div>
            </td><td><span class="user-email">admin@admin.com</span></td><td class="text-center"><i class="icon-base ri fs-4 ri-shield-line text-danger"></i></td><td><div class="d-flex align-items-center gap-4"><button class="btn btn-icon btn-text-secondary btn-sm rounded-pill edit-record" data-id="58" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><i class="icon-base ri ri-edit-box-line icon-22px"></i></button><button class="btn btn-icon btn-text-secondary btn-sm rounded-pill delete-record" data-id="58"><i class="icon-base ri ri-delete-bin-7-line icon-22px"></i></button><button class="btn btn-icon btn-text-secondary btn-sm rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base ri ri-more-2-line icon-22px"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="https://demos.themeselection.com/materio-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr></tbody>
    <tfoot></tfoot></table></div></div><div class="row mx-3 justify-content-between"><div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto me-auto mt-md-0 mt-5"><div class="dt-info" aria-live="polite" id="DataTables_Table_0_info" role="status">Showing 1 to 3 of 3 entries</div></div><div class="d-md-flex align-items-center dt-layout-end col-md-auto ms-auto d-flex gap-md-4 justify-content-md-between justify-content-center gap-md-2 flex-wrap mt-0"><div class="dt-paging"><nav aria-label="pagination"><ul class="pagination"><li class="dt-paging-button page-item disabled"><button class="page-link first" role="link" type="button" aria-controls="DataTables_Table_0" aria-disabled="true" aria-label="First" data-dt-idx="first" tabindex="-1"><i class="icon-base ri ri-skip-back-mini-line scaleX-n1-rtl icon-22px"></i></button></li><li class="dt-paging-button page-item disabled"><button class="page-link previous" role="link" type="button" aria-controls="DataTables_Table_0" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1"><i class="icon-base ri ri-arrow-left-s-line scaleX-n1-rtl icon-22px"></i></button></li><li class="dt-paging-button page-item active"><button class="page-link" role="link" type="button" aria-controls="DataTables_Table_0" aria-current="page" data-dt-idx="0">1</button></li><li class="dt-paging-button page-item disabled"><button class="page-link next" role="link" type="button" aria-controls="DataTables_Table_0" aria-disabled="true" aria-label="Next" data-dt-idx="next" tabindex="-1"><i class="icon-base ri ri-arrow-right-s-line scaleX-n1-rtl icon-22px"></i></button></li><li class="dt-paging-button page-item disabled"><button class="page-link last" role="link" type="button" aria-controls="DataTables_Table_0" aria-disabled="true" aria-label="Last" data-dt-idx="last" tabindex="-1"><i class="icon-base ri ri-skip-forward-mini-line scaleX-n1-rtl icon-22px"></i></button></li></ul></nav></div></div></div></div>
  </div>
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header border-bottom">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
      <form class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addNewUserForm" novalidate="novalidate">
        <input type="hidden" name="id" id="user_id">
        <div class="form-floating form-floating-outline mb-5 form-control-validation fv-plugins-icon-container">
          <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="name" aria-label="John Doe">
          <label for="add-user-fullname">Full Name</label>
        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
        <div class="form-floating form-floating-outline mb-5 form-control-validation fv-plugins-icon-container">
          <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="email">
          <label for="add-user-email">Email</label>
        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
        <div class="form-floating form-floating-outline mb-5 form-control-validation fv-plugins-icon-container">
          <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact">
          <label for="add-user-contact">Contact</label>
        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
        <div class="form-floating form-floating-outline mb-5 form-control-validation fv-plugins-icon-container">
          <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer" aria-label="jdoe1" name="company">
          <label for="add-user-company">Company</label>
        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
        <div class="form-floating form-floating-outline mb-5 form-floating-select2">
          <div class="position-relative"><select id="country" class="select2 form-select select2-hidden-accessible" data-select2-id="country" tabindex="-1" aria-hidden="true">
            <option value="" data-select2-id="2">Select</option>
            <option value="Australia">Australia</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Belarus">Belarus</option>
            <option value="Brazil">Brazil</option>
            <option value="Canada">Canada</option>
            <option value="China">China</option>
            <option value="France">France</option>
            <option value="Germany">Germany</option>
            <option value="India">India</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Japan">Japan</option>
            <option value="Korea">Korea, Republic of</option>
            <option value="Mexico">Mexico</option>
            <option value="Philippines">Philippines</option>
            <option value="Russia">Russian Federation</option>
            <option value="South Africa">South Africa</option>
            <option value="Thailand">Thailand</option>
            <option value="Turkey">Turkey</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United Arab Emirates">United Arab Emirates</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="United States">United States</option>
          </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: 360px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-country-container"><span class="select2-selection__rendered" id="select2-country-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select Country</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
          <label for="country">Country</label>
        </div>
        <div class="form-floating form-floating-outline mb-5">
          <select id="user-role" class="form-select">
            <option value="subscriber">Subscriber</option>
            <option value="editor">Editor</option>
            <option value="maintainer">Maintainer</option>
            <option value="author">Author</option>
            <option value="admin">Admin</option>
          </select>
          <label for="user-role">User Role</label>
        </div>
        <div class="form-floating form-floating-outline mb-5">
          <select id="user-plan" class="form-select">
            <option value="basic">Basic</option>
            <option value="enterprise">Enterprise</option>
            <option value="company">Company</option>
            <option value="team">Team</option>
          </select>
          <label for="user-plan">Select Plan</label>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit waves-effect waves-light">Submit</button>
        <button type="reset" class="btn btn-outline-danger waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
      <input type="hidden"></form>
    </div>
  </div>
</div>


        </div>
        <!-- / Content -->

        <!-- Footer -->
                  <!-- Footer -->
<!--/ Footer-->                <!-- / Footer -->
        <div class="content-backdrop fade"></div>
      </div>
      <!--/ Content wrapper -->
    </div>

    @endsection

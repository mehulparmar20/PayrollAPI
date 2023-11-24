<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="topbar-logo-header d-none d-lg-flex">
                <div class="">
                    <input type="hidden" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" id="url" value="{{URL::to('/')}}">
                    <img src="{{URL::to('/')}}/public/frontend/assets/img/logo/2.png" class="logo-icon" alt="logo icon">
                </div>
            </div>
            @if(Auth::guard('admin')->user() !=null)
                <?php
                    $user=Auth::guard('admin')->user()->username;
                ?>
                <div class="user-box dropdown px-3" >
                    <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{URL::to('/')}}/public/admin/assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
                        <div class="user-info">
                            <p class="user-name mb-0">{{$user}}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bx bx-cog fs-5"></i><span>Settings</span></a>
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="#" onclick="UpdateTax()"><i class="bx bx-dollar-circle fs-5"></i><span>Taxes</span></a>
                        </li>
                        <!-- <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bx bx-download fs-5"></i><span>Downloads</span></a>
                        </li> -->
                        <li>
                            <div class="dropdown-divider mb-0"></div>
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('adminLogout')}}"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
                        </li>
                    </ul>
                </div>
            @endif
        </nav>
    </div>
</header>
<!--end header -->
<!--navigation-->
<div class="primary-menu">
    <nav class="navbar navbar-expand-lg align-items-center">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header border-bottom">
            <div class="d-flex align-items-center">
                <div class="">
                    <img src="{{URL::to('/')}}/public/frontend/assets/img/logo/2.png" class="logo-icon" alt="logo icon">
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav align-items-center flex-grow-1">
                @if(Auth::guard('admin')->user() !=null)
                    <li class="nav-item ">
                        <a class="nav-link  -toggle-nocaret" href="{{route('admin.index')}}">
                            <div class="menu-title d-flex align-items-center">Dashboard</div>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link  -toggle-nocaret" href="{{route('admin.user_index')}}">
                            <div class="menu-title d-flex align-items-center">Users</div>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link  -toggle-nocaret" href="{{route('admin.order_index')}}">
                            <div class="menu-title d-flex align-items-center">Orders</div>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link  -toggle-nocaret" href="{{route('admin.trip_index')}}">
                            <div class="menu-title d-flex align-items-center">Trips</div>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link  -toggle-nocaret" href="#">
                            <div class="menu-title d-flex align-items-center">Payments</div>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link  -toggle-nocaret" href="{{route('admin.index_country')}}">
                            <div class="menu-title d-flex align-items-center">Country</div>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link  -toggle-nocaret" href="{{route('admin.index_state')}}">
                            <div class="menu-title d-flex align-items-center">States</div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                            <div class="menu-title d-flex align-items-center">Custom</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('admin.index_topShop')}}"><i class='bx bx-pie-chart-alt' ></i>Top Shop</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        </div>
    </nav>
</div>
@include('admin.tax.update_tax')
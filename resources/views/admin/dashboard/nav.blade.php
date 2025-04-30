<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <!-- Sidenav Menu Heading (Account)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <div class="sidenav-menu-heading d-sm-none">Account</div>
                <!-- Sidenav Link (Alerts)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <a class="nav-link d-sm-none" href="#!">
                    <div class="nav-link-icon"><i data-feather="bell"></i></div>
                    Alerts
                    <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                </a>
                <!-- Sidenav Link (Messages)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <a class="nav-link d-sm-none" href="#!">
                    <div class="nav-link-icon"><i data-feather="mail"></i></div>
                    Messages
                    <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                </a>

                <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">Dashboard Pages</div>
                <a class="nav-link {{request()->routeIs('admin.dashboard') ? 'active' : ''}}" href="dashboard">
                    <div class="nav-link-icon"><i class="fa-solid fa-house"></i></div>
                    Dashboard
                </a>

                                <!-- Sidenav Heading (Addons)-->
                                <div class="sidenav-menu-heading">Account Pages</div>
                <a class="nav-link {{request()->routeIs('user.*') ? 'active' : ''}}" href="{{ route('user.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    User
                </a>


                <!-- Sidenav Heading (Custom)-->
                <div class="sidenav-menu-heading">Product Pages</div>
                <a class="nav-link {{request()->routeIs('product-categories.*') ? 'active' : ''}}" href="{{ route('product-categories.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-bread-slice"></i></div>
                    Product Category
                </a>
                <a class="nav-link {{request()->routeIs('product.*') ? 'active' : ''}}" href="{{ route('product.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-cake-candles"></i></div>
                    Product
                </a>

                <!-- Sidenav Heading (UI Toolkit)-->
                <div class="sidenav-menu-heading">Customer Pages</div>
                <a class="nav-link {{request()->routeIs('customer.*') ? 'active' : ''}}" href="{{ route('customer.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-address-card"></i></div>
                    Customer
                </a>

                <a class="nav-link {{request()->routeIs('order.*') ? 'active' : ''}}" href="{{ route('order.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-receipt"></i></div>
                    Order
                </a>

                <!-- Sidenav Heading (Custom)-->
                <div class="sidenav-menu-heading">Discount Pages</div>
                <a class="nav-link {{request()->routeIs('discount.*') ? 'active' : ''}}" href="{{ route('discount.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-percent"></i></div>
                    Discount
                </a>

            </div>
        </div>

        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title">{{Auth::guard('admin')->user()->name}}</div>
            </div>
        </div>
    </nav>
</div>

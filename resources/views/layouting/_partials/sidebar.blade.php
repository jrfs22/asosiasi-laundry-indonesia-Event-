<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('assets/logo/asli.png') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ isRouteActive('reward') ? 'active' : '' }}"
                        href="{{ route('reward') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-award"></i>
                        </span>
                        <span class="hide-menu">Reward</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

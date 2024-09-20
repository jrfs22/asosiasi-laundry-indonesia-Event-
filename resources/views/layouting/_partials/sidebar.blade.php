<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('beranda') }}" class="text-nowrap logo-img">
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
                @role('super-admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ isRouteActive('events') ? 'active' : '' }}" href="{{ route('events') }}"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-calendar-event"></i>
                            </span>
                            <span class="hide-menu">Events</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ isRouteActive('member') ? 'active' : '' }}" href="{{ route('member') }}"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Member</span>
                        </a>
                    </li>
                @endrole
                <li class="sidebar-item">
                    <a class="sidebar-link {{ isRouteActive('pendaftar') ? 'active' : '' }}"
                        href="{{ route('pendaftar') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-ticket"></i>
                        </span>
                        <span class="hide-menu">Pendaftar</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ isRouteActive('peserta') ? 'active' : '' }}" href="{{ route('peserta') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Peserta</span>
                    </a>
                </li>
                @role('super-admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ isRouteActive('qrcode') ? 'active' : '' }}" href="{{ route('qrcode') }}"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-qrcode"></i>
                            </span>
                            <span class="hide-menu">QR Code</span>
                        </a>
                    </li>
                @endrole
                @can('read absensi')
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ (isRouteActive('absensi') ? 'active' : (isRouteActive('scan') ? 'active' : '')) }}" href="{{ route('absensi') }}"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-clock"></i>
                            </span>
                            <span class="hide-menu">Absensi</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>

<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        <div class="c-sidebar-brand-full" width="118" height="46" alt="Master Data">
            <img src="{{ asset('img/profile/logo.png') }}" width="120" height="46">
        </div>
        <svg class="c-sidebar-brand-minimized" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('coreui/assets/brand/coreui.svg#signet') }}"></use>
        </svg>
    </div>
    <div class="c-sidebar-brand d-md-none">
        <img src="{{ asset('img/profile/logo.png') }}" width="120" height="46">
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('home') }}">
                <i class="c-sidebar-nav-icon c-icon cil-home"></i> Dashboard</a>
        </li>

        <li class="c-sidebar-nav-title">
            Management Master
        </li>
         <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('pasien.index') }}">
                <i class="c-sidebar-nav-icon c-icon cil-user"></i> Pasien
            </a>
        </li>

        <li class="c-sidebar-nav-title">
            Transaksi
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('registrasi.index') }}">
                <i class="c-sidebar-nav-icon c-icon cil-user"></i> Pembuatan Sep
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('antrian.index') }}">
                <i class="c-sidebar-nav-icon c-icon cil-user"></i> Antrian
            </a>
        </li>

        <li class="c-sidebar-nav-divider"></li>

        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon c-icon cil-star"></i> Users and Roles</a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('read-role')
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('roles.index') }}">
                        <i class="c-sidebar-nav-icon c-icon cil-settings"> </i>Manage Roles</a>
                </li>
                @endcan
                @can('read-user')
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('users.index') }}">
                        <i class="c-sidebar-nav-icon c-icon cil-user"> </i>Manage User</a>
                </li>
                @endcan
            </ul>
        </li>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>

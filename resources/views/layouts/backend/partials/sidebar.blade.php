<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <div class="c-sidebar-brand-full" alt="Master Data">
            <img src="{{ asset('img/profile/login-new.png') }}" width="120" height="120">
        </div>
        <svg class="c-sidebar-brand-minimized" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('coreui/assets/brand/coreui.svg#signet') }}"></use>
        </svg>
    </div>
    <div class="c-sidebar-brand d-lg-none">
        <img src="{{ asset('img/profile/login-new.png') }}" width="120" height="120">
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
            <a class="c-sidebar-nav-link" href="{{ route('pegawai.index') }}">
                <i class="c-sidebar-nav-icon c-icon cil-user"></i> Pegawai
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('client.index') }}">
                <i class="c-sidebar-nav-icon c-icon cil-user"></i> Client
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('divisi.index') }}">
                <i class="c-sidebar-nav-icon c-icon cil-user"></i> Divisi
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="#">
                <i class="c-sidebar-nav-icon c-icon cil-user"></i> Jenis Pekerjaan
            </a>
        </li>

        <li class="c-sidebar-nav-title">
            Registrasi Client
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('pegawai.index') }}">
                <i class="c-sidebar-nav-icon c-icon cil-user"></i> Registrasi Client
            </a>
        </li>


        <li class="c-sidebar-nav-divider"></li>

        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon c-icon cil-star"></i> Users and Roles</a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="" target="_top">
                        <i class="c-sidebar-nav-icon c-icon cil-settings"> </i>Manage Roles</a>
                </li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="" target="_top">
                        <i class="c-sidebar-nav-icon c-icon cil-user"> </i>Manage User</a>
                </li>
            </ul>
        </li>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <?php $user = Auth::user(); ?>
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <i class="c-icon c-icon-lg cil-menu"></i>
    </button>
    <div class="row  d-lg-none">
        <div class="col-sm-12">
        <a class="c-header-brand" href="#">
            <img src="{{ asset('img/profile/login-new.png') }}" class="img-fluid" style="max-height:50px">
    </a>
        </div>
    </div>
    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <i class="c-icon c-icon-lg cil-menu"></i>
    </button>
    <ul class="c-header-nav d-md-down-none">
        <!-- <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Dashboard</a></li>
        <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Users</a></li>
        <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Settings</a></li> -->
    </ul>
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item d-md-down-none mx-2">
        Selamat datang <b>{{ ($user != null ? $user->nama_pegawai : 'Brow' ) }}</b>      
    </li> 
        <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            @if(is_numeric($user->kd_pegawai)) 
                <div class="c-avatar"><img class="c-avatar-img" src="{{ asset('storage/images/user/'.$user->kd_pegawai.'.jpg') }}" alt="profile"></div>
                @else
                <div class="c-avatar"><img class="c-avatar-img" src="{{ asset('img/profile/profile.png') }}" alt="profile"></div>
            @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
                <a class="dropdown-item mt-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                    <i class="c-icon mr-2 cil-account-logout">
                    </i> {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    @include('layouts.backend.partials.bcrum')
</header>
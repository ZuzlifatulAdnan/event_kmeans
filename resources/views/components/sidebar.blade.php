<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <!-- Logo image -->
            <a href="{{ route('beranda.index') }}">
                <img src="{{ asset('img/logo/logo_nama.png') }}" alt="Logo" style="width: 180px; height: auto;">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <!-- Small logo version -->
            <a href="{{ route('beranda.index') }}">
                <img src="{{ asset('img/logo/logo.png') }}" alt="Logo" style="width: 40px; height: auto;">
            </a>
        </div>
        <br>
        <ul class="sidebar-menu">
            <li class="menu-header">Beranda</li>
            <li class="nav-item dropdown {{ $type_menu === 'beranda' ? 'active' : '' }}">
                <a href="{{ route('beranda.index') }}" class="nav-link ha"><i
                        class="fas fa-home"></i><span>Beranda</span></a>
            </li>
            <li class="menu-header">Menu</li>
         
            <li class="nav-item dropdown {{ $type_menu === 'kmeans' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-shopping-cart"></i><span>kmeans</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('kmeans') ? 'active' : '' }}'>
                        <a class="nav-link" href="">Kmeans</a>
                    </li>
                    <li class='{{ Request::is('kmeans') ? 'active' : '' }}'>
                        <a class="nav-link" href="">Kmeans</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'umkm' ? 'active' : '' }}">
                <a href="{{ route('umkm.index') }}" class="nav-link ha"><i
                        class="fas fa-wallet"></i><span>UMKM</span></a>

            </li>
            {{-- @if (Auth::user()->role == 'Admin') --}}
                <li class="nav-item dropdown {{ $type_menu === 'user' ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class="nav-link ha"><i
                            class="fas fa-users"></i><span>Users</span></a>

                </li>
            {{-- @else
            @endif --}}
        </ul>
    </aside>
</div>

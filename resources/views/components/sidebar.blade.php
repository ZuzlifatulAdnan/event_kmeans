<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('beranda.index') }}">
                <img src="{{ asset('img/logo/logo_nama.png') }}" alt="Logo" style="width: 180px;">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('beranda.index') }}">
                <img src="{{ asset('img/logo/logo.png') }}" alt="Logo" style="width: 40px;">
            </a>
        </div>

        <ul class="sidebar-menu mt-4">
            <li class="menu-header">Beranda</li>
            <li class="{{ $type_menu === 'beranda' ? 'active' : '' }}">
                <a href="{{ route('beranda.index') }}" class="nav-link">
                    <i class="fas fa-home"></i><span>Beranda</span>
                </a>
            </li>

            <li class="menu-header">Menu</li>

            <li class="{{ $type_menu === 'kmeans' ? 'active' : '' }}">
                <a href="{{ route('kmeans.index') }}" class="nav-link">
                    <i class="fas fa-project-diagram"></i><span>K-Means</span>
                </a>
            </li>

            <li class="{{ $type_menu === 'umkm' ? 'active' : '' }}">
                <a href="{{ route('umkm.index') }}" class="nav-link">
                    <i class="fas fa-store-alt"></i><span>UMKM</span>
                </a>
            </li>

            <li class="{{ $type_menu === 'user' ? 'active' : '' }}">
                <a href="{{ route('user.index') }}" class="nav-link">
                    <i class="fas fa-user-cog"></i><span>Users</span>
                </a>
            </li>
        </ul>
    </aside>
</div>

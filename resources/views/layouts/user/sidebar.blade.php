<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('index_user') }}" class="brand-link">
        <img src="{{ asset('dist/img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Niu Picnic</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                @auth
                    @php
                        $userName = Auth::user()->nama_lengkap;
                        $userNameCamelCase = ucwords(strtolower($userName));
                    @endphp
                    <a href="#" class="d-block"> {{ $userNameCamelCase }}</a>
                @else
                    <a href="#" class="d-block">Guest</a>
                @endauth
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Menu</li>
                    <li class="nav-item">
                        <a href="{{ route('penyewaan_member.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Form Peminjaman</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.penyewaan.riwayat') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Riwayat Transaksi</p>
                        </a>
                    </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>                
            </ul>
        </nav>
    </div>
</aside>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('index_admin') }}" class="brand-link">
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
                    <a href="{{ route('barang.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Stok Barang</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Transaksi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('penyewaan.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Master Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penyewaan.confirm') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Konfirmasi Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penyewaan.riwayat') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Transaksi</p>
                            </a>
                        </li>
                    </ul>
                    <li class="nav-item">
                        <a href="{{ route('laporan.keuangan') }}" class="nav-link">
                            <i class="fas fa-money-bill-wave nav-icon"></i>
                            <p>Keuangan</p>
                        </a>
                    </li>
                </li>
                
                <li class="nav-header">Data</li>
                <li class="nav-item">
                    <a href="{{ route('member.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Master Member</p>
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
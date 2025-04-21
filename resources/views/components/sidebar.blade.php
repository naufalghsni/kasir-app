@auth
<div class="main-sidebar sidebar-style-1">
    <aside id="sidebar-wrapper" class="d-flex flex-column" style="min-height: 100vh;">
        <!-- Brand -->
        <div class="sidebar-brand">
            <a href="">APP Kasir</a>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu mt-3 flex-grow-1">
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('home') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>

            {{-- superadmin --}}
            @if (Auth::user()->role == 'superadmin')
                <li class="{{ Request::is('product') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-box-open"></i> <span>Produk</span></a>
                </li>
                <li class="{{ Request::is('sales') ? 'active' : '' }}">
                    <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> <span>Penjualan</span></a>
                </li>
                <li class="{{ Request::is('user') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.index')}}"><i class="fas fa-user"></i> <span>User</span></a>
                </li>
                <li class="{{ Request::is('members') ? 'active' : '' }}">
                    <a class="nav-link" href="#"><i class="fas fa-user-plus"></i> <span>Member</span></a>
                </li>
            @endif

            {{-- user --}}
            @if (Auth::user()->role == 'user')
                <li class="{{ Request::is('product') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-shopping-bag"></i> <span>Produk</span></a>
                </li>
                <li class="{{ Request::is('sales') ? 'active' : '' }}">
                    <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> <span>Penjualan</span></a>
                </li>
                <li class="{{ Request::is('members') ? 'active' : '' }}">
                    <a class="nav-link" href="#"><i class="fas fa-user-plus"></i> <span>Member</span></a>
                </li>
            @endif
        </ul>

        <!-- Sidebar Footer -->
        <div class="p-3 text-center" style="font-size: 13px; color: #ccc;">
            &copy; {{ date('Y') }} APP Kasir | Ghsni11_<br>
        </div>
    </aside>
</div>
@endauth

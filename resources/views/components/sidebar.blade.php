@auth
<div class="main-sidebar sidebar-style-1" style="background-color: #1e3a8a;">
    <aside id="sidebar-wrapper" class="d-flex flex-column" style="min-height: 100vh; background-color: #1e40af; color: #f8fafc;">

        <!-- Brand -->
        <div class="sidebar-brand text-center py-3" style="font-weight: bold; font-size: 18px; color: #ffffff;">
            <a href="home" style="color: #ffffff; text-decoration: none;">APP Kasir</a>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu mt-3 flex-grow-1 px-2" style="list-style: none; padding-left: 0;">
            <li class="{{ Request::is('home') ? 'active' : '' }}" style="margin-bottom: 10px;">
                <a class="nav-link d-flex align-items-center" href="{{ url('home') }}" style="color: #f8fafc; padding: 10px; border-radius: 8px; {{ Request::is('home') ? 'background-color: #1d4ed8;' : 'background-color: transparent;' }}">
                    <i class="fas fa-home mr-2"></i><span>Dashboard</span>
                </a>
            </li>

            {{-- superadmin --}}
            @if (Auth::user()->role == 'superadmin')
                <li class="{{ Request::is('product') ? 'active' : '' }}" style="margin-bottom: 10px;">
                    <a class="nav-link d-flex align-items-center" href="{{ route('products.index') }}" style="color: #f8fafc; padding: 10px; border-radius: 8px; {{ Request::is('product') ? 'background-color: #1d4ed8;' : 'background-color: transparent;' }}">
                        <i class="fas fa-box-open mr-2"></i><span>Produk</span>
                    </a>
                </li>
                <li class="{{ Request::is('sales') ? 'active' : '' }}" style="margin-bottom: 10px;">
                    <a class="nav-link d-flex align-items-center" href="{{ route('sales.index') }}" style="color: #f8fafc; padding: 10px; border-radius: 8px; {{ Request::is('sales') ? 'background-color: #1d4ed8;' : 'background-color: transparent;' }}">
                        <i class="fas fa-shopping-cart mr-2"></i><span>Penjualan</span>
                    </a>
                </li>
                <li class="{{ Request::is('user') ? 'active' : '' }}" style="margin-bottom: 10px;">
                    <a class="nav-link d-flex align-items-center" href="{{ route('user.index') }}" style="color: #f8fafc; padding: 10px; border-radius: 8px; {{ Request::is('user') ? 'background-color: #1d4ed8;' : 'background-color: transparent;' }}">
                        <i class="fas fa-user mr-2"></i><span>User</span>
                    </a>
                </li>
                <li class="{{ Request::is('members') ? 'active' : '' }}" style="margin-bottom: 10px;">
                    <a class="nav-link d-flex align-items-center" href="{{ route('members.index') }}" style="color: #f8fafc; padding: 10px; border-radius: 8px; {{ Request::is('members') ? 'background-color: #1d4ed8;' : 'background-color: transparent;' }}">
                        <i class="fas fa-user-plus mr-2"></i><span>Member</span>
                    </a>
                </li>
            @endif

            {{-- user --}}
            @if (Auth::user()->role == 'user')
                <li class="{{ Request::is('product') ? 'active' : '' }}" style="margin-bottom: 10px;">
                    <a class="nav-link d-flex align-items-center" href="{{ route('products.index') }}" style="color: #f8fafc; padding: 10px; border-radius: 8px; {{ Request::is('product') ? 'background-color: #1d4ed8;' : 'background-color: transparent;' }}">
                        <i class="fas fa-shopping-bag mr-2"></i><span>Produk</span>
                    </a>
                </li>
                <li class="{{ Request::is('sales') ? 'active' : '' }}" style="margin-bottom: 10px;">
                    <a class="nav-link d-flex align-items-center" href="{{ route('sales.index') }}" style="color: #f8fafc; padding: 10px; border-radius: 8px; {{ Request::is('sales') ? 'background-color: #1d4ed8;' : 'background-color: transparent;' }}">
                        <i class="fas fa-shopping-cart mr-2"></i><span>Penjualan</span>
                    </a>
                </li>
                <li class="{{ Request::is('members') ? 'active' : '' }}" style="margin-bottom: 10px;">
                    <a class="nav-link d-flex align-items-center" href="{{ route('members.index') }}" style="color: #f8fafc; padding: 10px; border-radius: 8px; {{ Request::is('members') ? 'background-color: #1d4ed8;' : 'background-color: transparent;' }}">
                        <i class="fas fa-user-plus mr-2"></i><span>Member</span>
                    </a>
                </li>
            @endif
        </ul>

        <!-- Sidebar Footer -->
        <div class="p-3 text-center" style="font-size: 13px; color: #d1d5db;">
            &copy; {{ date('Y') }} APP Kasir | Ghsni11_<br>
        </div>
    </aside>
</div>
@endauth

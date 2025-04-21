@auth
<div class="navbar-bg" style="height: 70px; background-color: #ffffff;"></div>
<nav class="navbar navbar-expand-lg main-navbar" style="min-height: 70px; background-color: #ffffff; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);">
    <!-- Sidebar Toggle -->
    <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg d-flex align-items-center" style="height: 70px; padding: 0 15px; color: #111827;">
        <i class="fas fa-bars"></i>
    </a>

    <!-- User Menu -->
    <ul class="navbar-nav ml-auto" style="height: 70px;">
        <li class="dropdown h-100 d-flex align-items-center">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user d-flex align-items-center"
               style="height: 100%; padding: 0 10px; color: #111827;">
                <img alt="image" src="{{ asset('img/avatar/avatar-2.jpg') }}"
                     class="rounded-circle mr-2"
                     style="width: 30px; height: 30px; object-fit: cover;">
                <span class="d-none d-lg-inline-block" style="font-size: 15px; line-height: 1; margin-top: -1px;">
                    {{ substr(auth()->user()->name, 0, 15) }}
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" style="font-size: 13px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border: none;">
                @if (Auth::user()->role == 'superadmin')
                <a class="dropdown-item has-icon" href="{{ route('profile.edit') }}"
                   style="padding: 5px 15px;">
                    <i class="far fa-user mr-2"></i> Edit Profile
                </a>
                <div class="dropdown-divider"></div>
                @endif

                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                   style="padding: 5px 15px;"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
@endauth

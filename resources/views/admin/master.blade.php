<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>Admin Dashboard</title>
</head>

<body>
    <!-- Sidebar -->
    @if (Auth::check())
        @if (Auth::user()->phanquyen == 'admin')
            <div class="sidebar">
                <div class="sidebar-header">Quản trị trang web</div>
                <nav class="sidebar-menu">
                    <ul>
                        <li class="{{ request()->routeIs('sanpham') ? 'active' : '' }}">
                            <a href="{{ route('sanpham') }}">Quản lý sản phẩm</a>
                        </li>
                        <li class="{{ request()->routeIs('qladmin') ? 'active' : '' }}">
                            <a href="{{ route('qladmin') }}">Quản lý tài khoản</a>
                        </li>
                        <li class="{{ request()->routeIs('qlchitiet') ? 'active' : '' }}">
                            <a href="{{ route('qlchitiet') }}">Chi tiết sản phẩm</a>
                        </li>
                        <li class="{{ request()->routeIs('qldonhang') ? 'active' : '' }}">
                            <a href="{{ route('qldonhang') }}">Quản lý đơn hàng</a>
                        </li>
                        <li class="{{ request()->routeIs('qlbanner') ? 'active' : '' }}">
                            <a href="{{ route('qlbanner') }}">Quản lý banner</a>
                        </li>
                        <li>
                            <a href="https://dashboard.tawk.to/#/chat" target="_blank">Tư vấn khách hàng</a>
                        </li>
                    </ul>
                </nav>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="nav-link">Xin chào, {{ Auth::user()->username }}</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Đăng xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
        @elseif (Auth::user()->phanquyen == 'sale')
            <div class="sidebar">
                <div class="sidebar-header">Nhân viên tư vấn</div>
                <nav class="sidebar-menu">
                    <ul>
                        <li>
                            <a href="https://dashboard.tawk.to/#/chat" target="_blank">Tư vấn khách hàng</a>
                        </li>
                    </ul>
                </nav>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="nav-link">Xin chào, {{ Auth::user()->username }}</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Đăng xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    @endif

    <!-- Main Content -->
    <div class="main-content">
        @yield('body')
    </div>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manajemen Karyawan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/lucide-static@latest/lucide.min.js"></script>

</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <i data-lucide="briefcase"></i>
            <span>Manajemen HR</span>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                <i data-lucide="users"></i>
                <span>Karyawan</span>
            </a>
            <a class="nav-link" href="#">
                <i data-lucide="settings"></i>
                <span>Pengaturan</span>
            </a>
        </nav>
    </aside>
    <main class="main-content">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>

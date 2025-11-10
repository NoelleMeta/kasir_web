<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://static.cloudflareinsights.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:;">
    <title>@yield('title', 'Aplikasi')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg:#ffffff; --panel:#f8fafc; --muted:#64748b; --text:#1e293b; --primary:#38bdf8; }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            /* Prevent layout shift and stretching */
            overflow-x: hidden;
            min-height: 100vh;
        }
        /* Prevent FOUC (Flash of Unstyled Content) */
        .layout {
            visibility: hidden;
            display: grid;
            grid-template-columns: 240px 1fr;
            min-height: 100vh;
            transition: grid-template-columns 0.3s ease;
        }
        .layout.loaded { visibility: visible; }
        .layout.sidebar-collapsed { grid-template-columns: 0 1fr; }
        .sidebar { background: var(--panel); border-right: 1px solid rgba(148,163,184,.15); padding: 20px 14px; position: sticky; top: 0; height: 100vh; transition: all 0.3s ease; overflow: hidden; }
        .sidebar.collapsed {
            transform: translateX(-100%);
            width: 0;
            padding: 0;
            border: none;
            visibility: hidden;
            opacity: 0;
        }
        .sidebar-toggle {
            display: block;
            position: fixed;
            top: 20px;
            left: 260px;
            z-index: 1000;
            background: var(--primary);
            color: #001018;
            border: none;
            border-radius: 8px;
            padding: 10px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: left 0.3s ease;
        }
        .sidebar-toggle.sidebar-closed {
            left: 20px;
        }
        .brand { display:flex; align-items:center; gap:10px; font-weight:700; letter-spacing:.2px; margin-bottom: 18px; }
        .brand .dot { width:10px; height:10px; border-radius:50%; background: var(--primary); box-shadow: 0 0 14px var(--primary); }
        .menu { list-style: none; padding: 0; margin: 12px 0 0; }
        .menu li { margin: 6px 0; }
        .link { display:flex; align-items:center; gap:12px; padding: 10px 12px; border-radius: 10px; color: var(--muted); text-decoration: none; transition: background .15s, color .15s; }
        .link:hover { background: rgba(148,163,184,.08); color: var(--text); }
        .link.active { color: var(--text); background: rgba(56,189,248,.12); outline: 1px solid rgba(56,189,248,.35); }
        .icon { width: 18px; height: 18px; display:inline-block; }
        .content {
            padding: 22px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
            /* Remove transition to prevent stretching effect */
        }
        .content.centered {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }
        .content.centered-when-open {
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 1200px) {
            .content {
                max-width: 100%;
                margin: 0;
                padding: 22px;
            }
            .content.centered {
                max-width: 100%;
                margin: 0;
                padding: 22px;
            }
            .content.centered-when-open {
                max-width: 100%;
                margin: 0;
                padding: 22px;
            }
        }
        .topbar { display:flex; align-items:center; justify-content: space-between; margin-bottom: 16px; }
        .title { font-size: 18px; font-weight: 700; letter-spacing:.2px; }
        .btn { display: inline-block; padding: 8px 12px; border-radius: 8px; background: rgba(148,163,184,.16); color: var(--text); text-decoration: none; border: 0; cursor: pointer; font-weight:600; }
        .btn.primary { background: var(--primary); color: #001018; }
        .muted { color: var(--muted); }
        .form-control { width: 100%; padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; }
        .password-container { position: relative; }
        .password-input { padding-right: 40px; }
        .password-toggle { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; font-size: 16px; }
        .password-toggle:hover { color: #334155; }
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999; }
        .sidebar-overlay.show { display: block; }
        @media (max-width: 960px) {
            .layout { grid-template-columns: 1fr; }
            .sidebar { position: fixed; top: 0; left: 0; z-index: 1000; width: 240px; transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .sidebar-toggle {
                display: block;
                left: 20px !important; /* Force left position on mobile */
                top: 20px;
                transition: left 0.3s ease;
            }
            .sidebar-toggle.sidebar-closed {
                left: 20px !important; /* Keep at left when sidebar is closed */
            }
            .sidebar-toggle.sidebar-open {
                left: 260px !important; /* Move to right when sidebar is open */
            }
            .content {
                margin-left: 0;
                padding: 15px;
                max-width: 100%;
            }

            /* Mobile-specific improvements */
            .topbar {
                flex-direction: column;
                align-items: center;
                gap: 10px;
                margin-bottom: 20px;
                text-align: center;
            }
            .title {
                font-size: 1.2rem;
                text-align: center;
                width: 100%;
            }
            .btn {
                font-size: 0.9rem;
                padding: 8px 12px;
            }
        }

        @media (max-width: 576px) {
            /* Small mobile devices */
            .content { padding: 10px; }
            .topbar {
                margin-bottom: 15px;
                align-items: center;
                text-align: center;
            }
            .title {
                font-size: 1.1rem;
                text-align: center;
                width: 100%;
            }
            .btn {
                font-size: 0.85rem;
                padding: 6px 10px;
            }

            /* Mobile form improvements */
            .form-control {
                font-size: 0.9rem;
                padding: 8px 10px;
            }
            .form-label {
                font-size: 0.9rem;
                margin-bottom: 4px;
            }
        }
    </style>
    @stack('head')
    @yield('head')
</head>
<body>
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
        <span id="toggleIcon">☰</span>
    </button>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="layout">
        <aside class="sidebar" id="sidebar">
            <div class="brand"><span class="dot"></span> <span>POS Admin</span></div>
            <ul class="menu">
                <li>
                    <a class="link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <span class="icon">🏠</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="link {{ request()->routeIs('laporan.ringkas') ? 'active' : '' }}" href="{{ route('laporan.ringkas') }}">
                        <span class="icon">📄</span>
                        <span>Laporan Ringkas</span>
                    </a>
                </li>
                <li>
                    <a class="link {{ request()->routeIs('laporan.detail') ? 'active' : '' }}" href="{{ route('laporan.detail') }}">
                        <span class="icon">📑</span>
                        <span>Laporan Detail</span>
                    </a>
                </li>
                <li>
                    <a class="link {{ request()->routeIs('landing-page.*') ? 'active' : '' }}" href="{{ route('landing-page.index') }}">
                        <span class="icon">🌐</span>
                        <span>Landing Page</span>
                    </a>
                </li>
                <li>
                    <a class="link {{ request()->routeIs('account.index') ? 'active' : '' }}" href="{{ route('account.index') }}">
                        <span class="icon">👤</span>
                        <span>Akun</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="link" style="width: 100%; border: 0; background: none; cursor: pointer; text-align: left;">
                            <span class="icon">🚪</span>
                            <span>Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </aside>
        <main class="content">
            <div class="topbar">
                <div class="title">@yield('page_title', 'Halaman')</div>
                @yield('actions')
            </div>
            @yield('content')
        </main>
    </div>
    @stack('scripts')
    @yield('scripts')

    <script>
        // Prevent layout shift on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Add loaded class to prevent FOUC
            const layout = document.querySelector('.layout');
            if (layout) {
                layout.classList.add('loaded');
            }
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const toggleIcon = document.getElementById('toggleIcon');
            const content = document.querySelector('.content');

            // Get sidebar state from localStorage
            let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

            // Toggle sidebar function
            function toggleSidebar() {
                if (window.innerWidth <= 960) {
                    // Mobile behavior
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');

                    // Update toggle button position based on sidebar state
                    if (sidebar.classList.contains('show')) {
                        sidebarToggle.classList.add('sidebar-open');
                        sidebarToggle.classList.remove('sidebar-closed');
                    } else {
                        sidebarToggle.classList.add('sidebar-closed');
                        sidebarToggle.classList.remove('sidebar-open');
                    }
                } else {
                    // Desktop behavior
                    isCollapsed = !isCollapsed;

                    // Save state to localStorage
                    localStorage.setItem('sidebarCollapsed', isCollapsed.toString());

                    if (isCollapsed) {
                        layout.classList.add('sidebar-collapsed');
                        sidebar.classList.add('collapsed');
                        content.classList.add('centered');
                        content.classList.remove('centered-when-open');
                        sidebarToggle.classList.add('sidebar-closed');
                        sidebarToggle.classList.remove('sidebar-open');
                    } else {
                        layout.classList.remove('sidebar-collapsed');
                        sidebar.classList.remove('collapsed');
                        content.classList.remove('centered');
                        content.classList.add('centered-when-open');
                        sidebarToggle.classList.add('sidebar-open');
                        sidebarToggle.classList.remove('sidebar-closed');
                    }
                }

                // Update icon
                if (sidebar.classList.contains('show') || isCollapsed) {
                    toggleIcon.textContent = '✕';
                } else {
                    toggleIcon.textContent = '☰';
                }
            }

            // Close sidebar function
            function closeSidebar() {
                if (window.innerWidth <= 960) {
                    // Mobile behavior
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');

                    // Update toggle button position when closing
                    sidebarToggle.classList.add('sidebar-closed');
                    sidebarToggle.classList.remove('sidebar-open');
                } else {
                    // Desktop behavior
                    isCollapsed = false;
                    layout.classList.remove('sidebar-collapsed');
                    sidebar.classList.remove('collapsed');
                    content.classList.add('centered');
                    content.classList.remove('centered-when-open');
                    sidebarToggle.classList.remove('sidebar-open');
                    sidebarToggle.classList.remove('sidebar-closed');
                }
                toggleIcon.textContent = '☰';
            }

            // Event listeners
            sidebarToggle.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', closeSidebar);

            // Close sidebar when clicking on menu links (mobile only)
            const menuLinks = document.querySelectorAll('.menu .link');
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 960) {
                        closeSidebar();
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 960) {
                    // Desktop: remove mobile classes
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                    if (!isCollapsed) {
                        toggleIcon.textContent = '☰';
                        sidebarToggle.classList.add('sidebar-open');
                        sidebarToggle.classList.remove('sidebar-closed');
                    }
                } else {
                    // Mobile: reset desktop state
                    layout.classList.remove('sidebar-collapsed');
                    sidebar.classList.remove('collapsed');
                    content.classList.add('centered');
                    content.classList.remove('centered-when-open');
                    sidebarToggle.classList.remove('sidebar-open');
                    sidebarToggle.classList.remove('sidebar-closed');
                    isCollapsed = false;
                }
            });

            // Initialize based on screen size and saved state
            if (window.innerWidth <= 960) {
                // Mobile: sidebar hidden by default
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
                toggleIcon.textContent = '☰';
                content.classList.add('centered');

                // Set initial toggle button position for mobile
                sidebarToggle.classList.add('sidebar-closed');
                sidebarToggle.classList.remove('sidebar-open');
            } else {
                // Desktop: restore saved sidebar state
                if (isCollapsed) {
                    // Sidebar was collapsed, restore collapsed state
                    layout.classList.add('sidebar-collapsed');
                    sidebar.classList.add('collapsed');
                    content.classList.add('centered');
                    content.classList.remove('centered-when-open');
                    sidebarToggle.classList.add('sidebar-closed');
                    sidebarToggle.classList.remove('sidebar-open');
                    toggleIcon.textContent = '✕';
                } else {
                    // Sidebar was open, restore open state
                    layout.classList.remove('sidebar-collapsed');
                    sidebar.classList.remove('collapsed');
                    content.classList.remove('centered');
                    content.classList.add('centered-when-open');
                    sidebarToggle.classList.add('sidebar-open');
                    sidebarToggle.classList.remove('sidebar-closed');
                    toggleIcon.textContent = '☰';
                }
            }
        });

        // Password toggle function
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '-icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                `;
            }
        }
    </script>
</body>
</html>



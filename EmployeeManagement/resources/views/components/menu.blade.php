<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<style>
    :root {
        --navy: #111F4D;
        --light: #F2F4F7;
        --accent: #E43A19;
        --dark: #020205;
        --navy-light: #2A3A6D;
        --gold: #FFD700;
        --success: #10B981;
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
        --card-radius: 16px;
        --sidebar-width: 280px;
        --sidebar-collapsed: 80px;
        --header-height: 70px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--light);
        color: var(--dark);
        overflow-x: hidden;
    }

    .dashboard-container {
        display: flex;
        min-height: 100vh;
        position: relative;
    }

    /* Admin Panel Styles */
    .admin-panel {
        width: var(--sidebar-width);
        background: linear-gradient(135deg, var(--navy), var(--navy-light));
        color: white;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
        position: fixed;
        height: 100vh;
        z-index: 1000;
    }

    .admin-panel.collapsed {
        width: var(--sidebar-collapsed);
    }

    .panel-header {
        padding: 16px;
        display: flex;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        height: var(--header-height);
    }

    .logo {
        font-size: 20px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        color: white;
        margin-left: 12px;
        transition: var(--transition);
    }

    .admin-panel.collapsed .logo {
        opacity: 0;
        width: 0;
        margin-left: 0;
    }

    .menu-toggle {
        background: transparent;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 20%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .menu-toggle:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .menu-toggle span {
        display: block;
        width: 20px;
        height: 2px;
        background: white;
        margin: 3px 0;
        border-radius: 2px;
        transition: var(--transition);
    }

    .admin-panel:not(.collapsed) .menu-toggle span:nth-child(1) {
        transform: translateY(5px) rotate(45deg);
    }

    .admin-panel:not(.collapsed) .menu-toggle span:nth-child(2) {
        opacity: 0;
    }

    .admin-panel:not(.collapsed) .menu-toggle span:nth-child(3) {
        transform: translateY(-5px) rotate(-45deg);
    }

    .panel-nav {
        padding: 20px 0;
        flex-grow: 1;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
    }

    .panel-nav::-webkit-scrollbar {
        width: 4px;
    }

    .panel-nav::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.3);
        border-radius: 2px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        padding: 14px 24px;
        margin: 4px 12px;
        border-radius: 8px;
        color: white;
        opacity: 0.9;
        text-decoration: none;
        white-space: nowrap;
        transition: var(--transition);
        position: relative;
    }

    .nav-item:hover {
        background: rgba(255, 255, 255, 0.1);
        opacity: 1;
        transform: translateX(4px);
    }

    .nav-item.active {
        background: var(--accent);
        box-shadow: 0 4px 12px rgba(228, 58, 25, 0.3);
        opacity: 1;
    }

    .nav-item.active::after {
        content: '';
        position: absolute;
        right: -12px;
        top: 50%;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        background: white;
        border-radius: 50%;
    }

    .nav-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 24px;
    }

    .nav-icon .material-icons-round {
        font-size: 24px;
    }

    .nav-text {
        font-size: 15px;
        font-weight: 500;
        margin-left: 16px;
        transition: opacity 0.2s ease;
    }

    .admin-panel.collapsed .nav-text {
        opacity: 0;
        position: absolute;
        left: 100%;
        background: var(--navy);
        padding: 10px 15px;
        border-radius: 6px;
        margin-left: 20px;
        pointer-events: none;
        white-space: nowrap;
        box-shadow: var(--shadow);
        transform: translateX(10px);
        visibility: hidden;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .admin-panel.collapsed .nav-item:hover .nav-text {
        visibility: visible;
        opacity: 1;
        transform: translateX(0);
    }

    .logout-area {
        padding: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 12px;
        background: rgba(228, 58, 25, 0.2);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 15px;
        font-weight: 500;
        transition: var(--transition);
    }

    .logout-btn:hover {
        background: var(--accent);
    }

    .logout-btn .material-icons-round {
        margin-right: 12px;
    }

    .admin-panel.collapsed .logout-btn span:last-child {
        display: none;
    }

    .admin-panel.collapsed .logout-btn {
        justify-content: center;
    }

    .admin-panel.collapsed .logout-btn .material-icons-round {
        margin-right: 0;
    }

    /* Main Content Area */
    .main-content {
        flex: 1;
        margin-left: var(--sidebar-width);
        transition: var(--transition);
        min-height: 100vh;
        padding-top: var(--header-height);
    }

    .admin-panel.collapsed~.main-content {
        margin-left: var(--sidebar-collapsed);
    }

    /* Single Toggle Button - Always visible */
    .sidebar-toggle {
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1100;
        background: var(--navy);
        color: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: var(--transition);
    }

    .sidebar-toggle .material-icons-round {
        font-size: 28px;
        transition: var(--transition);
    }

    .admin-panel.mobile-visible~.sidebar-toggle,
    .admin-panel:not(.collapsed)~.sidebar-toggle {
        left: calc(var(--sidebar-width) - 20px);
    }

    .admin-panel.collapsed:not(.mobile-visible)~.sidebar-toggle {
        left: calc(var(--sidebar-collapsed) - 20px);
    }

    /* Loader Styles */
    .loader_container {
        height: 100vh;
        width: 100vw;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
    }

    .loader_container img {
        width: 80px;
        height: 80px;
    }

    .hidden {
        display: none;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .admin-panel {
            transform: translateX(-100%);
        }

        .admin-panel.collapsed {
            transform: translateX(-100%);
            width: var(--sidebar-collapsed);
        }

        .admin-panel.mobile-visible {
            transform: translateX(0);
            width: var(--sidebar-width);
        }

        .admin-panel.mobile-visible.collapsed {
            width: var(--sidebar-collapsed);
        }

        .main-content {
            margin-left: 0 !important;
        }

        .admin-panel.mobile-visible~.sidebar-toggle .material-icons-round {
            transform: rotate(180deg);
        }

        .admin-panel:not(.mobile-visible)~.sidebar-toggle .material-icons-round {
            transform: rotate(0);
        }
    }

    @media (max-width: 576px) {
        .admin-panel {
            width: 100%;
            max-width: 300px;
        }

        .admin-panel.collapsed {
            width: var(--sidebar-collapsed);
        }
    }

    /* Tooltip for collapsed menu */
    .nav-item-tooltip {
        position: absolute;
        left: calc(100% + 15px);
        background: var(--navy);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        white-space: nowrap;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.2s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1001;
    }

    .admin-panel.collapsed .nav-item:hover .nav-item-tooltip {
        opacity: 1;
    }
</style>

<div class="dashboard-container">
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <span class="material-icons-round">chevron_right</span>
    </button>

    <!-- Sidebar -->
    <div class="admin-panel" id="panel">
        <div class="panel-header">
            <!-- <div class="logo">Admin Panel</div> -->
        </div>

        <nav class="panel-nav">
            <a href="{{ url('/adminPanel') }}" class="nav-item {{ Request::is('adminPanel') ? 'active' : '' }}">
                <div class="nav-icon"><span class="material-icons-round">home</span></div>
                <span class="nav-text">Dashboard</span>
                <span class="nav-item-tooltip">Dashboard</span>
            </a>
            <a href="{{ url('/adminPanel/records') }}" class="nav-item {{ Request::is('adminPanel/records') ? 'active' : '' }}">
                <div class="nav-icon"><span class="material-icons-round">list_alt</span></div>
                <span class="nav-text">Records</span>
                <span class="nav-item-tooltip">Records</span>
            </a>
            <a href="{{ url('/adminPanel/generate_user') }}" class="nav-item {{ Request::is('adminPanel/generate_user') ? 'active' : '' }}">
                <div class="nav-icon"><span class="material-icons-round">person_add</span></div>
                <span class="nav-text">Generate User</span>
                <span class="nav-item-tooltip">Generate User</span>
            </a>
            <a href="{{ url('/adminPanel/downloadData') }}" class="nav-item {{ Request::is('adminPanel/downloadData') ? 'active' : '' }}">
                <div class="nav-icon"><span class="material-icons-round">cloud_download</span></div>
                <span class="nav-text">Download Data</span>
                <span class="nav-item-tooltip">Download Data</span>
            </a>
            <a href="{{ url('/adminPanel/search_user') }}" class="nav-item {{ Request::is('adminPanel/search_user') ? 'active' : '' }}">
                <div class="nav-icon"><span class="material-icons-round">search</span></div>
                <span class="nav-text">Search User</span>
                <span class="nav-item-tooltip">Search User</span>
            </a>
            <a href="{{ url('/adminPanel/holiday') }}" class="nav-item {{ Request::is('adminPanel/holiday') ? 'active' : '' }}">
                <div class="nav-icon"><span class="material-icons-round">beach_access</span></div>
                <span class="nav-text">Holiday Settings</span>
                <span class="nav-item-tooltip">Holiday Settings</span>
            </a>
            <a href="{{ url('/adminPanel/trash_user') }}" class="nav-item {{ Request::is('adminPanel/trash_user') ? 'active' : '' }}">
                <div class="nav-icon"><span class="material-icons-round">delete</span></div>
                <span class="nav-text">Trashed Users</span>
                <span class="nav-item-tooltip">Trashed Users</span>
            </a>
        </nav>

        <div class="logout-area">
            <button class="logout-btn" onclick="document.getElementById('logoutForm').submit()">
                <span class="material-icons-round">logout</span>
                <span>Logout</span>
            </button>
            <form id="logoutForm" action="/logout" method="post" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Your main content goes here -->
    </div>
</div>

<!-- Loader -->
<div id="loader" class="loader_container">
    <img src="{{ URL('Images/loader.gif') }}" alt="Loading...">
</div>

<script>
    // Toggle sidebar menu
    function toggleSidebar() {
        const panel = document.getElementById('panel');
        const toggleBtn = document.getElementById('sidebarToggle');

        if (window.innerWidth <= 992) {
            // Mobile behavior - toggle visibility
            panel.classList.toggle('mobile-visible');
            // Rotate the icon
            const icon = toggleBtn.querySelector('.material-icons-round');
            if (panel.classList.contains('mobile-visible')) {
                icon.style.transform = 'rotate(180deg)';
            } else {
                icon.style.transform = 'rotate(0)';
            }
        } else {
            // Desktop behavior - toggle collapsed state
            panel.classList.toggle('collapsed');
            localStorage.setItem('adminPanelCollapsed', panel.classList.contains('collapsed'));
        }
    }

    // Initialize sidebar state
    document.addEventListener('DOMContentLoaded', function() {
        const panel = document.getElementById('panel');
        const toggleBtn = document.getElementById('sidebarToggle');

        // Set initial state based on localStorage
        if (localStorage.getItem('adminPanelCollapsed') === 'true' && window.innerWidth > 992) {
            panel.classList.add('collapsed');
        }

        // Set up event listener for toggle button
        toggleBtn.addEventListener('click', toggleSidebar);

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 992) {
                const panel = document.getElementById('panel');
                const toggleBtn = document.getElementById('sidebarToggle');

                if (!panel.contains(event.target) &&
                    !toggleBtn.contains(event.target) &&
                    panel.classList.contains('mobile-visible')) {
                    panel.classList.remove('mobile-visible');
                    toggleBtn.querySelector('.material-icons-round').style.transform = 'rotate(0)';
                }
            }
        });

        // Hide loader when page is loaded
        window.addEventListener('load', function() {
            const loader = document.querySelector('#loader');
            loader.classList.add('hidden');
        });
    });

    // Make sidebar responsive on window resize
    window.addEventListener('resize', function() {
        const panel = document.getElementById('panel');
        const toggleBtn = document.getElementById('sidebarToggle');
        const icon = toggleBtn.querySelector('.material-icons-round');

        if (window.innerWidth > 992) {
            // Desktop - ensure mobile-visible is removed
            panel.classList.remove('mobile-visible');
            icon.style.transform = 'rotate(0)';
        } else {
            // Mobile - ensure collapsed state is removed
            panel.classList.remove('collapsed');
        }
    });
</script>
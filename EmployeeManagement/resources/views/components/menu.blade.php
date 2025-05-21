<x-loader />
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trashed Users | Admin Panel</title>
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
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .admin-panel {
            width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--navy), var(--navy-light));
            color: white;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
        }

        .admin-panel.collapsed {
            width: var(--sidebar-collapsed);
        }

        .panel-header {
            padding: 24px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo {
            font-size: 20px;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
        }

        .menu-toggle {
            margin-left: auto;
            /* background: rgba(255, 255, 255, 0.1); */
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

        .menu-toggle :hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .menu-toggle span {
            display: block;
            width: 20px;
            height: 2px;
            background: white;
            margin: 3px 0;
            border-radius: 2px;
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

        .nav-icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-icon .material-icons-round {
            font-size: 24px;
        }

        .nav-text {
            font-size: 15px;
            font-weight: 500;
            margin-left: 16px;
        }

        .admin-panel.collapsed .nav-text {
            display: none;
        }

        .logout-area {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 12px;
            background: rgba(228, 58, 25, 0.2);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
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
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="admin-panel" id="panel">
            <div class="panel-header">
                <button class="menu-toggle" onclick="toggleMenu()">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <nav class="panel-nav">
                <a href="{{ url('/adminPanel') }}" class="nav-item {{ Request::is('adminPanel') ? 'active' : '' }}">
                    <div class="nav-icon"><span class="material-icons-round">home</span></div>
                    <span class="nav-text">Dashboard</span>
                </a>
                <a href="{{ url('/adminPanel/records') }}" class="nav-item {{ Request::is('adminPanel/records') ? 'active' : '' }}">
                    <div class="nav-icon"><span class="material-icons-round">list_alt</span></div>
                    <span class="nav-text">Records</span>
                </a>
                <a href="{{ url('/adminPanel/generate_user') }}" class="nav-item {{ Request::is('adminPanel/generate_user') ? 'active' : '' }}">
                    <div class="nav-icon"><span class="material-icons-round">person_add</span></div>
                    <span class="nav-text">Generate User</span>
                </a>
                <a href="{{ url('/adminPanel/downloadData') }}" class="nav-item {{ Request::is('adminPanel/downloadData') ? 'active' : '' }}">
                    <div class="nav-icon"><span class="material-icons-round">cloud_download</span></div>
                    <span class="nav-text">Download Data</span>
                </a>
                <a href="{{ url('/adminPanel/search_user') }}" class="nav-item {{ Request::is('adminPanel/search_user') ? 'active' : '' }}">
                    <div class="nav-icon"><span class="material-icons-round">search</span></div>
                    <span class="nav-text">Search User</span>
                </a>
                <a href="{{ url('/adminPanel/holiday') }}" class="nav-item {{ Request::is('adminPanel/holiday') ? 'active' : '' }}">
                    <div class="nav-icon"><span class="material-icons-round">beach_access</span></div>
                    <span class="nav-text">Holiday Settings</span>
                </a>
                <a href="{{ url('/adminPanel/trash_user') }}" class="nav-item {{ Request::is('adminPanel/trash_user') ? 'active' : '' }}">
                    <div class="nav-icon"><span class="material-icons-round">delete</span></div>
                    <span class="nav-text">Trashed Users</span>
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
    </div>

    <script>
        function toggleMenu() {
            const panel = document.getElementById('panel');
            panel.classList.toggle('collapsed');
            localStorage.setItem('adminPanelCollapsed', panel.classList.contains('collapsed'));
        }

        document.addEventListener('DOMContentLoaded', function() {
            const panel = document.getElementById('panel');
            if (localStorage.getItem('adminPanelCollapsed') === 'true') {
                panel.classList.add('collapsed');
            }
        });
    </script>
</body>

</html>
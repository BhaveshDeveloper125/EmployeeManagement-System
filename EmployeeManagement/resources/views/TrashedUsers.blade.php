<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trashed Users</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        :root {
            --navy: #111F4D;
            --light: #F2F4F7;
            --accent: #E43A19;
            --dark: #020205;
            --navy-light: #2A3A6D;
            --accent-light: #FF5C3A;
            --gold: #FFD700;
            --silver: #C0C0C0;
            --success: #10B981;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */


        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 40px;
            background: var(--light);
            transition: var(--transition);
            overflow-y: auto;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--navy);
            position: relative;
            padding-bottom: 10px;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--gold));
            border-radius: 2px;
        }

        /* Data Table Styles */
        .data-card {
            background: white;
            border-radius: var(--card-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: var(--transition);
        }

        .data-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .data-header {
            padding: 20px;
            background: var(--navy);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .data-title {
            font-size: 18px;
            font-weight: 600;
        }

        .data-count {
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: rgba(242, 244, 247, 0.8);
            color: var(--navy);
            padding: 16px 20px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .data-table td {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(242, 244, 247, 0.8);
            transition: var(--transition);
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:hover td {
            background: rgba(230, 240, 255, 0.3);
        }

        /* Action Buttons */
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            border: none;
        }

        .btn-restore {
            background: var(--success);
            color: white;
        }

        .btn-restore:hover {
            background: #0E9F6E;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
        }

        .btn-delete {
            background: #EF4444;
            color: white;
        }

        .btn-delete:hover {
            background: #DC2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
        }

        .btn-icon {
            margin-right: 6px;
            font-size: 16px;
        }

        /* Empty State */
        .empty-state {
            padding: 40px;
            text-align: center;
            color: #6B7280;
        }

        .empty-icon {
            font-size: 48px;
            color: #D1D5DB;
            margin-bottom: 16px;
        }

        /* Alerts */
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 15px;
            display: flex;
            align-items: center;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #EF4444;
            border-left: 4px solid #EF4444;
        }

        .alert-icon {
            margin-right: 12px;
            font-size: 20px;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .admin-panel {
                position: fixed;
                left: -100%;
                top: 0;
                bottom: 0;
                z-index: 1000;
                transition: transform 0.3s ease;
            }

            .admin-panel.open {
                transform: translateX(100%);
            }

            .main-content {
                padding: 24px;
                margin-left: 0 !important;
            }

            .mobile-menu-btn {
                display: flex;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 900;
                background: var(--accent);
                color: white;
                border: none;
                width: 48px;
                height: 48px;
                border-radius: 50%;
                justify-content: center;
                align-items: center;
                cursor: pointer;
                box-shadow: 0 4px 12px rgba(228, 58, 25, 0.3);
            }

            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .data-table th,
            .data-table td {
                padding: 12px 15px;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 24px;
            }

            .data-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .data-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">

        <x-menu />

        <div class="main-content">
            @if (session('Success'))
            <div class="alert alert-success">
                <span class="material-icons-round alert-icon">check_circle</span>
                {{ session('Success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-error">
                <span class="material-icons-round alert-icon">error</span>
                {{ session('error') }}
            </div>
            @endif

            @if (session('restore'))
            <div class="alert alert-success">
                <span class="material-icons-round alert-icon">check_circle</span>
                {{ session('restore') }}
            </div>
            @endif

            @if (session('not_restore'))
            <div class="alert alert-error">
                <span class="material-icons-round alert-icon">error</span>
                {{ session('not_restore') }}
            </div>
            @endif

            <div class="content-header">
                <h1 class="page-title">Trashed Users</h1>
            </div>

            <div class="data-card">
                <div class="data-header">
                    <div class="data-title">Deleted User Accounts</div>
                    <div class="data-count">{{ count($users) }} Users</div>
                </div>

                @if(count($users) > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->name }}</td>
                            <td>{{ $i->email }}</td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ "/restore/{$i->id}" }}" class="action-btn btn-restore">
                                        <span class="material-icons-round btn-icon">restore</span>
                                        Restore
                                    </a>
                                    <a href="{{ "/remove/{$i->id}"}}" class="action-btn btn-delete">
                                        <span class="material-icons-round btn-icon">delete_forever</span>
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <span class="material-icons-round">delete_outline</span>
                    </div>
                    <h3>No Trashed Users Found</h3>
                    <p>The trash bin is currently empty</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar
        function toggleMenu() {
            const panel = document.getElementById('panel');
            panel.classList.toggle('collapsed');
            localStorage.setItem('adminPanelCollapsed', panel.classList.contains('collapsed'));
        }

        // Mobile menu toggle
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            const panel = document.getElementById('panel');
            panel.classList.toggle('open');
        });

        // Initialize sidebar state
        document.addEventListener('DOMContentLoaded', function() {
            const panel = document.getElementById('panel');
            if (localStorage.getItem('adminPanelCollapsed') === 'true') {
                panel.classList.add('collapsed');
            }

            // Highlight current menu item
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active');
                }
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            const panel = document.getElementById('panel');
            const mobileBtn = document.getElementById('mobileMenuBtn');

            if (window.innerWidth <= 992 &&
                !panel.contains(e.target) &&
                e.target !== mobileBtn &&
                !mobileBtn.contains(e.target)) {
                panel.classList.remove('open');
            }
        });

        // Auto-close mobile menu on resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                document.getElementById('panel').classList.remove('open');
            }
        });
    </script>
</body>

</html>
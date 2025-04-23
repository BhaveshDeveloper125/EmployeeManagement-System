<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --navy-blue: #111F4D;
            --light-gray: #F2F4F7;
            --vibrant-red: #E43A19;
            --deep-black: #020205;
            --gold-accent: #FFD700;
            --soft-white: #FFFFFF;
            --table-highlight: rgba(228, 58, 25, 0.1);
            --platinum: #E5E4E2;
            --silver: #C0C0C0;
            --dark-navy: #0A142F;
            --light-blue: #E6F0FF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: var(--deep-black);
            line-height: 1.6;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .admin-panel {
            width: 280px;
            background: linear-gradient(180deg, var(--navy-blue), var(--dark-navy));
            color: var(--soft-white);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 100;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            overflow-x: hidden;
        }

        .admin-panel.collapsed {
            width: 80px;
        }

        .panel-header {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            min-height: 80px;
            background: rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .panel-header::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-accent), transparent);
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
        }

        .logo-icon {
            font-size: 28px;
            color: var(--gold-accent);
        }

        .menu-toggle {
            margin-left: auto;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .menu-toggle span {
            display: block;
            width: 22px;
            height: 2px;
            background: white;
            margin: 3px 0;
            transition: all 0.3s ease;
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
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 14px 24px;
            margin: 4px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--soft-white);
            opacity: 0.9;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            opacity: 1;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: var(--vibrant-red);
            box-shadow: 0 4px 12px rgba(228, 58, 25, 0.3);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--gold-accent);
        }

        .nav-icon {
            width: 24px;
            height: 24px;
            min-width: 24px;
            margin-right: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: margin 0.3s ease;
        }

        .admin-panel.collapsed .nav-icon {
            margin-right: 0;
        }

        .nav-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: brightness(0) invert(1);
            transition: filter 0.3s ease;
        }

        .nav-item:hover .nav-icon img {
            filter: brightness(1) invert(0);
        }

        .nav-item.active .nav-icon img {
            filter: brightness(1) invert(0);
        }

        .nav-text {
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            opacity: 1;
            width: auto;
            height: auto;
            overflow: visible;
        }

        .admin-panel.collapsed .nav-text {
            opacity: 0;
            width: 0;
            height: 0;
            overflow: hidden;
            margin-left: 0;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            width: calc(100% - 24px);
            margin: 20px 12px 0;
            padding: 14px 24px;
            background: rgba(228, 58, 25, 0.2);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 15px;
            font-weight: 500;
            white-space: nowrap;
        }

        .logout-btn:hover {
            background: var(--vibrant-red);
            box-shadow: 0 4px 12px rgba(228, 58, 25, 0.3);
        }

        .logout-icon {
            margin-right: 16px;
            min-width: 24px;
            transition: margin 0.3s ease;
        }

        .admin-panel.collapsed .logout-icon {
            margin-right: 0;
        }

        .logout-icon img {
            width: 24px;
            height: 24px;
            filter: brightness(0) invert(1);
        }

        .admin-panel.collapsed .logout-btn span {
            opacity: 0;
            width: 0;
            height: 0;
            overflow: hidden;
            margin-left: 0;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 40px;
            background: var(--light-gray);
            transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-container {
            background-color: var(--soft-white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(1, 31, 77, 0.2);
            padding: 30px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(1, 31, 77, 0.25);
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--navy-blue), var(--vibrant-red), var(--gold-accent));
        }

        h1,
        h2 {
            color: var(--navy-blue);
            margin-bottom: 20px;
            position: relative;
        }

        h1 {
            font-size: 2.5rem;
        }

        h2 {
            font-size: 1.8rem;
        }

        h1:after,
        h2:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--vibrant-red);
            border-radius: 2px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid var(--light-gray);
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: var(--navy-blue);
            box-shadow: 0 0 0 3px rgba(17, 31, 77, 0.2);
        }

        input::placeholder {
            color: var(--deep-black);
            opacity: 0.5;
        }

        input[type="submit"] {
            background-color: var(--navy-blue);
            color: var(--soft-white);
            border: none;
            padding: 16px 32px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        input[type="submit"]:hover {
            background-color: var(--vibrant-red);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(228, 58, 25, 0.3);
        }

        input[type="submit"]::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4) 0%, rgba(255, 255, 255, 0) 70%);
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        input[type="submit"]:hover::after {
            opacity: 1;
        }

        /* Table Styles */
        .table-container {
            background-color: var(--soft-white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(1, 31, 77, 0.2);
            padding: 30px;
            margin-bottom: 40px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        th {
            background-color: var(--navy-blue);
            color: var(--soft-white);
            padding: 16px 20px;
            text-align: left;
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        td {
            padding: 14px 20px;
            border-bottom: 1px solid var(--light-gray);
        }

        tr:hover {
            background-color: var(--table-highlight);
        }

        .empty-message {
            background-color: var(--soft-white);
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            font-size: 18px;
            color: var(--navy-blue);
            box-shadow: 0 10px 30px rgba(1, 31, 77, 0.2);
        }

        button {
            background: var(--navy-blue);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: var(--vibrant-red);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(228, 58, 25, 0.3);
        }

        .fa-pencil-alt {
            color: var(--soft-white);
        }

        /* Mobile menu button */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;
            background: var(--vibrant-red);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 8px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .mobile-menu-btn span {
            display: block;
            width: 24px;
            height: 2px;
            background: white;
            margin: 3px 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .main-content {
                padding: 30px;
            }
        }

        @media (max-width: 992px) {
            .admin-panel {
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                z-index: 900;
                transform: translateX(-100%);
            }

            .admin-panel.open {
                transform: translateX(0);
            }

            .admin-panel.collapsed {
                width: 280px;
            }

            .main-content {
                margin-left: 0 !important;
                padding: 20px;
                padding-top: 90px;
            }

            .mobile-menu-btn {
                display: flex;
            }

            h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .form-container,
            .table-container {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.8rem;
            }

            input[type="text"],
            input[type="password"],
            input[type="email"] {
                padding: 12px;
            }

            input[type="submit"] {
                padding: 14px;
                font-size: 16px;
            }

            th,
            td {
                padding: 12px 8px;
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 15px;
                padding-top: 80px;
            }

            h1 {
                font-size: 1.6rem;
            }

            .form-container,
            .table-container,
            .empty-message {
                padding: 15px;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .table-container {
            animation: fadeIn 0.8s ease-out forwards;
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-gray);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--navy-blue);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--vibrant-red);
        }
    </style>
</head>

<body>
    <!-- Mobile menu button (visible only on small screens) -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <div class="dashboard-container">
        <div class="admin-panel" id="panel">
            <div class="panel-header">
                <button class="menu-toggle" onclick="toggleMenu()">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <nav class="panel-nav">
                <a href="/adminPanel" class="nav-item">
                    <div class="nav-icon"><img src="{{ URL('Images/house.svg') }}" alt="Records"></div>
                    <span class="nav-text">Home</span>
                </a>
                <a href="/adminPanel/records" class="nav-item">
                    <div class="nav-icon"><img src="{{ URL('Images/directory.png') }}" alt="Records"></div>
                    <span class="nav-text">Records</span>
                </a>
                <a href="/adminPanel/generate_user" class="nav-item">
                    <div class="nav-icon"><img src="{{ URL('Images/working.png') }}" alt="Generate User"></div>
                    <span class="nav-text">Generate User</span>
                </a>
                <a href="/adminPanel/downloadData" class="nav-item">
                    <div class="nav-icon"><img src="{{ URL('Images/download.png') }}" alt="Download Data"></div>
                    <span class="nav-text">Download Data</span>
                </a>
                <a href="/adminPanel/search_user" class="nav-item active">
                    <div class="nav-icon"><img src="{{ URL('Images/cv.png') }}" alt="Search User"></div>
                    <span class="nav-text">Search User</span>
                </a>
                <a href="/adminPanel/holiday" class="nav-item">
                    <div class="nav-icon"><img src="{{ URL('Images/travel.png') }}" alt="Holiday Settings"></div>
                    <span class="nav-text">Holiday Settings</span>
                </a>
            </nav>

            <button class="logout-btn" onclick="document.querySelector('form').submit()">
                <div class="logout-icon"><img src="{{ URL('Images/logout.png') }}" alt="Logout"></div>
                <span>Logout</span>
            </button>
            <form action="/logout" method="post" style="display: none;">
                @csrf
            </form>
        </div>

        <div class="main-content">
            <h1>Employee Management</h1>

            <div class="form-container">
                <h2>Search Employee</h2>
                <form action="/get_user_info" method="post">
                    @csrf
                    <input type="text" name="name" placeholder="Enter employee name" required>
                    <input type="submit" value="Search">
                </form>
            </div>

            @if (isset($alldata) && $alldata->isNotEmpty())
            <div class="table-container">
                <h2>Search Results</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Sr no</th>
                            <th>Name</th>
                            <th>CheckIn</th>
                            <th>CheckOut</th>
                            <th>Working Hour</th>
                            <th>Date</th>
                            <th>Post</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Qualification</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alldata as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $i->name }}</td>
                            <td>{{ Carbon\Carbon::parse($i->entry)->format('H:i') }}</td>
                            <td>{{ Carbon\Carbon::parse($i->leave)->format('H:i') }}</td>
                            <td class="working-hours">
                                {{ $i->entry && $i->leave ? \Carbon\Carbon::parse($i->entry)->diff(\Carbon\Carbon::parse($i->leave))->format('%H:%I') : '' }}
                            </td>
                            <td>{{ Carbon\Carbon::parse($i->entry)->format('d-m-y') }}</td>
                            <td>{{ $i->post }}</td>
                            <td>{{ $i->mobile }}</td>
                            <td>{{ $i->address }}</td>
                            <td>{{ $i->qualificatio }}</td>
                            <td>
                                <!-- <button title="Edit user"><i class="fas fa-pencil-alt"></i></button> -->
                                <a href={{ "/editemps/".$i->id }}>
                                    Edit
                                </a>
                                <a href="">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-message">
                <i class="fas fa-search" style="font-size: 24px; margin-bottom: 10px;"></i>
                <p>No search results found</p>
            </div>
            @endif
        </div>
    </div>

    <script>
        function toggleMenu() {
            const panel = document.getElementById('panel');
            panel.classList.toggle('collapsed');

            const isCollapsed = panel.classList.contains('collapsed');
            localStorage.setItem('adminPanelCollapsed', isCollapsed);
        }

        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            const panel = document.getElementById('panel');
            panel.classList.toggle('open');
        });

        document.addEventListener('DOMContentLoaded', function() {
            const panel = document.getElementById('panel');
            const navItems = document.querySelectorAll('.nav-item');
            const currentPath = window.location.pathname;

            // Apply saved collapsed state
            const savedState = localStorage.getItem('adminPanelCollapsed');
            if (savedState === 'true') {
                panel.classList.add('collapsed');
            }

            // Highlight active nav item
            navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active');
                }
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
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const panel = document.getElementById('panel');
            if (window.innerWidth > 992) {
                panel.classList.remove('open');
            }
        });
    </script>
</body>

</html>
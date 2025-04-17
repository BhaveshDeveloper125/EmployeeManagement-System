<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        :root {
            --navy-blue: #111F4D;
            --light-gray: #F2F4F7;
            --vibrant-red: #E43A19;
            --deep-black: #020205;
            --gold-accent: #FFD700;
            --soft-white: #FFFFFF;
            --table-highlight: rgba(228, 58, 25, 0.1);
        }


        .cardcontainer {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
            margin-left: 10px;
            margin-right: 10px;
        }


        .cards {
            background: linear-gradient(135deg, var(--navy-blue), #1a2b6d);
            border-radius: 12px;
            padding: 25px;
            color: var(--soft-white);
            box-shadow: 0 6px 15px rgba(17, 31, 77, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cards:nth-child(2) {
            background: linear-gradient(135deg, var(--vibrant-red), #f05a3a);
        }

        .cards:nth-child(3) {
            background: linear-gradient(135deg, #10B981, #0d9f6e);
        }

        .cards:nth-child(4) {
            background: linear-gradient(135deg, var(--gold-accent), #e6c200);
        }

        .cards::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
            transition: all 0.3s ease;
        }

        .cards:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(17, 31, 77, 0.3);
        }

        .cards:hover::before {
            transform: rotate(30deg) translate(20px, 20px);
        }

        .cards h1 {
            color: var(--soft-white);
            margin: 0;
            font-size: 18px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
        }

        .cards h1:last-child {
            font-size: 32px;
            font-weight: 700;
            margin-top: 15px;
        }
    </style>
    <style>
        a {
            text-decoration: none;
        }



        .action-links {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .action-links a {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            background-color: var(--navy-blue);
            color: var(--soft-white);
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(17, 31, 77, 0.2);
        }

        .action-links a:hover {
            background-color: var(--vibrant-red);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(228, 58, 25, 0.3);
        }

        .action-links a::before {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 10px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .action-links a:nth-child(1)::before {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6zm8-6v5h5v-5h-5z'/%3E%3C/svg%3E");
        }

        .action-links a:nth-child(2)::before {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6zm5-11H9v2h2v-2zm0 3H9v2h2v-2zm0 3H9v2h2v-2zm4-6h-4v2h4v-2zm0 3h-4v2h4v-2zm0 3h-4v2h4v-2z'/%3E%3C/svg%3E");
        }

        .action-links a:nth-child(3)::before {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z'/%3E%3C/svg%3E");
        }

        @media (max-width: 768px) {

            .action-links {
                flex-direction: column;
                gap: 12px;
            }

            .action-links a {
                width: 100%;
                justify-content: center;
            }
        }

        #logout {
            &:hover {
                cursor: pointer;
            }
        }
    </style>
    <style>
        :root {
            --navy: #111F4D;
            --light: #F2F4F7;
            --accent: #E43A19;
            --dark: #020205;
            --navy-light: #2A3A6D;
            --accent-light: #FF5C3A;
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
            position: relative;
        }

        .admin-panel {
            height: 100vh;
            width: 280px;
            background: var(--navy);
            color: var(--light);
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
            color: var(--accent);
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
            color: var(--light);
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
            background: var(--accent);
            box-shadow: 0 4px 12px rgba(228, 58, 25, 0.3);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: white;
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
            background: var(--accent);
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
                padding-top: 80px;
            }

            .mobile-menu-btn {
                display: flex;
            }

            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-container {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 24px;
            }

            .data-header,
            .data-table th,
            .data-table td {
                padding: 12px 15px;
            }
        }
    </style>
</head>

<body>
    <div style="display: flex;">
        <div class="admin-panel" id="panel">
            <div class="panel-header">
                <div class="logo">
                    <!-- Logo can be added here if needed -->
                </div>
                <button class="menu-toggle" onclick="toggleMenu()">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <nav class="panel-nav">
                <a href="/adminPanel/records" class="nav-item active">
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
                <a href="/adminPanel/search_user" class="nav-item">
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

        <div style="flex: 1;">
            <br><br>
            <div class="cardcontainer">
                <div class="cards">
                    <a href="/filters?filter=employeelist">
                        <h1>Total Employees</h1>
                        <h1>{{ $userData }}</h1>
                    </a>
                </div>
                <div class="cards">
                    <a href="/filters?filter=late">
                        <h1>Late Today</h1>
                        <h1>{{ $lateEmp }}</h1>
                    </a>
                </div>
                <div class="cards">
                    <a href="/filters?filter=present">
                        <h1>Present Today</h1>
                        <h1>{{ $presentToday }}</h1>
                    </a>
                </div>
                <div class="cards">
                    <a href="/filters?filter=leave">
                        <h1>Leave Today</h1>
                        <h1>{{ $leaveToday }}</h1>
                    </a>
                </div>
                <div class="cards">
                    <a href="">
                        <h1>Absent Today</h1>
                        <h1>{{ $absent }}</h1>
                    </a>
                </div>
                <div class="cards">
                    <a href="/filters?filter=early_leave">
                        <h1>Early Leave Today</h1>
                        <h1>{{ $earlyLeave }}</h1>
                    </a>
                </div>
            </div>
            <div class="action-links">
                <a href="/pdfdatas">Download Records As PDF</a>
                <a href="/pdfdatas">Download Records As Excel</a>
                <a href="/pdfdatas">Print Records</a>
            </div>
        </div>
    </div>

    <script>
        function ExpandMenu() {
            const panel = document.querySelector('#panel');
            if (panel) {
                if (panel.classList.contains('admin_panel2')) {
                    panel.classList.remove('admin_panel2');
                    panel.classList.add('admin_panel');
                } else {
                    panel.classList.remove('admin_panel');
                    panel.classList.add('admin_panel2');
                }
            } else {
                console.error('Element with ID #panel not found!');
            }
        }
    </script>
    <script>
        function ExpandMenu() {
            const panel = document.querySelector('#panel');
            if (panel) {
                if (panel.classList.contains('admin_panel2')) {
                    panel.classList.remove('admin_panel2');
                    panel.classList.add('admin_panel');
                } else {
                    panel.classList.remove('admin_panel');
                    panel.classList.add('admin_panel2');
                }
            } else {
                console.error('Element with ID #panel not found!');
            }
        }

        function addDateInput() {
            const dateInputs = document.getElementById('dateInputs');
            const newGroup = document.createElement('div');
            newGroup.className = 'date-group';
            newGroup.innerHTML = `
                <input type="date" name="dates[]" required>
                <input type="text" name="titles[]" placeholder="Enter holiday title" required>
                <textarea name="reasons[]" placeholder="Reason for holiday" required></textarea>
                <button type="button" class="remove-btn" onclick="this.parentNode.remove()">Remove</button>
            `;
            dateInputs.appendChild(newGroup);
        }
    </script>
</body>

</html>
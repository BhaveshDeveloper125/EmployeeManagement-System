<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holidays Settings</title>
    <!-- <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: #f0f2f5;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
        }

        .holidaySection {
            display: flex;
            flex: 1;
        }

        .admin_panel {
            height: 100vh;
            width: 250px;
            background: linear-gradient(135deg, #111F4D, #020205);
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.4);
            transition: all 0.5s ease;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 10px;
        }

        .admin_panel2 {
            height: 100vh;
            width: 80px;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            transition: all 0.5s ease;
            overflow: hidden;
        }

        .three_line_container {
            height: 60px;
            width: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin: 10px;
            transition: all 0.3s ease;
        }

        .three_line_container:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        .three_line {
            height: 3px;
            width: 30px;
            background: #fff;
            margin: 3px 0;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .admin_panel .three_line_container {
            align-self: flex-start;
            margin-left: 10px;
        }

        .panel_ul {
            list-style: none;
            padding: 20px 0;
            margin: 0;
            width: 100%;
        }

        .panel_ul li {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            margin: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .panel_ul li:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .panel_ul li img {
            height: 32px;
            width: 32px;
            filter: brightness(0) invert(1);
            transition: filter 0.3s ease;
        }

        .panel_ul li:hover img {
            filter: brightness(1) invert(0);
        }

        .panel_ul li span {
            color: #F2F4F7;
            font-size: 16px;
            font-weight: 500;
            padding-left: 15px;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .panel_ul li:hover span {
            opacity: 1;
        }

        .admin_panel .panel_ul li span {
            display: block;
        }

        .admin_panel2 .panel_ul li span {
            display: none;
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        form {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            max-width: 600px;
        }

        form h1 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #111F4D;
        }

        form select,
        form input[type="text"],
        form input[type="date"],
        form textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        form input[type="submit"],
        form button {
            padding: 10px 20px;
            background-color: #E43A19;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 10px;
        }

        form button.remove-btn {
            background-color: #888;
            margin-top: 10px;
        }

        .date-group {
            background: #F2F4F7;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
    </style> 
    
    
    
    -->

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
    <div class="holidaySection">
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
                <a href="/adminPanel/search_user" class="nav-item">
                    <div class="nav-icon"><img src="{{ URL('Images/cv.png') }}" alt="Search User"></div>
                    <span class="nav-text">Search User</span>
                </a>
                <a href="/adminPanel/holiday" class="nav-item active">
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

        <div class="content">
            <h1>Set Weekly Holiday</h1>


            <!-- <select name="weekly_holiday" id="">
                <option value="sun">Sunday</option>
                <option value="mon">Monday</option>
                <option value="tue">Tuesday</option>
                <option value="wed">Wednesday</option>
                <option value="thurs">Thursday</option>
                <option value="fri">Friday</option>
                <option value="satur">Saturday</option>
                <option value="no">No Holiday</option>
            </select> -->
            <form action="/setweeklyholiday" method="post" id="selctDays">
                @csrf
                <button onclick="showDays()" id="daycounter">0 Days</button>
                <input type="submit" value="Set Holidays">
            </form>

            <form action="/setholiday" method="post">
                @csrf
                <h1>Set Other Holidays</h1>
                <div id="">
                    <div class="date-group">
                        <input type="date" name="dates[]" required>
                        <input type="text" name="titles[]" placeholder="Enter holiday title" required>
                        <textarea name="reasons[]" placeholder="Reason for holiday" required></textarea>
                    </div>
                </div>
                <button type="button" onclick="addDateInput()">Add Another Date</button>
                <button type="submit">Submit</button>
            </form>
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

            const savedState = localStorage.getItem('adminPanelCollapsed');
            if (savedState === 'true') {
                panel.classList.add('collapsed');
            }

            navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active');
                }
            });

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

        window.addEventListener('resize', function() {
            const panel = document.getElementById('panel');
            if (window.innerWidth > 992) {
                panel.classList.remove('open');
            }
        });
    </script>


    <script>
        let weeklyDaysCounter = 0;

        function showDays() {
            weeklyDaysCounter++;
            if (weeklyDaysCounter == 6) {
                document.querySelector('#daycounter').disabled = true;
            }
            document.querySelector('#daycounter').innerHTML = `${weeklyDaysCounter} Days`;
            const selector = `<select name="weekly_holiday[]" id="">
                    <option value="sun">Sunday</option>
                    <option value="mon">Monday</option>
                    <option value="tue">Tuesday</option>
                    <option value="wed">Wednesday</option>
                    <option value="thurs">Thursday</option>
                    <option value="fri">Friday</option>
                    <option value="satur">Saturday</option>
                    <option value="no">No Holiday</option>
                </select> `;

            document.querySelector('#selctDays').innerHTML += selector;
        }
    </script>


</body>

</html>
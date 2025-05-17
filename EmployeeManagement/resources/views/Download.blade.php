<x-loader />
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
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
            overflow-x: hidden;
        }

        .holidaySection {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar Styles */
        .admin-panel {
            height: 100vh;
            width: 280px;
            background: linear-gradient(135deg, var(--navy), var(--navy-light));
            color: var(--light);
            transition: var(--transition);
            position: relative;
            z-index: 100;
            box-shadow: var(--shadow);
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
            transition: var(--transition);
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
            transition: var(--transition);
            border-radius: 2px;
        }

        /* Show cross when expanded */
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
            transition: var(--transition);
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
            transition: var(--transition);
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

        /* Main Content Styles */
        .content {
            flex: 1;
            padding: 40px;
            background: var(--light);
            transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        h1 {
            font-size: 2.5rem;
            color: var(--navy);
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }

        h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }

        form {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        form:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        #selctDays {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }

        #daycounter {
            background: var(--navy);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #daycounter:hover {
            background: var(--navy-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        #daycounter:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        input[type="submit"],
        button[type="submit"] {
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        input[type="submit"]:hover,
        button[type="submit"]:hover {
            background: var(--accent-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        select {
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid rgba(2, 2, 5, 0.1);
            background: white;
            font-size: 14px;
            color: var(--dark);
            cursor: pointer;
            appearance: none;
            padding-right: 40px;
            min-width: 200px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23111F4D' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px;
        }

        select:hover {
            border-color: rgba(2, 2, 5, 0.2);
        }

        select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(228, 58, 25, 0.2);
        }

        .date-group {
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            background: rgba(242, 244, 247, 0.5);
            position: relative;
            transition: var(--transition);
        }

        .date-group:hover {
            background: rgba(242, 244, 247, 0.8);
        }

        input[type="date"],
        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px 16px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid rgba(2, 2, 5, 0.1);
            font-size: 14px;
            transition: var(--transition);
        }

        input[type="date"]:focus,
        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(228, 58, 25, 0.2);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        button[type="button"] {
            background: var(--navy);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            margin-right: 10px;
        }

        button[type="button"]:hover {
            background: var(--navy-light);
            transform: translateY(-2px);
        }

        .remove-btn {
            background: #e74c3c !important;
            padding: 8px 15px !important;
            font-size: 12px !important;
        }

        .remove-btn:hover {
            background: #c0392b !important;
        }

        /* Mobile menu button */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;
            background: var(--accent);
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
            transition: var(--transition);
            border-radius: 2px;
        }

        /* Responsive adjustments */
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

            .content {
                margin-left: 0 !important;
                padding: 20px;
                padding-top: 80px;
            }

            .mobile-menu-btn {
                display: flex;
            }

            h1 {
                font-size: 2rem;
            }

            form {
                padding: 20px;
            }

            #selctDays {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 1.8rem;
            }

            .date-group {
                padding: 15px;
            }

            input[type="date"],
            input[type="text"],
            textarea {
                padding: 10px 12px;
            }

            button,
            input[type="submit"] {
                width: 100%;
                margin-bottom: 10px;
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

        form {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .date-group {
            animation: fadeIn 0.4s ease-out forwards;
        }

        /* Glow effect for premium feel */
        .nav-item.active {
            position: relative;
            overflow: hidden;
        }

        .nav-item.active:after {
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

        .nav-item.active:hover:after {
            opacity: 1;
        }

        /* Metallic accents */
        .panel-header {
            position: relative;
        }

        .panel-header:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }
    </style>
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

        @media print {

            #pdf,
            #excel,
            #print {
                display: none;
            }
        }

        .table-container {
            width: 100%;
            max-width: 1200px;
            background-color: var(--soft-white);
            border-radius: 16px;
            box-shadow: 0 12px 24px rgba(1, 31, 77, 0.15);
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        .table-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--navy-blue), var(--vibrant-red), var(--gold-accent));
        }

        h2 {
            color: var(--navy-blue);
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            position: relative;
            padding-bottom: 15px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--navy-blue), var(--vibrant-red));
            border-radius: 2px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            font-size: 15px;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background-color: var(--navy-blue);
            color: var(--soft-white);
            padding: 18px 15px;
            text-align: center;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            position: sticky;
            top: 0;
            font-size: 16px;
            border: none;
        }

        th:first-child {
            border-top-left-radius: 8px;
        }

        th:last-child {
            border-top-right-radius: 8px;
        }

        td {
            padding: 16px 15px;
            text-align: center;
            border-bottom: 1px solid rgba(242, 244, 247, 0.8);
            transition: all 0.2s ease;
            background-color: var(--soft-white);
        }

        tr:nth-child(even) td {
            background-color: rgba(242, 244, 247, 0.5);
        }

        tr:hover td {
            background-color: var(--table-highlight);
            transform: scale(1.01);
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Special status styling */
        .status-present {
            color: #10B981;
            font-weight: 600;
        }

        .status-absent {
            color: var(--vibrant-red);
            font-weight: 600;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            .table-container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            th,
            td {
                padding: 12px 10px;
                font-size: 14px;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        tr {
            animation: fadeIn 0.4s ease forwards;
        }

        tr:nth-child(1) {
            animation-delay: 0.1s;
        }

        tr:nth-child(2) {
            animation-delay: 0.2s;
        }

        tr:nth-child(3) {
            animation-delay: 0.3s;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            justify-content: flex-end;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(17, 31, 77, 0.15);
            position: relative;
            overflow: hidden;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .action-btn:hover::before {
            opacity: 1;
        }

        .action-btn i {
            margin-right: 8px;
            font-size: 18px;
        }

        .btn-excel {
            background-color: var(--success-green);
            color: var(--soft-white);
        }

        .btn-pdf {
            background-color: var(--vibrant-red);
            color: var(--soft-white);
        }

        .btn-print {
            background-color: var(--navy-blue);
            color: var(--soft-white);
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(17, 31, 77, 0.25);
        }

        .action-btn:active {
            transform: translateY(1px);
            box-shadow: 0 2px 4px rgba(17, 31, 77, 0.2);
        }

        /* Icon styling using Unicode characters */
        .action-btn::after {
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-right: 8px;
        }

        .btn-excel::after {
            content: '\f1c3';
            /* Excel icon */
        }

        .btn-pdf::after {
            content: '\f1c1';
            /* PDF icon */
        }

        .btn-print::after {
            content: '\f02f';
            /* Print icon */
        }

        @media (max-width: 768px) {
            .action-buttons {
                justify-content: center;
                flex-wrap: wrap;
            }

            .action-btn {
                padding: 10px 18px;
                font-size: 14px;
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
                <a href="/adminPanel/downloadData" class="nav-item active">
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
            <div class="table-container">
                <h2>Employee Records</h2>
                <div class="action-buttons">
                    <!-- <button id="excel" class=" action-btn btn-excel">
                <i class="fas fa-file-excel"></i> Excel
            </button> -->
                    <button id="pdf" class=" action-btn btn-pdf" onclick="window.print()">
                        <i class="fas fa-file-pdf"></i> PDF
                    </button>
                    <button id="print" class=" action-btn btn-print" onclick="window.print()">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Name</th>
                            <th>CheckIn</th>
                            <th>CheckOut</th>
                            <th>Post</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Qualification</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $i->name }}</td>
                            <td class="status-present">{{ Carbon\Carbon::parse($i->entry)->format('H:i') }}</td>
                            <td class="status-present">{{ Carbon\Carbon::parse($i->leave)->format('H:i') }}</td>
                            <td>{{ $i->post }}</td>
                            <td>{{ $i->mobile }}</td>
                            <td>{{ $i->address }}</td>
                            <td>{{ $i->qualificatio }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
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
</body>

</html>
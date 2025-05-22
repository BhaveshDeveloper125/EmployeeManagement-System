<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
    <style>
        :root {
            --navy-blue: #111F4D;
            --light-gray: #F2F4F7;
            --vibrant-red: #E43A19;
            --deep-black: #020205;
            --gold-accent: #FFD700;
            --soft-white: #FFFFFF;
            --success-green: #10B981;
            --dark-navy: #0A142F;
            --light-blue: #E6F0FF;
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --header-height: 80px;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: var(--deep-black);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            margin: 0;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
            background: linear-gradient(135deg, var(--navy-blue), var(--dark-navy));
            color: var(--soft-white);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            z-index: 100;
            transition: var(--transition);
        }

        .menu-toggle {
            height: 50px;
            width: 50px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 12px;
            cursor: pointer;
            transition: var(--transition);
            background-color: rgba(255, 255, 255, 0.1);
            z-index: 101;
        }

        .menu-toggle:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .menu-toggle span {
            height: 3px;
            width: 25px;
            background-color: var(--soft-white);
            margin: 2px 0;
            border-radius: 2px;
            transition: var(--transition);
        }

        .menu-toggle.active span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }

        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            flex-grow: 1;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--navy-blue), var(--dark-navy));
            color: var(--soft-white);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 99;
            transition: transform var(--transition), width var(--transition);
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }

        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 0 1.5rem;
            transition: var(--transition);
        }

        .sidebar-logo {
            font-size: 1.5rem;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            transition: var(--transition);
        }

        .sidebar.collapsed .sidebar-logo {
            opacity: 0;
            width: 0;
        }

        .sidebar-menu {
            padding: 1.5rem 0;
        }

        .sidebar-menu ul {
            list-style: none;
        }

        .sidebar-menu li {
            position: relative;
        }

        .sidebar-menu li a,
        .sidebar-menu li form {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: var(--soft-white);
            text-decoration: none;
            transition: var(--transition);
            white-space: nowrap;
            overflow: hidden;
            width: 100%;
        }

        .sidebar-menu li:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--gold-accent);
            transform: scaleY(0);
            transition: var(--transition);
        }

        .sidebar-menu li:hover::before {
            transform: scaleY(1);
        }

        .sidebar-menu li i {
            margin-right: 1rem;
            font-size: 1.2rem;
            min-width: 24px;
            text-align: center;
        }

        .sidebar.collapsed .sidebar-menu li span {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .logout-form input[type="submit"] {
            background-color: transparent;
            border: none;
            color: var(--soft-white);
            font-size: 1rem;
            cursor: pointer;
            padding: 0;
            width: 100%;
            text-align: left;
            display: flex;
            align-items: center;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: calc(var(--header-height) + 2rem) 2rem 2rem;
            transition: var(--transition);
            min-height: 100vh;
        }

        .main-content.collapsed {
            margin-left: var(--sidebar-collapsed);
        }

        .main-content.expanded {
            margin-left: 0;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .dashboard-card {
            background-color: var(--soft-white);
            border-radius: 12px;
            padding: 1.75rem;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--navy-blue), var(--vibrant-red));
        }

        .dashboard-card:nth-child(2)::before {
            background: linear-gradient(90deg, var(--vibrant-red), #c0392b);
        }

        .dashboard-card:nth-child(3)::before {
            background: linear-gradient(90deg, var(--success-green), #0d8a5a);
        }

        .dashboard-card:nth-child(4)::before {
            background: linear-gradient(90deg, var(--gold-accent), #e6b800);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-size: 1rem;
            color: var(--navy-blue);
            margin-bottom: 0.75rem;
            font-weight: 500;
        }

        .card-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--deep-black);
            margin-bottom: 0.5rem;
        }

        .card-description {
            font-size: 0.85rem;
            color: #64748B;
        }

        .attendance-section {
            max-width: 800px;
            margin: 0 auto 2.5rem;
            background-color: var(--soft-white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }

        .attendance-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--navy-blue), var(--vibrant-red), var(--gold-accent));
        }

        .section-title {
            color: var(--navy-blue);
            text-align: center;
            margin-bottom: 1.75rem;
            font-size: 1.75rem;
            position: relative;
            padding-bottom: 12px;
        }

        .section-title::after {
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

        .divider {
            border: none;
            height: 1px;
            background-color: #E2E8F0;
            margin: 1.75rem 0;
        }

        .attendance-form {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--navy-blue);
            font-size: 1rem;
        }

        .form-input {
            padding: 0.9rem 1.25rem;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background-color: var(--light-gray);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--navy-blue);
            box-shadow: 0 0 0 3px rgba(17, 31, 77, 0.1);
        }

        .form-button {
            background: linear-gradient(to right, var(--navy-blue), var(--dark-navy));
            color: var(--soft-white);
            border: none;
            padding: 1rem 1.75rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0.5rem;
        }

        .check-out .form-button {
            background: linear-gradient(to right, var(--vibrant-red), #c0392b);
        }

        .form-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(17, 31, 77, 0.2);
        }

        .status-message {
            text-align: center;
            padding: 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            margin: 1.5rem 0;
        }

        .success-message {
            background-color: var(--success-green);
            color: var(--soft-white);
        }

        .action-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .action-link {
            display: inline-flex;
            align-items: center;
            padding: 0.9rem 1.75rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            gap: 0.5rem;
        }

        .primary-link {
            background: linear-gradient(to right, var(--navy-blue), var(--dark-navy));
            color: var(--soft-white);
        }

        .danger-link {
            background: linear-gradient(to right, var(--vibrant-red), #c0392b);
            color: var(--soft-white);
        }

        .action-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 98;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.active .sidebar-logo,
            .sidebar.active .sidebar-menu li span {
                opacity: 1;
                width: auto;
            }

            .sidebar.collapsed {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }

            .main-content.collapsed {
                margin-left: 0;
            }

            .sidebar-menu li a,
            .sidebar-menu li form {
                padding: 1.25rem 1.5rem;
            }

            .sidebar-menu li i {
                font-size: 1.4rem;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 0 1.5rem;
            }

            .main-content {
                padding: calc(var(--header-height) + 1.5rem) 1.5rem 1.5rem;
            }

            .attendance-section {
                padding: 1.5rem;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .header-title {
                font-size: 1.25rem;
            }

            .menu-toggle {
                width: 45px;
                height: 45px;
            }

            .action-links {
                flex-direction: column;
                gap: 0.75rem;
            }

            .action-link {
                justify-content: center;
            }
        }

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

        .dashboard-card {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .attendance-section {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header class="header" id="header">
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle sidebar">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <h1 class="header-title">Attendance System</h1>
        <div style="width: 50px;"></div>
    </header>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">AttendancePro</div>
        </div>
        <nav class="sidebar-menu">
            <ul>
                <li>
                    <a href="#">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @auth
                <li>
                    <a href="/attendance/{{ Auth::id() }}">
                        <i class="fas fa-history"></i>
                        <span>Attendance History</span>
                    </a>
                </li>
                <li class="logout-form">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
                @else
                <li>
                    <a href="/login">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                </li>
                @endauth
            </ul>
        </nav>
    </aside>

    <main class="main-content" id="mainContent">
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <a href="/empfilter/attend">
                    <h3 class="card-title">Attendance/Month</h3>
                    <div class="card-value">{{ $attendance }}</div>
                </a>
                <p class="card-description">Total days present this month</p>
            </div>
            <div class="dashboard-card">
                <a href="/empfilter/late">
                    <h3 class="card-title">Late Attendance</h3>
                    <div class="card-value">{{ $lateattendance }}</div>
                </a>
                <p class="card-description">Late arrivals this month</p>
            </div>
            <div class="dashboard-card">
                <a href="/empfilter/absent">
                    <h3 class="card-title">Absent/Month</h3>
                    <div class="card-value">{{ $leavingtime }}</div>
                </a>
                <p class="card-description">Days absent this month</p>
            </div>
            <div class="dashboard-card">
                <a href="/empfilter/early">
                    <h3 class="card-title">Early Leave</h3>
                    <div class="card-value">{{ $earlyLeave }}</div>
                </a>
                <p class="card-description">Early departures this month</p>
            </div>
            <div class="dashboard-card">
                <a href="/empfilter/overtime">
                    <h3 class="card-title">OverTime</h3>
                    <div class="card-value">{{ $overtime }}</div>
                </a>
                <p class="card-description">Extra hours worked</p>
            </div>
            <div class="dashboard-card">
                <h3 class="card-title">Working Days of this month</h3>
                <div class="card-value">{{ $totalWorkingDays }}</div>
                <p class="card-description">Total working day in current month</p>
            </div>
            <div class="dashboard-card">
                <h3 class="card-title">Remain Days</h3>
                <div class="card-value">{{ $actual_working_days }}</div>
                <p class="card-description">Days left in current month</p>
            </div>
        </div>

        <section class="attendance-section">
            <h2 class="section-title">Attendance Tracking</h2>

            <div class="divider"></div>

            <div class="time-watcher-forms">
                @if(!$hasCheckedIn && !$hasCheckedOut)
                <form action="/Entery" method="post" class="attendance-form">
                    @csrf
                    <div class="form-group">
                        <label for="EntryTime" class="form-label">Check In</label>
                        <input type="datetime-local" name="start" id="EntryTime" class="form-input" readonly required>
                    </div>
                    <button type="submit" class="form-button">
                        <i class="fas fa-sign-in-alt"></i> Check In
                    </button>
                </form>

                @elseif($hasCheckedIn && !$hasCheckedOut)
                <form action="/leave" method="post" class="attendance-form check-out">
                    @csrf
                    <div class="form-group">
                        <label for="EndTime" class="form-label">Check Out</label>
                        <input type="datetime-local" name="end" id="EndTime" class="form-input" readonly required>
                    </div>
                    <button type="submit" class="form-button">
                        <i class="fas fa-sign-out-alt"></i> Check Out
                    </button>
                </form>

                @elseif($hasCheckedOut)
                <div class="status-message success-message">
                    <i class="fas fa-check-circle"></i> Thanks for working today!
                </div>
                @endif
            </div>
        </section>

        <div class="action-links">
            @auth
            <a href="/attendance/{{ Auth::id() }}" class="action-link primary-link">
                <i class="fas fa-history"></i> View Attendance History
            </a>
            @else
            <a href="/login" class="action-link danger-link">
                <i class="fas fa-sign-in-alt"></i> Login to Track Attendance
            </a>
            @endauth
        </div>
    </main>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            const isMobile = window.innerWidth <= 992;

            if (isMobile) {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
                menuToggle.classList.toggle('active');
            } else {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('collapsed');
            }
        }

        menuToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        document.querySelectorAll('.sidebar-menu a, .sidebar-menu button').forEach(item => {
            item.addEventListener('click', () => {
                if (window.innerWidth <= 992) {
                    toggleSidebar();
                }
            });
        });

        window.addEventListener('resize', () => {
            const isMobile = window.innerWidth <= 992;
            if (!isMobile) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                menuToggle.classList.remove('active');
            } else {
                if (!sidebar.classList.contains('active')) {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('collapsed');
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const updateTime = () => {
                const now = new Date();
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const day = String(now.getDate()).padStart(2, '0');
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const localDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

                const entryInput = document.getElementById('EntryTime');
                const endInput = document.getElementById('EndTime');

                if (entryInput) entryInput.value = localDateTime;
                if (endInput) endInput.value = localDateTime;
            };

            updateTime();
            setInterval(updateTime, 1000);
        });
    </script>
</body>

</html>
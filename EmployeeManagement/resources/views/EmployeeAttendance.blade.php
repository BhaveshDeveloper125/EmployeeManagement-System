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
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: var(--navy-blue);
            color: var(--soft-white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            width: 100%;
        }

        .three_line_container {
            height: 50px;
            width: 50px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.1);
            z-index: 101;
        }

        .three_line_container:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .therr_lines {
            height: 3px;
            width: 25px;
            background-color: var(--soft-white);
            margin: 2px 0;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .container {
            display: flex;
            flex: 1;
            overflow-y: auto;
        }

        .side_bar {
            width: 250px;
            background: linear-gradient(180deg, var(--navy-blue), #0a1435);
            color: var(--soft-white);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 99;
        }

        .side_bar_shrink {
            width: 0;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .side_bar ul {
            list-style: none;
            padding: 1rem 0;
        }

        .side_bar li {
            padding: 1rem 1.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            position: relative;
        }

        .side_bar li:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .side_bar li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--gold-accent);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .side_bar li:hover::before {
            transform: scaleY(1);
        }

        .side_bar_shrink li span {
            display: none;
        }

        .logout-form input[type="submit"] {
            background-color: transparent;
            border: none;
            color: var(--soft-white);
            font-size: 1rem;
            cursor: pointer;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            text-align: left;
        }

        .content_container {
            flex: 1;
            padding: 2rem;
            background-color: var(--light-gray);
            transition: margin-left 0.3s;
        }

        @media (max-width: 768px) {
            .side_bar {
                transform: translateX(-100%);
            }

            .side_bar.active {
                transform: translateX(0);
                width: 250px;
            }

            .side_bar_shrink {
                width: 0;
            }
        }

        .cardcontainer {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 2rem;
        }

        .cards {
            background-color: var(--soft-white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border-top: 4px solid var(--navy-blue);
        }

        .cards:nth-child(2) {
            border-top-color: var(--vibrant-red);
        }

        .cards:nth-child(3) {
            border-top-color: var(--success-green);
        }

        .cards:nth-child(4) {
            border-top-color: var(--gold-accent);
        }

        .cards:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .cards h1 {
            font-size: 1rem;
            color: var(--navy-blue);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .cards h1:last-child {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--deep-black);
        }

        .attendance-section {
            max-width: 600px;
            margin: 2rem auto;
            background-color: var(--soft-white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .attendance-section h1 {
            color: var(--navy-blue);
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            position: relative;
            padding-bottom: 10px;
        }

        .attendance-section h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--navy-blue), var(--vibrant-red));
        }

        form.checkIn,
        form.checkOut {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        form label {
            font-weight: 600;
            color: var(--navy-blue);
        }

        form input[type="datetime-local"] {
            padding: 0.8rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.2s;
        }

        form input[type="datetime-local"]:focus {
            outline: none;
            border-color: var(--navy-blue);
            box-shadow: 0 0 0 3px rgba(17, 31, 77, 0.1);
        }

        form button[type="submit"] {
            background-color: var(--navy-blue);
            color: var(--soft-white);
            border: none;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        form.checkOut button[type="submit"] {
            background-color: var(--vibrant-red);
        }

        form button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(17, 31, 77, 0.2);
        }

        hr {
            border: none;
            height: 1px;
            background-color: #e2e8f0;
            margin: 1.5rem 0;
        }

        .auth-links {
            text-align: center;
            margin-top: 2rem;
        }

        .auth-links a {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .attendance-link {
            background-color: var(--navy-blue);
            color: var(--soft-white);
        }

        .login-link {
            background-color: var(--vibrant-red);
            color: var(--soft-white);
        }

        .auth-links a:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .thank-you-message {
            text-align: center;
            padding: 1.5rem;
            background-color: var(--success-green);
            color: var(--soft-white);
            border-radius: 8px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .cardcontainer {
                grid-template-columns: 1fr 1fr;
            }

            .content_container {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .cardcontainer {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 1rem;
            }

            .three_line_container {
                width: 40px;
                height: 40px;
            }
        }

        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header">
        <div class="three_line_container" onclick="toggleSidebar()">
            <div class="therr_lines"></div>
            <div class="therr_lines"></div>
            <div class="therr_lines"></div>
        </div>
        <h2>Attendance System</h2>
        <div style="width: 50px;"></div> <!-- Spacer for alignment -->
    </div>

    <div class="container">
        <br><br><br><br><br><br><br><br>
        <div id="sideMenu" class="side_bar">
            <ul>
                <li>
                    <span>DashBoard</span>
                </li>
                @auth
                <li>
                    <a href="/attendance/{{ Auth::id() }}">Attendance History</a>
                </li>
                <li class="logout-form">
                    <form action="/logout" method="post">
                        @csrf
                        <input type="submit" value="Logout">
                    </form>
                </li>
                @else
                <li>
                    <a href="/login">Login to Track Attendance</a>
                </li>
                @endauth
            </ul>
        </div>
        <div class="content_container">
            <div class="cardcontainer">
                <div class="cards">
                    <h1>Attendance/Month</h1>
                    <h1>{{ $attendance }}</h1>
                </div>
                <div class="cards">
                    <h1>Late Attendance/Month</h1>
                    <h1>{{ $lateattendance }}</h1>
                </div>
                <div class="cards">
                    <h1>Absent/Month</h1>
                    <h1>{{ $leavingtime }}</h1>
                </div>
                <div class="cards">
                    <h1>Early Leave/Month</h1>
                    <h1>{{ $earlyLeave }}</h1>
                </div>
                <div class="cards">
                    <h1>OverTime</h1>
                    <h1>{{ $overtime }}</h1>
                </div>
                <!-- <div class="cards">
                    <h1>Complete Time/Month</h1>
                    <h1>{{ $absent }}</h1>
                </div> -->
                <div class="cards">
                    <h1>Remain Days</h1>
                    <h1>{{ floor(Carbon\Carbon::today()->diffInDays(Carbon\Carbon::today()->endOfMonth())) }}</h1>
                </div>
            </div>

            <div class="attendance-section">
                <h1>Attendance Tracking</h1>

                <hr>

                <div class="time-watcher-forms">
                    @if(!$hasCheckedIn && !$hasCheckedOut)
                    <form action="/Entery" method="post" class="checkIn">
                        @csrf
                        <label for="EntryTime">Check In</label>
                        <input type="datetime-local" name="start" id="EntryTime" readonly required>
                        <button type="submit">Check In</button>
                    </form>

                    @elseif($hasCheckedIn && !$hasCheckedOut)
                    <form action="/leave" method="post" class="checkOut">
                        @csrf
                        <label for="EndTime">Check Out</label>
                        <input type="datetime-local" name="end" id="EndTime" readonly required>
                        <button type="submit">Check Out</button>
                    </form>

                    @elseif($hasCheckedOut)
                    <div class="thank-you-message">
                        <p>Thanks for working today!</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="auth-links">
                @auth
                <a href="/attendance/{{ Auth::id() }}" class="attendance-link">View Your Attendance History</a>
                @else
                <a href="/login" class="login-link">Login to Track Attendance</a>
                @endauth
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sideMenu = document.getElementById('sideMenu');
            const isMobile = window.innerWidth <= 768;

            if (isMobile) {
                sideMenu.classList.toggle('active');
                if (sideMenu.classList.contains('active')) {
                    createOverlay();
                } else {
                    removeOverlay();
                }
            } else {
                sideMenu.classList.toggle('side_bar_shrink');
            }
        }

        function createOverlay() {
            const overlay = document.createElement('div');
            overlay.id = 'sidebar-overlay';
            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(0,0,0,0.5)';
            overlay.style.zIndex = '98';
            overlay.onclick = function() {
                toggleSidebar();
            };
            document.body.appendChild(overlay);
        }

        function removeOverlay() {
            const overlay = document.getElementById('sidebar-overlay');
            if (overlay) {
                document.body.removeChild(overlay);
            }
        }

        document.querySelectorAll('#sideMenu a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    toggleSidebar();
                }
            });
        });
    </script>

    <script>
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
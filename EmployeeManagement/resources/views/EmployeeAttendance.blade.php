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
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: var(--navy-blue);
            color: var(--soft-white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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

        /* Sidebar Styles */
        .container {
            display: flex;
            flex: 1;
        }

        .side_bar {
            width: 250px;
            background: linear-gradient(180deg, var(--navy-blue), #0a1435);
            color: var(--soft-white);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .side_bar_shrink {
            width: 70px;
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
        }

        /* Main Content Styles */
        .content_container {
            flex: 1;
            padding: 2rem;
            background-color: var(--light-gray);
        }

        /* Dashboard Cards */
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

        /* Attendance Form Styles */
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

        /* Auth Links */
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .cardcontainer {
                grid-template-columns: 1fr 1fr;
            }

            .side_bar {
                position: absolute;
                z-index: 100;
                height: 100%;
                transform: translateX(-100%);
            }

            .side_bar.active {
                transform: translateX(0);
            }

            .side_bar_shrink {
                transform: translateX(-100%);
            }

            .content_container {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .cardcontainer {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <style>
        a {
            text-decoration: none;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header">
        <div class="three_line_container" onclick="ShowSideBar()">
            <div class="therr_lines"></div>
            <div class="therr_lines"></div>
            <div class="therr_lines"></div>
        </div>
        <h2>Attendance System</h2>
        <div style="width: 50px;"></div> <!-- Spacer for alignment -->
    </div>

    <div class="container">
        <div id="sideMenu" class="side_bar">
            <ul>
                <li>
                    <span>DashBoard</span>
                </li>
                @auth
                <li>
                    <span>
                        <a href="/attendance/{{ Auth::id() }}" class="attendance-link">Attendance History</a>
                        @else
                        <a href="/login" class="login-link">Login to Track Attendance</a>
                    </span>
                </li>
                @endauth
                <li class="logout-form">
                    <form action="/logout/" method="post">
                        @csrf
                        <input type="submit" value="Logout">
                    </form>
                </li>
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
                    <h1>{{ $absent }}</h1>
                </div>
                <div class="cards">
                    <h1>Early Leave/Month</h1>
                    <h1>{{ $earlyLeave }}</h1>
                </div>
                <div class="cards">
                    <h1>OverTime</h1>
                    <h1>{{ $overtime }}</h1>
                </div>
                <div class="cards">
                    <h1>Complete Time/Month</h1>
                    <h1>{{ $leavingtime }}</h1>
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
                        <input type="datetime-local" name="start" id="EntryTime" required
                            value="{{ now()->format('Y-m-d\TH:i') }}">
                        <button type="submit">Check In</button>
                    </form>

                    @elseif($hasCheckedIn && !$hasCheckedOut)
                    <form action="/leave" method="post" class="checkOut">
                        @csrf
                        <label for="EndTime">Check Out</label>
                        <input type="datetime-local" name="end" id="EndTime" required
                            value="{{ now()->format('Y-m-d\TH:i') }}">
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

    <pre>

    </pre>

    <script>
        function ShowSideBar() {
            let sideMenu = document.querySelector('#sideMenu');
            sideMenu.classList.toggle('side_bar');
            sideMenu.classList.toggle('side_bar_shrink');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updateTime = () => {
                const now = new Date();
                const localDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000)
                    .toISOString()
                    .slice(0, 16);

                document.getElementById('EntryTime').value = localDateTime;
                document.getElementById('EndTime').value = localDateTime;
            };

            updateTime();
            setInterval(updateTime, 1000);
        });

        // document.querySelector('.checkOut').style.display = "none";

        // document.querySelector('.checkIn').addEventListener('submit', (e) => {


        //     document.querySelector('.checkIn').style.display = "none";
        //     document.querySelector('.checkOut').style.display = "flex";
        // });

        // document.querySelector('.checkOut').addEventListener('submit', (e) => {
        //     document.querySelector('.checkIn').style.display = "flex";
        //     document.querySelector('.checkOut').style.display = "none";
        // });
    </script>
</body>

</html>
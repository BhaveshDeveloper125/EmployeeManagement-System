<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: #f0f2f5;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .admin_panel {
            height: 100vh;
            width: 20vw;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            transition: all 0.5s ease;
            overflow: hidden;
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

        .panel_ul {
            list-style: none;
            padding: 20px 0;
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

        .panel_ul li:hover img {
            filter: brightness(1) invert(0);
        }

        .panel_ul li img {
            height: 32px;
            width: 32px;
            filter: brightness(0) invert(1);
            transition: all 0.3s ease;

            &:hover {
                filter: brightness(1) invert(0);
            }
        }

        .panel_ul li span {
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            padding-left: 15px;
            opacity: 0.9;
            transition: all 0.3s ease;
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

        .admin_panel .three_line_container:hover .three_line:nth-child(1) {
            transform: translateY(-2px);
        }

        .admin_panel .three_line_container:hover .three_line:nth-child(3) {
            transform: translateY(2px);
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
    </style>
</head>

<body>
    <div style="display: flex;">
        <div class="admin_panel2" id="panel">
            <button class="three_line_container" onclick="ExpandMenu()">
                <div class="three_line"></div>
                <div class="three_line"></div>
                <div class="three_line"></div>
            </button>

            <ul class="panel_ul">
                <a href="/adminPanel/records">
                    <li>
                        <img src="{{ URL('Images/directory.png') }}" alt="Records">
                        <span>Records</span>
                    </li>
                </a>
                <a href="/adminPanel/generate_user">
                    <li>
                        <img src="{{ URL('Images/working.png') }}" alt="Generate User">
                        <span>Generate User</span>
                    </li>
                </a>
                <a href="/adminPanel/downloadData">
                    <li>
                        <img src="{{ URL('Images/download.png') }}" alt="Download Data">
                        <span>Download Data</span>
                    </li>
                </a>
                <a href="/adminPanel/search_user">
                    <li>
                        <img src="{{ URL('Images/cv.png') }}" alt="Search User">
                        <span>Search User</span>
                    </li>
                </a>
                <a href="/adminPanel/holiday">
                    <li>
                        <img src="{{ URL('Images/cv.png') }}" alt="Search User">
                        <span>Holiday Settings</span>
                    </li>
                </a>
            </ul>
        </div>

        <div style="flex: 1;">
            <br><br>
            <div class="cardcontainer">
                <div class="cards">
                    <h1>Total Employees</h1>
                    <h1>{{ $userData }}</h1>
                </div>
                <div class="cards">
                    <h1>Late Today</h1>
                    <h1>{{ $lateEmp }}</h1>
                </div>
                <div class="cards">
                    <h1>Present Today</h1>
                    <h1>{{ $presentToday }}</h1>
                </div>
                <div class="cards">
                    <h1>Leave Today</h1>
                    <h1>{{ $leaveToday }}</h1>
                </div>
                <div class="cards">
                    <h1>Absent Today</h1>
                    <h1>{{ $absent }}</h1>
                </div>
                <div class="cards">
                    <h1>Early Leave Today</h1>
                    <h1>{{ $earlyLeave }}</h1>
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
</body>

</html>
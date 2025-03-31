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
        <div class="admin_panel2" id="panel">
            <button class="three_line_container" onclick="ExpandMenu()">
                <div class="three_line"></div>
                <div class="three_line"></div>
                <div class="three_line"></div>
            </button>

            <ul class="panel_ul">
                <a href="/records">
                    <li>
                        <img src="{{ URL('Images/directory.png') }}" alt="Records">
                        <span>Records</span>
                    </li>
                </a>
                <a href="generate_user">
                    <li>
                        <img src="{{ URL('Images/working.png') }}" alt="Generate User">
                        <span>Generate User</span>
                    </li>
                </a>
                <li style="background-color: gray;">
                    <img src="{{ URL('Images/download.png') }}" alt="Download Data">
                    <span>Download Data</span>
                </li>
                <a href="search_user">
                    <li>
                        <img src="{{ URL('Images/cv.png') }}" alt="Search User">
                        <span>Search User</span>
                    </li>
                </a>
            </ul>
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
</body>

</html>
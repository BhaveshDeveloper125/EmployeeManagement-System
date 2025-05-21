<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
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
            --table-highlight: rgba(228, 58, 25, 0.1);
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--deep-black);
            margin: 0;
            padding: 40px 20px;
            min-height: 100vh;
            box-sizing: border-box;
        }

        /* Main Container */
        .dashboard-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header Section */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .dashboard-title {
            color: var(--navy-blue);
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            position: relative;
            padding-bottom: 10px;
        }

        .dashboard-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--gradient-accent);
            border-radius: 2px;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--soft-white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border-top: 4px solid var(--navy-blue);
        }

        .stat-card:nth-child(2) {
            border-top-color: var(--vibrant-red);
        }

        .stat-card:nth-child(3) {
            border-top-color: var(--success-green);
        }

        .stat-card:nth-child(4) {
            border-top-color: var(--gold-accent);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(17, 31, 77, 0.15);
        }

        .stat-card h3 {
            color: var(--navy-blue);
            margin: 0 0 10px 0;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card .value {
            font-size: 32px;
            font-weight: 700;
            margin: 10px 0;
            color: var(--navy-blue);
        }

        .stat-card:nth-child(2) .value {
            color: var(--vibrant-red);
        }

        .stat-card:nth-child(3) .value {
            color: var(--success-green);
        }

        .stat-card:nth-child(4) .value {
            color: var(--gold-accent);
        }

        .stat-card .icon {
            position: absolute;
            right: 20px;
            top: 20px;
            opacity: 0.1;
            font-size: 60px;
        }

        /* Main Content */
        .attendance-container {
            background: var(--soft-white);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        .attendance-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--navy-blue), var(--vibrant-red), var(--gold-accent));
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-title {
            color: var(--navy-blue);
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        /* Table Styling */
        .table-responsive {
            overflow-x: auto;
            margin-top: 20px;
            border-radius: 12px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 15px;
            min-width: 800px;
        }

        thead {
            position: sticky;
            top: 0;
            z-index: 10;
        }

        th {
            background-color: var(--navy-blue);
            color: var(--soft-white);
            padding: 16px 12px;
            text-align: center;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
        }

        th:first-child {
            border-top-left-radius: 8px;
        }

        th:last-child {
            border-top-right-radius: 8px;
        }

        td {
            padding: 14px 12px;
            text-align: center;
            border-bottom: 1px solid var(--light-gray);
            transition: var(--transition);
        }

        tr:nth-child(even) {
            background-color: rgba(242, 244, 247, 0.5);
        }

        tr:hover {
            background-color: var(--light-blue);
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Status Indicators */
        .status-working {
            color: var(--vibrant-red);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-working::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--vibrant-red);
            border-radius: 50%;
            display: inline-block;
        }

        .status-completed {
            color: var(--success-green);
            font-weight: 600;
        }

        .day-weekend {
            color: var(--vibrant-red);
            font-weight: 600;
        }

        .hours {
            font-weight: 600;
            color: var(--navy-blue);
        }

        /* Back Button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--navy-blue);
            color: var(--soft-white);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            margin-top: 30px;
            transition: var(--transition);
        }

        .back-btn:hover {
            background: var(--dark-navy);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(17, 31, 77, 0.2);
        }

        .back-btn svg {
            transition: var(--transition);
        }

        .back-btn:hover svg {
            transform: translateX(-4px);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 15px;
            }

            .dashboard-title {
                font-size: 24px;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .attendance-container {
                padding: 20px;
            }

            th,
            td {
                padding: 12px 8px;
                font-size: 14px;
            }

            .section-title {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .dashboard-title {
                font-size: 22px;
            }

            .stat-card {
                padding: 20px;
            }

            .stat-card .value {
                font-size: 28px;
            }
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            height: 8px;
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-gray);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--navy-blue);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--vibrant-red);
        }

        /* Loading Animation */
        @keyframes pulse {
            0% {
                opacity: 0.6;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.6;
            }
        }

        .loading-placeholder {
            animation: pulse 1.5s infinite;
            background: var(--light-gray);
            border-radius: 4px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Employee Attendance</h1>
            <div class="user-info">
                <!-- Add user info/avatar if needed -->
            </div>
        </div>

        <!-- <div class="stats-container">
            <div class="stat-card">
                <h3>Total Days</h3>
                <div class="value">{{ count($data) }}</div>
                <div class="icon material-symbols-outlined">calendar_month</div>
            </div>
            <div class="stat-card">
                <h3>Working Days</h3>
                <div class="value">{{ $data->filter(fn($i) => !in_array(\Carbon\Carbon::parse($i->entry)->format('D'), ['Sat', 'Sun']))->count() }}</div>
                <div class="icon material-symbols-outlined">work</div>
            </div>
            <div class="stat-card">
                <h3>Completed Days</h3>
                <div class="value">{{ $data->filter(fn($i) => $i->leave)->count() }}</div>
                <div class="icon material-symbols-outlined">check_circle</div>
            </div>
            <div class="stat-card">
                <h3>Avg. Hours</h3>
                <div class="value">
                    @php
                    $totalSeconds = $data->filter(fn($i) => $i->entry && $i->leave)
                    ->sum(fn($i) => \Carbon\Carbon::parse($i->entry)->diffInSeconds(\Carbon\Carbon::parse($i->leave)));
                    $avgHours = $totalSeconds > 0 ? gmdate('H:i', $totalSeconds / $data->filter(fn($i) => $i->entry && $i->leave)->count()) : '00:00';
                    @endphp
                    {{ $avgHours }}
                </div>
                <div class="icon material-symbols-outlined">schedule</div>
            </div>
        </div> -->

        <div class="attendance-container">
            <div class="section-header">
                <h2 class="section-title">Detailed Attendance Records</h2>
                <div class="date-range">
                </div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Sr no</th>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Working Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($i->entry)->format('d M Y') }}</td>
                            <td class="{{ in_array(\Carbon\Carbon::parse($i->entry)->format('D'), ['Sat', 'Sun']) ? 'day-weekend' : '' }}">
                                {{ \Carbon\Carbon::parse($i->entry)->format('D') }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($i->entry)->format('h:i A') }}</td>
                            <td>
                                @if($i->leave)
                                {{ \Carbon\Carbon::parse($i->leave)->format('h:i A') }}
                                @else
                                <span class="status-working">Working</span>
                                @endif
                            </td>
                            <td class="hours">
                                @if($i->entry && $i->leave)
                                {{ \Carbon\Carbon::parse($i->entry)->diff(\Carbon\Carbon::parse($i->leave))->format('%Hh %Im') }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a href="/homepage/{{ Auth::id() }}" class="back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Back to Dashboard
            </a>
        </div>
    </div>
</body>

</html>
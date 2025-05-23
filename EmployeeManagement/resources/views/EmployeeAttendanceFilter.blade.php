<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance Dashboard</title>
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
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-gray);
            color: var(--dark-navy);
            margin: 0;
            padding: 20px;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            color: var(--navy-blue);
            font-size: 28px;
            font-weight: 700;
            position: relative;
            padding-left: 15px;
        }

        .page-title:before {
            content: "";
            position: absolute;
            left: 0;
            top: 5px;
            height: 80%;
            width: 5px;
            background: var(--gold-accent);
            border-radius: 3px;
        }

        .filter-container {
            background: var(--soft-white);
            border-radius: 8px;
            padding: 15px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
        }

        .filter-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--light-blue);
            border-radius: 6px;
            background-color: var(--soft-white);
            color: var(--navy-blue);
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--navy-blue);
            box-shadow: 0 0 0 3px rgba(17, 31, 77, 0.1);
        }

        .filter-options {
            display: none;
            position: absolute;
            background: var(--soft-white);
            width: 100%;
            box-shadow: var(--card-shadow);
            border-radius: 6px;
            z-index: 10;
            margin-top: 5px;
        }

        .filter-option {
            padding: 12px 15px;
            color: var(--navy-blue);
            text-decoration: none;
            display: block;
            transition: var(--transition);
        }

        .filter-option:hover {
            background: var(--light-blue);
            color: var(--vibrant-red);
        }

        .report-card {
            background: var(--soft-white);
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .card-header {
            background: linear-gradient(135deg, var(--navy-blue), var(--dark-navy));
            color: var(--soft-white);
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
        }

        .employee-profile {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            gap: 20px;
            border-bottom: 1px solid rgba(2, 2, 5, 0.1);
        }

        .profile-section {
            flex: 1;
            min-width: 250px;
        }

        .profile-title {
            color: var(--navy-blue);
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .profile-title svg {
            margin-right: 10px;
            color: var(--gold-accent);
        }

        .detail-row {
            display: flex;
            margin-bottom: 10px;
        }

        .detail-label {
            font-weight: 600;
            color: var(--navy-blue);
            width: 120px;
        }

        .detail-value {
            color: var(--deep-black);
            flex: 1;
        }

        .time-range-card {
            background: var(--light-blue);
            border-radius: 8px;
            padding: 15px;
            min-width: 250px;
        }

        .time-range-title {
            margin-top: 0;
            margin-bottom: 15px;
            color: var(--navy-blue);
            font-size: 16px;
            font-weight: 600;
        }

        .time-display {
            display: flex;
            justify-content: space-between;
        }

        .time-box {
            text-align: center;
            flex: 1;
        }

        .time-label {
            font-size: 14px;
            color: var(--navy-blue);
            font-weight: 500;
        }

        .time-value {
            font-size: 18px;
            font-weight: 600;
            color: var(--vibrant-red);
            margin-top: 5px;
        }

        .attendance-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .attendance-table thead th {
            background: var(--navy-blue);
            color: var(--soft-white);
            padding: 15px;
            text-align: left;
            font-weight: 500;
        }

        .attendance-table thead th:first-child {
            border-top-left-radius: 8px;
        }

        .attendance-table thead th:last-child {
            border-top-right-radius: 8px;
        }

        .attendance-table tbody tr {
            transition: var(--transition);
        }

        .attendance-table tbody tr:nth-child(even) {
            background: var(--light-gray);
        }

        .attendance-table tbody tr:nth-child(odd) {
            background: var(--soft-white);
        }

        .attendance-table tbody tr:hover {
            background: var(--light-blue);
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }

        .attendance-table td {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(2, 2, 5, 0.05);
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            min-width: 100px;
            text-align: center;
        }

        .status-late {
            background-color: rgba(228, 58, 25, 0.1);
            color: var(--vibrant-red);
            border: 1px solid rgba(228, 58, 25, 0.3);
        }

        .status-early {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .status-overtime {
            background-color: rgba(255, 215, 0, 0.2);
            color: #B8860B;
            border: 1px solid rgba(255, 215, 0, 0.4);
        }

        .status-absent {
            background-color: rgba(228, 58, 25, 0.1);
            color: var(--vibrant-red);
            border: 1px solid rgba(228, 58, 25, 0.3);
        }

        .status-working {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .error-message {
            text-align: center;
            padding: 40px;
            background: var(--soft-white);
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            color: var(--vibrant-red);
            font-size: 18px;
            font-weight: 500;
        }

        .report-footer {
            text-align: center;
            padding: 20px;
            color: var(--navy-blue);
            font-size: 14px;
            border-top: 1px solid rgba(2, 2, 5, 0.1);
        }

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .employee-profile {
                flex-direction: column;
            }

            .time-range-card {
                width: 100%;
            }

            .attendance-table thead {
                display: none;
            }

            .attendance-table tbody tr {
                display: block;
                margin-bottom: 15px;
                border-radius: 8px;
                box-shadow: var(--card-shadow);
            }

            .attendance-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 15px;
            }

            .attendance-table td:before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--navy-blue);
                margin-right: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="page-title">Employee Attendance Dashboard</h1>
        </div>

        <div class="filter-container">
            <select class="filter-select" onchange="window.location.href=this.value">
                <option value="">Select Filter</option>
                <option value="/empfilter/attend">Attendance</option>
                <option value="/empfilter/late">Late Attendance</option>
                <option value="/empfilter/absent">Absent</option>
                <option value="/empfilter/early">Early Leave</option>
                <option value="/empfilter/overtime">Over Time</option>
            </select>
        </div>

        @if(isset($attend) && isset($user) && isset($extra) && isset($time))
        <div class="report-card">
            <div class="card-header">
                Employee Attendance Details
            </div>

            <div class="employee-profile">
                <div class="profile-section">
                    <h3 class="profile-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Personal Information
                    </h3>
                    <div class="detail-row">
                        <span class="detail-label">Name:</span>
                        <span class="detail-value">{{ $user->name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email:</span>
                        <span class="detail-value">{{ $user->email }}</span>
                    </div>
                    @foreach ($extra as $i)
                    <div class="detail-row">
                        <span class="detail-label">Position:</span>
                        <span class="detail-value">{{ $i->post }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Mobile:</span>
                        <span class="detail-value">{{ $i->mobile }}</span>
                    </div>
                    @endforeach
                </div>

                <div class="profile-section">
                    <h3 class="profile-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        Additional Information
                    </h3>
                    @foreach ($extra as $i)
                    <div class="detail-row">
                        <span class="detail-label">Address:</span>
                        <span class="detail-value">{{ $i->address }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Qualification:</span>
                        <span class="detail-value">{{ $i->qualificatio }}</span>
                    </div>
                    @endforeach
                </div>

                <div class="time-range-card">
                    <h3 class="time-range-title">Working Hours</h3>
                    <div class="time-display">
                        <div class="time-box">
                            <div class="time-label">From</div>
                            <div class="time-value">{{ $time->from }}</div>
                        </div>
                        <div class="time-box">
                            <div class="time-label">To</div>
                            <div class="time-value">{{ $time->to }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="overflow-x: auto; padding: 20px;">
                <table class="attendance-table">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Entry Time</th>
                            <th>Leave Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attend as $i)
                        <tr>
                            <td data-label="Sr No">{{ $loop->iteration }}</td>
                            <td data-label="Entry Time">{{ $i->entry }}</td>
                            <td data-label="Leave Time">{{ $i->leave }}</td>
                            <td data-label="Status">
                                @if ($i->entry > $time->from)
                                <span class="status-badge status-late">Late Arrival</span>
                                @endif

                                @if ($i->entry < $time->from)
                                    <span class="status-badge status-early">Early Start</span>
                                    @endif

                                    @if ($i->leave < $time->to)
                                        <span class="status-badge status-late">Early Leave</span>
                                        @endif

                                        @if ($i->leave > $time->to)
                                        <span class="status-badge status-overtime">Over Time</span>
                                        @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @elseif(isset($late))
        <div class="report-card">
            <div class="card-header">
                Late Attendance of Current Month
            </div>
            <div style="overflow-x: auto; padding: 20px;">
                <table class="attendance-table">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Date</th>
                            <th>Entry Time</th>
                            <th>Leave Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($late as $i)
                        <tr>
                            <td data-label="Sr No">{{ $loop->iteration }}</td>
                            <td data-label="Date">{{ Carbon\Carbon::parse($i->entry)->format('d-m-y') }}</td>
                            <td data-label="Entry Time">{{ Carbon\Carbon::parse($i->entry)->format('h:i A') }}</td>
                            <td data-label="Leave Time">
                                {{ $i->leave ? Carbon\Carbon::parse($i->leave)->format('h:i A') : '--' }}
                            </td>
                            <td data-label="Status">
                                <span class="status-badge status-late">Late</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @elseif(isset($early))
        <div class="report-card">
            <div class="card-header">
                Early Leave of This Month
            </div>
            <div style="overflow-x: auto; padding: 20px;">
                <table class="attendance-table">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Date</th>
                            <th>Entry Time</th>
                            <th>Leave Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($early as $i)
                        <tr>
                            <td data-label="Sr No">{{ $loop->iteration }}</td>
                            <td data-label="Date">{{ Carbon\Carbon::parse($i->entry)->format('d-m-y') }}</td>
                            <td data-label="Entry Time">{{ Carbon\Carbon::parse($i->entry)->format('h:i A') }}</td>
                            <td data-label="Leave Time">{{ Carbon\Carbon::parse($i->leave)->format('h:i A') }}</td>
                            <td data-label="Status">
                                <span class="status-badge status-late">Early Leave</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @elseif(isset($absent))
        <div class="report-card">
            <div class="card-header">
                Absent Records
            </div>
            <div style="overflow-x: auto; padding: 20px;">
                <table class="attendance-table">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absent as $i)
                        <?php [$date, $day] = explode(',', $i) ?>
                        <tr>
                            <td data-label="Sr No">{{ $loop->iteration }}</td>
                            <td data-label="Date">{{ $date }}</td>
                            <td data-label="Day">{{ $day }}</td>
                            <td data-label="Status">
                                <span class="status-badge status-absent">Absent</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @elseif(isset($overtime))
        <div class="report-card">
            <div class="card-header">
                Overtime Records
            </div>
            <div style="overflow-x: auto; padding: 20px;">
                <table class="attendance-table">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Date</th>
                            <th>Entry Time</th>
                            <th>Leave Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($overtime as $i)
                        <tr>
                            <td data-label="Sr No">{{ $loop->iteration }}</td>
                            <td data-label="Date">{{ Carbon\Carbon::parse($i->leave)->format('d-m-y') }}</td>
                            <td data-label="Entry Time">{{ Carbon\Carbon::parse($i->entry)->format('h:i A') }}</td>
                            <td data-label="Leave Time">{{ Carbon\Carbon::parse($i->leave)->format('h:i A') }}</td>
                            <td data-label="Status">
                                <span class="status-badge status-overtime">Over Time</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @else
        <div class="report-card">
            <div class="error-message">
                {{ $message ?? 'No attendance data available' }}
            </div>
        </div>
        @endif

        <div class="report-footer">
            Report generated on {{ now()->day }} - {{ now()->month }}- {{ now()->year }}
        </div>
    </div>
</body>

</html>
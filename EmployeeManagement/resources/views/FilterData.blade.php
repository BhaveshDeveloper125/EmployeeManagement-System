<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance Records</title>
    <style>
        :root {
            --navy-blue: #111F4D;
            --light-gray: #F2F4F7;
            --vibrant-red: #E43A19;
            --deep-black: #020205;
            --gold-accent: #FFD700;
            --soft-white: #FFFFFF;
            --table-highlight: rgba(228, 58, 25, 0.1);
            --platinum: #E5E4E2;
            --silver: #C0C0C0;
            --dark-navy: #0A142F;
            --light-blue: #E6F0FF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: var(--dark-navy);
        }

        .filterationcontainer {
            display: flex;
            min-height: 100vh;
        }

        .content-area {
            flex: 1;
            padding: 2rem;
            background-color: var(--soft-white);
            border-radius: 8px 0 0 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .filter-section {
            background-color: var(--navy-blue);
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .filter-form {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .filter-form input[type="date"] {
            padding: 0.75rem;
            border: 2px solid var(--platinum);
            border-radius: 6px;
            background-color: var(--soft-white);
            font-size: 1rem;
            color: var(--dark-navy);
        }

        .filter-form input[type="submit"] {
            padding: 0.75rem 1.5rem;
            background-color: var(--vibrant-red);
            color: var(--soft-white);
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-form input[type="submit"]:hover {
            background-color: #c53216;
            transform: translateY(-2px);
        }

        .employee-profile {
            background: linear-gradient(135deg, var(--navy-blue), var(--dark-navy));
            color: var(--soft-white);
            padding: 2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }

        .employee-profile::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background-color: rgba(255, 215, 0, 0.1);
            border-radius: 50%;
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .employee-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--gold-accent);
        }

        .employee-email {
            font-size: 1rem;
            opacity: 0.9;
        }

        .profile-details {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .detail-item {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 6px;
            backdrop-filter: blur(5px);
        }

        .detail-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            color: var(--silver);
        }

        .detail-value {
            font-size: 1.1rem;
            font-weight: 500;
        }

        .attendance-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 2rem;
            background-color: var(--soft-white);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .attendance-table th {
            background-color: var(--navy-blue);
            color: var(--soft-white);
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .attendance-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--platinum);
        }

        .attendance-table tr:last-child td {
            border-bottom: none;
        }

        .attendance-table tr:hover {
            background-color: var(--table-highlight);
        }

        .pagination {
            height: 40px;
            background-color: red;
            display: flex;
            justify-content: center;
            /* margin-top: 2rem; */
            overflow: hidden;
        }

        .pagination a {
            color: var(--navy-blue);
            /* padding: 0.5rem 1rem; */
            overflow: hidden;
            text-decoration: none;
            border: 1px solid var(--platinum);
            /* margin: 0 0.25rem; */
            padding: 4px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background-color: var(--navy-blue);
            color: var(--soft-white);
            border-color: var(--navy-blue);
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--silver);
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .content-area {
                margin-left: 0;
                padding: 1rem;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .profile-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="filterationcontainer">
        <x-menu />
        <div class="content-area">
            <div class="filter-section">
                <form class="filter-form" action="/emp_attendance_records/{{ $attendances->extraUserData[0]->user_id ?? '' }}" method="post">
                    @csrf
                    <div style="display: flex; gap: 1rem; width: 100%;">
                        <input type="date" name="from" id="from" required>
                        <input type="date" name="to" id="to" required>
                        <input type="submit" value="Filter Records">
                    </div>
                </form>
            </div>

            @if ($attendances)
            <div class="employee-profile">
                <div class="profile-header">
                    <div>
                        <h1 class="employee-name">{{ $attendances->name }}</h1>
                        <p class="employee-email">{{ $attendances->email }}</p>
                    </div>
                </div>

                <div class="profile-details">
                    @foreach ($attendances->extraUserData as $i)
                    <div class="detail-item">
                        <div class="detail-label">Position</div>
                        <div class="detail-value">{{ $i->post }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Mobile</div>
                        <div class="detail-value">{{ $i->mobile }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Address</div>
                        <div class="detail-value">{{ $i->address }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Qualification</div>
                        <div class="detail-value">{{ $i->qualificatio }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Experience</div>
                        <div class="detail-value">{{ $i->exp }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Joining Date</div>
                        <div class="detail-value">{{ $i->joining_date }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Leaves</div>
                        <div class="detail-value">{{ $i->leaves }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <table class="attendance-table">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Date</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($record as $i)
                    <tr>
                        <td>{{ $i->user_id }}</td>
                        <td>{{ date('M d, Y', strtotime($i->entry)) }}</td>
                        <td>{{ date('h:i A', strtotime($i->entry)) }}</td>
                        <td>{{ $i->leave ? date('h:i A', strtotime($i->leave)) : '--' }}</td>
                        <td>
                            @if($i->leave)
                            <span style="color: green;">Present</span>
                            @else
                            <span style="color: var(--vibrant-red);">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            No attendance records found for the selected period
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($record->isNotEmpty())
            <!-- <div class="pagination"> -->
            {{ $record->links() }}
            <!-- </div> -->
            @endif
        </div>
    </div>

</body>

</html>
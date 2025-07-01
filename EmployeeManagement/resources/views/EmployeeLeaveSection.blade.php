<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Employee Leaves Dashboard</title>
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

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-gray);
            color: var(--deep-black);
            margin: 0;
            display: flex;
            /* padding: 20px; */
        }

        .container {
            display: flex;
            flex-direction: column;
            flex: 1;
            max-width: 1400px;
            margin: 0 auto;
        }

        .notification-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 30px;
        }

        .notification-bell {
            color: var(--navy-blue);
            font-size: 1.5rem;
            cursor: pointer;
            transition: transform 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .notification-bell:hover {
            transform: scale(1.1);
            text-decoration: none;
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--vibrant-red);
            color: white;
            border-radius: 50%;
            padding: 3px 6px;
            font-size: 0.7rem;
        }

        .dropdown-menu {
            position: absolute;
            right: 10;
            background-color: var(--soft-white);
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 350px;
            z-index: 1000;
            padding: 0;
            overflow: hidden;
            display: none;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-header {
            background-color: var(--navy-blue);
            color: white;
            padding: 12px 15px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropdown-item {
            padding: 12px 15px;
            border-bottom: 1px solid var(--light-gray);
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: var(--light-gray);
        }

        .mark-all-btn {
            background-color: var(--gold-accent);
            color: var(--navy-blue);
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .mark-all-btn:hover {
            background-color: var(--navy-blue);
            color: var(--gold-accent);
        }

        h1 {
            color: var(--navy-blue);
            border-bottom: 2px solid var(--gold-accent);
            padding-bottom: 8px;
            margin-top: 30px;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background-color: var(--navy-blue);
            color: var(--soft-white);
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--light-gray);
        }

        tr:nth-child(even) {
            background-color: var(--light-gray);
        }

        tr:hover {
            background-color: var(--table-highlight);
        }

        .action-btn {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            color: white;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 0.9rem;
            min-width: 70px;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        .approve-btn {
            background-color: #28a745;
        }

        .approve-btn:hover {
            background-color: #218838;
            transform: translateY(-1px);
        }

        .reject-btn {
            background-color: var(--vibrant-red);
        }

        .reject-btn:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }

        .pending,
        .approved,
        .rejected {
            background-color: var(--soft-white);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-top: 30px;
            overflow: auto;
        }

        .empty-message {
            text-align: center;
            color: #6c757d;
            padding: 20px;
            font-style: italic;
        }

        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    <x-menu />
    <div class="container">
        <!-- Notification Dropdown -->
        <div class="notification-wrapper">
            <a href="#" class="notification-bell" id="notificationDropdown" role="button">
                <i class="fas fa-bell"></i>
                @if (auth()->user()->unreadNotifications->count() > 0)
                <span class="badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                @endif
            </a>
            <div class="dropdown-menu" id="dropdownMenu">
                <div class="dropdown-header">
                    <span>Notifications</span>
                    @if (auth()->user()->unreadNotifications->count() > 0)
                    <a href="/mark_as_read" class="mark-all-btn">Mark All as Read</a>
                    @endif
                </div>
                @if (auth()->user()->unreadNotifications->count() > 0)
                @foreach (auth()->user()->unreadNotifications as $notification)
                <div class="dropdown-item">
                    <div>{{ $notification->data['message'] }}</div>
                    <small style="color: #6c757d;">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                @endforeach
                @else
                <div class="dropdown-item">No new notifications</div>
                @endif
            </div>
        </div>

        <!-- Pending Leave Requests -->
        <div class="pending">
            <h1><i class="fas fa-clock"></i> Pending Leave Requests</h1>
            @if($pending->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Days</th>
                        <th>Duration</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Reason</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pending as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $i->department }}</td>
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->type == 'casual_leave' ? "Casual Leave" : "Medical Leave"}}</td>
                        <td>{{ Carbon\Carbon::parse($i->from)->diffInDays($i->to) }}</td>
                        <td>{{ $i->duration == 'full_day' ? "Full Day" : "Half Day" }}</td>
                        <td>{{ Carbon\Carbon::parse($i->from)->format('d M y') }}</td>
                        <td>{{ Carbon\Carbon::parse($i->to)->format('d M y') }}</td>
                        <td>{{ $i->reason }}</td>
                        <td style="display: flex; gap: 5px;">
                            <a href="reject/{{ $i->id }}" class="action-btn reject-btn">Reject</a>
                            <a href="approve/{{ $i->id }}" class="action-btn approve-btn">Approve</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-message">
                <i class="fas fa-check-circle" style="font-size: 2rem; color: #28a745; margin-bottom: 10px;"></i>
                <p>No pending leave requests</p>
            </div>
            @endif
        </div>

        <!-- Approved Leaves -->
        <div class="approved">
            <h1><i class="fas fa-check-circle"></i> Approved Leaves</h1>
            @if($approval->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Days</th>
                        <th>Duration</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Reason</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($approval as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $i->department }}</td>
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->type }}</td>
                        <td>{{ Carbon\Carbon::parse($i->from)->diffInDays($i->to) }}</td>
                        <td>{{ $i->duration == 'full_day' ? "Full Day" : "Half Day" }}</td>
                        <td>{{ Carbon\Carbon::parse($i->from)->format('d M y') }}</td>
                        <td>{{ Carbon\Carbon::parse($i->to)->format('d M y') }}</td>
                        <td>{{ $i->reason }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-message">
                <i class="fas fa-check-circle" style="font-size: 2rem; color: #28a745; margin-bottom: 10px;"></i>
                <p>No approved leave records</p>
            </div>
            @endif
        </div>

        <!-- Rejected Leaves -->
        <div class="rejected">
            <h1><i class="fas fa-times-circle"></i> Rejected Leaves</h1>
            @if($rejection->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Days</th>
                        <th>Duration</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Reason</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rejection as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $i->department }}</td>
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->type }}</td>
                        <td>{{ Carbon\Carbon::parse($i->from)->diffInDays($i->to) }}</td>
                        <td>{{ $i->duration == 'full_day' ? "Full Day" : "Half Day" }}</td>
                        <td>{{ Carbon\Carbon::parse($i->from)->format('d M y') }}</td>
                        <td>{{ Carbon\Carbon::parse($i->to)->format('d M y') }}</td>
                        <td>{{ $i->reason }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-message">
                <i class="fas fa-check-circle" style="font-size: 2rem; color: #28a745; margin-bottom: 10px;"></i>
                <p>No rejected leave records</p>
            </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bell = document.getElementById('notificationDropdown');
            const dropdown = document.getElementById('dropdownMenu');

            bell.addEventListener('click', function(e) {
                e.preventDefault();
                dropdown.classList.toggle('show');
            });

            document.addEventListener('click', function(e) {
                if (!bell.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.remove('show');
                }
            });
        });
    </script>
</body>

</html>
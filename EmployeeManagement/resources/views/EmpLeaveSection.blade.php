<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <title>Leave Management</title>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: var(--navy-blue);
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: var(--navy-blue);
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--vibrant-red);
            border-radius: 2px;
        }

        .form-container {
            background: var(--soft-white);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 40px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--navy-blue);
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--navy-blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(17, 31, 77, 0.2);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .submit-btn {
            grid-column: 1 / -1;
            background-color: var(--vibrant-red);
            color: white;
            border: none;
            padding: 15px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-btn:hover {
            background-color: #c33116;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(228, 58, 25, 0.3);
        }

        .leaves-table {
            background: var(--soft-white);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: var(--navy-blue);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: rgba(242, 244, 247, 0.5);
        }

        tr:hover {
            background-color: var(--table-highlight);
        }

        .status-pending {
            color: #FFA500;
            font-weight: 600;
        }

        .status-approved {
            color: #28a745;
            font-weight: 600;
        }

        .status-rejected {
            color: var(--vibrant-red);
            font-weight: 600;
        }

        .empty-message {
            text-align: center;
            padding: 30px;
            color: #666;
            font-style: italic;
        }

        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }

            .form-container,
            .leaves-table {
                padding: 20px;
            }

            th,
            td {
                padding: 10px;
                font-size: 14px;
            }
        }

        /* Notification styles */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 6px;
            color: white;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transform: translateX(200%);
            transition: transform 0.3s ease-out;
        }

        .notification.show {
            transform: translateX(0);
        }

        .success {
            background-color: #28a745;
        }

        .error {
            background-color: var(--vibrant-red);
        }

        .status-rejected {
            color: #dc2626;
            /* Red-600 */
            font-weight: bold;
        }

        .status-approved {
            color: #16a34a;
            /* Green-600 */
            font-weight: bold;
        }

        .status-pending {
            color: #ca8a04;
            /* Yellow-600 */
            font-weight: bold;
        }

        #toast-container>.toast {
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Leave Management System</h1>

        <div class="form-container">
            <form action="/ask_leave" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="department">Department</label>
                    <input type="text" name="department" id="department" placeholder="Enter your department" required>
                </div>

                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <div class="form-group">
                    <label for="type">Leave Type</label>
                    <select name="type" id="type" required>
                        <option value="" disabled selected>Select leave type</option>
                        <option value="medical_leave">Medical Leave</option>
                        <option value="casual_leave">Casual Leave</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="duration">Duration Type</label>
                    <select name="duration" id="duration" required>
                        <option value="" disabled selected>Select duration</option>
                        <option value="half_day">Half Day</option>
                        <option value="full_day">Full Day</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="from">From Date</label>
                    <input type="date" name="from" id="from" required>
                </div>

                <div class="form-group">
                    <label for="to">To Date</label>
                    <input type="date" name="to" id="to" required>
                </div>

                <div class="form-group full-width">
                    <label for="reason">Reason for Leave</label>
                    <textarea name="reason" id="reason" placeholder="Please explain the reason for your leave" required></textarea>
                </div>

                <button type="submit" class="submit-btn">Submit Leave Request</button>
            </form>
        </div>

        <div class="leaves-table">
            <h2>Total Leave in this Month</h2>
            <table>
                <thead>
                    <tr>
                        <th>Index No</th>
                        <th>Name</th>
                        <th>Leave Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Days</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Reason</th>
                        <th>Requested On</th>
                        <th>Action Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($list as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $i->name }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $i->type)) }}</td>
                        <td>{{ date('M d, Y', strtotime($i->from)) }}</td>
                        <td>{{ date('M d, Y', strtotime($i->to)) }}</td>
                        <td>{{ \Carbon\Carbon::parse($i->from)->diffInDays($i->to) + 1 }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $i->duration)) }}</td>
                        <!-- <td class="status-{{ $i->status }}">{{ ucfirst($i->status) }}</td> -->
                        <td class="@if($i->status == 'Rejected') status-rejected @elseif($i->status == 'Approved') status-approved @else status-pending @endif">
                            {{ ucfirst($i->status) }}
                        </td>
                        <td>{{ Str::limit($i->reason, 30) }}</td>
                        <td>{{ date('M d, Y h:i A', strtotime($i->created_at)) }}</td>
                        <td>
                            @if($i->updated_at == $i->created_at)
                            <span class="status-pending">Pending</span>
                            @else
                            {{ date('M d, Y h:i A', strtotime($i->updated_at)) }}
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="empty-message">No leave records found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- <div id="notification"
        class="notification success">
        Your leave request has been submitted successfully!
    </div> -->
    @if(Session::has('leave_send'))
    <script>
        toastr.options = {
            "timeOut": 4000,
            "extendedTimeOut": 2000,
            "closeButton": true,
            "progressBar": true
        }
        toastr && toastr.success("{{ session('leave_send') }}");
    </script>
    @endif

    @if(session('leave_not_send'))
    <!-- <div id="notification" class="notification error">
        Failed to submit leave request. Please try again.
    </div> -->
    <script>
        toastr.options = {
            "timeOut": 4000,
            "extendedTimeOut": 2000,
            "closeButton": true,
            "progressBar": true
        }
        toastr && toastr.error("{{ session('leave_send') }}");
    </script>
    @endif

    <script>
        // Show notification
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.classList.add('show');

                // Hide after 5 seconds
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 5000);
            }
        });
    </script>
</body>

</html>
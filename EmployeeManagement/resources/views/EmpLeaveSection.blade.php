<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <style>
        :root {
            --navy-blue: #111F4D;
            --light-navy: #1A2A6C;
            --light-gray: #F8FAFC;
            --vibrant-red: #E43A19;
            --soft-red: #FF6B6B;
            --deep-black: #020205;
            --gold-accent: #FFD700;
            --soft-white: #FFFFFF;
            --success-green: #10B981;
            --pending-yellow: #F59E0B;
            --rejected-red: #EF4444;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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
            color: var(--navy-blue);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1,
        h2 {
            color: var(--navy-blue);
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        h1::after,
        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--navy-blue), var(--vibrant-red));
            border-radius: 2px;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-top: 20px;
        }

        h1::after {
            left: 50%;
            transform: translateX(-50%);
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
            text-align: center;
            border-top: 4px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .stat-card.pending {
            border-top-color: var(--pending-yellow);
        }

        .stat-card.approved {
            border-top-color: var(--success-green);
        }

        .stat-card.rejected {
            border-top-color: var(--rejected-red);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-card.pending .stat-value {
            color: var(--pending-yellow);
        }

        .stat-card.approved .stat-value {
            color: var(--success-green);
        }

        .stat-card.rejected .stat-value {
            color: var(--rejected-red);
        }

        .stat-label {
            font-size: 1rem;
            color: var(--navy-blue);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-icon {
            font-size: 2rem;
            opacity: 0.1;
            position: absolute;
            right: 20px;
            top: 20px;
        }

        /* Form Container */
        .form-container {
            background: var(--soft-white);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 40px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--navy-blue), var(--vibrant-red), var(--gold-accent));
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: var(--navy-blue);
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #E2E8F0;
            border-radius: 8px;
            font-size: 16px;
            transition: var(--transition);
            background-color: var(--light-gray);
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--navy-blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(17, 31, 77, 0.1);
            background-color: var(--soft-white);
        }

        textarea {
            min-height: 140px;
            resize: vertical;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .submit-btn {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, var(--navy-blue), var(--light-navy));
            color: white;
            border: none;
            padding: 16px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, var(--light-navy), var(--navy-blue));
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(17, 31, 77, 0.2);
        }

        /* Table Styles */
        .leaves-table {
            background: var(--soft-white);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 30px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .leaves-table::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--navy-blue), var(--vibrant-red), var(--gold-accent));
        }

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
            min-width: 1000px;
        }

        thead {
            position: sticky;
            top: 0;
            z-index: 10;
        }

        th {
            background-color: var(--navy-blue);
            color: white;
            padding: 16px 12px;
            text-align: left;
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
            text-align: left;
            border-bottom: 1px solid #E2E8F0;
            transition: var(--transition);
        }

        tr:nth-child(even) {
            background-color: rgba(242, 244, 247, 0.5);
        }

        tr:hover {
            background-color: rgba(230, 240, 255, 0.5);
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            min-width: 80px;
        }

        .status-pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--pending-yellow);
        }

        .status-approved {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
        }

        .status-rejected {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--rejected-red);
        }

        .empty-message {
            text-align: center;
            padding: 40px;
            color: #64748B;
            font-style: italic;
            grid-column: 1 / -1;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            form {
                grid-template-columns: 1fr;
            }

            .stats-container {
                grid-template-columns: repeat(3, 1fr);
            }

            .form-container,
            .leaves-table {
                padding: 25px;
            }
        }

        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 2rem;
            }

            .container {
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            .stat-value {
                font-size: 2rem;
            }

            input,
            select,
            textarea {
                padding: 12px 15px;
            }
        }

        /* Animation */
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

        .form-container,
        .leaves-table,
        .stat-card {
            animation: fadeIn 0.6s ease-out forwards;
        }

        /* Toastr Customization */
        .toast {
            border-radius: 8px !important;
            box-shadow: var(--card-shadow) !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .toast-success {
            background-color: var(--success-green) !important;
        }

        .toast-error {
            background-color: var(--rejected-red) !important;
        }
    </style>
</head>

<body>
    <x-emp-menu />
    <div class="container">
        <h1> </h1>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card approved">
                <div class="stat-label">Remaining Leaves</div>
                <div class="stat-value">{{ $remaining }}</div>
                <i class="fas fa-check-circle stat-icon"></i>
            </div>
            <div class="stat-card pending">
                <div class="stat-label">Pending Leaves</div>
                <div class="stat-value">{{ $pending }}</div>
                <i class="fas fa-clock stat-icon"></i>
            </div>
            <div class="stat-card approved">
                <div class="stat-label">Approved Leaves</div>
                <div class="stat-value">{{ $approved }}</div>
                <i class="fas fa-check-circle stat-icon"></i>
            </div>
            <div class="stat-card rejected">
                <div class="stat-label">Rejected Leaves</div>
                <div class="stat-value">{{ $reject }}</div>
                <i class="fas fa-times-circle stat-icon"></i>
            </div>
        </div>

        <!-- Leave Request Form -->
        <div class="form-container">
            <h2>Request New Leave</h2>
            <form action="/ask_leave" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="department">Department/Position</label>
                    <input type="text" name="department" id="department" placeholder="Finance Department or Manager/HR" required>
                </div>

                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <div class="form-group">
                    <label for="type">Leave Type</label>
                    <select name="type" id="type" required>
                        <option value="" disabled selected>Select leave type</option>
                        <option value="medical_leave">Medical Leave</option>
                        <option value="casual_leave">Casual Leave</option>
                        <!-- <option value="annual_leave">Annual Leave</option>
                        <option value="maternity_leave">Maternity Leave</option>
                        <option value="paternity_leave">Paternity Leave</option> -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="duration">Duration Type</label>
                    <select name="duration" id="duration" required>
                        <option value="" disabled selected>Select duration</option>
                        <option value="half_day">Half Day</option>
                        <option value="full_day">Full Day</option>
                        <!-- <option value="multiple_days">Multiple Days</option> -->
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

                <div class="form-group">
                    <label for="duration">Duration Type</label>
                    <select name="reason" id="duration" required>
                        <option value="" disabled selected>Select duration</option>
                        <option value="Health Issues">Health issues</option>
                        <option value="Casual Leave">Casual Leave</option>
                        <option value="Other Reason">Other Reason</option>
                        <!-- <option value="multiple_days">Multiple Days</option> -->
                    </select>
                </div>

                <!-- <div class="form-group full-width">
                    <label for="reason">Reason for Leave</label>
                    <textarea name="reason" id="reason" placeholder="Please explain the reason for your leave in detail..." required></textarea>
                </div> -->

                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Submit Leave Request
                </button>
            </form>
        </div>

        <!-- Leave History Table -->
        <div class="leaves-table">
            <h2>Your Leave History</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
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
                            <td>
                                <span class="status-badge @if($i->status == 'Rejected') status-rejected @elseif($i->status == 'Approved') status-approved @else status-pending @endif">
                                    {{ ucfirst($i->status) }}
                                </span>
                            </td>
                            <td>{{ Str::limit($i->reason, 30) }}</td>
                            <td>{{ date('M d, Y h:i A', strtotime($i->created_at)) }}</td>
                            <td>
                                @if($i->updated_at == $i->created_at)
                                <span class="status-badge status-pending">Pending</span>
                                @else
                                {{ date('M d, Y h:i A', strtotime($i->updated_at)) }}
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="empty-message">No leave records found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if(Session::has('leave_send'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": 5000,
            "extendedTimeOut": 2000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.success("{{ session('leave_send') }}", "Success!");
    </script>
    @endif

    @if(session('leave_not_send'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": 5000,
            "extendedTimeOut": 2000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.error("{{ session('leave_not_send') }}", "Error!");
    </script>
    @endif

    <script>
        // Date validation
        document.getElementById('from').addEventListener('change', function() {
            const toDate = document.getElementById('to');
            if (this.value > toDate.value) {
                toDate.value = this.value;
            }
            toDate.min = this.value;
        });

        // Toastr customization
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": 5000,
            "extendedTimeOut": 2000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
</body>

</html>
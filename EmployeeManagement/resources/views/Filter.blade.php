<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Data Dashboard</title>
    <style>
        :root {
            --navy: #111F4D;
            --light: #F2F4F7;
            --accent: #E43A19;
            --dark: #020205;
            --navy-light: #2A3A6D;
            --gold: #FFD700;
            --success: #10B981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: var(--light);
            color: var(--dark);
            display: flex;
        }

        .container {
            flex: 1;
            padding: 2rem;
            background-color: var(--light);
        }

        .filter-container {
            width: 100%;
            background-color: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            display: flex;
            justify-content: flex-end;
        }

        .filter-select {
            padding: 0.6rem 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: white;
            color: var(--navy);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            outline: none;
            min-width: 200px;
        }

        .filter-select:focus {
            border-color: var(--navy-light);
            box-shadow: 0 0 0 2px rgba(42, 58, 109, 0.2);
        }

        .data-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .data-header {
            padding: 1.5rem;
            background-color: var(--navy);
            color: white;
        }

        .data-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead {
            background-color: var(--navy-light);
            color: white;
        }

        .data-table th {
            padding: 1rem;
            text-align: left;
            font-weight: 500;
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .data-table tbody tr:hover {
            background-color: rgba(42, 58, 109, 0.05);
        }

        .status-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .status-present {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-late {
            background-color: rgba(228, 58, 25, 0.1);
            color: var(--accent);
        }

        .data-table .highlight {
            color: var(--gold);
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .data-table {
                display: block;
                overflow-x: auto;
            }

            .filter-container {
                justify-content: center;
            }
        }

        /* Animation for table rows */
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

        .data-table tbody tr {
            animation: fadeIn 0.3s ease forwards;
            opacity: 0;
        }

        .data-table tbody tr:nth-child(1) {
            animation-delay: 0.1s;
        }

        .data-table tbody tr:nth-child(2) {
            animation-delay: 0.2s;
        }

        .data-table tbody tr:nth-child(3) {
            animation-delay: 0.3s;
        }

        .data-table tbody tr:nth-child(4) {
            animation-delay: 0.4s;
        }

        .data-table tbody tr:nth-child(5) {
            animation-delay: 0.5s;
        }

        .data-table tbody tr:nth-child(n+6) {
            animation-delay: 0.6s;
        }
    </style>
</head>

<body>
    <x-menu />
    <div class="container">
        <div class="filter-container">
            <form action="/filter" method="post" id="filterForm">
                @csrf
                <select name="filters" class="filter-select" id="filterSelect" onchange="this.form.submit()">
                    <option value="">-- Select Filter --</option>
                    <option value="employeelist" <?= isset($emplist) ? 'selected' : '' ?>>All Employees</option>
                    <option value="late" <?= isset($late) ? 'selected' : '' ?>>Late Employees</option>
                    <option value="present" <?= isset($present) ? 'selected' : '' ?>>Present Today</option>
                    <option value="leave" <?= isset($leave) ? 'selected' : '' ?>>Leave Today</option>
                    <option value="early_leave" <?= isset($early_leave) ? 'selected' : '' ?>>Early leave Today</option>
                    <option value="absent" <?= isset($absent) ? 'selected' : '' ?>>Absent Today</option>
                    <option value="custome_holiday" <?= isset($custome_holiday) ? 'selected' : '' ?>>Custom Holiday</option>
                </select>
            </form>
        </div>
        <?php if (isset($late)): ?>
            <div class="data-container">
                <div class="data-header">
                    <h2 class="data-title">Late Employees Today</h2>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($late as $i): ?>
                            <tr>
                                <td><?= $i->name ?></td>
                                <td class="highlight"><?= $i->entry ?></td>
                                <td><?= $i->leave ?></td>
                                <td><span class="status-badge status-late">Late</span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if (isset($emplist)): ?>
            <div class="data-container">
                <div class="data-header">
                    <h2 class="data-title">All Employees</h2>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Join Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($emplist as $i): ?>
                            <tr>
                                <td><?= $i->name ?></td>
                                <td><?= $i->email ?></td>
                                <td><?= date('M d, Y', strtotime($i->created_at)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if (isset($present)): ?>
            <div class="data-container">
                <div class="data-header">
                    <h2 class="data-title">Present Employees Today</h2>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Entry Time</th>
                            <th>Leave Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($present as $i): ?>
                            <tr>
                                <td><?= $i->name ?></td>
                                <td class="highlight"><?= $i->entry ?></td>
                                <td><?= $i->leave ?></td>
                                <td><span class="status-badge status-present">Present</span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if (isset($leave)): ?>
            <div class="data-container">
                <div class="data-header">
                    <h2 class="data-title">Today's Leave</h2>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Entry Time</th>
                            <th>Leave Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leave as $i): ?>
                            <tr>
                                <td><?= $i->name ?></td>
                                <td><?= $i->entry ?></td>
                                <td><?= $i->leave ?></td>
                                <td><span class="status-badge status-present">Leave</span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if (isset($early_leave)): ?>
            <div class="data-container">
                <div class="data-header">
                    <h2 class="data-title">Early Leave Today</h2>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Entry Time</th>
                            <th>Leave Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($early_leave as $i): ?>
                            <tr>
                                <td><?= $i->name ?></td>
                                <td><?= $i->entry ?></td>
                                <td class="highlight"><?= $i->leave ?></td>
                                <td><span class="status-badge status-late">Early Leave</span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if (isset($CustomeHoliday)): ?>
            <div class="data-container">
                <div class="data-header">
                    <h2 class="data-title">Holidays This Month</h2>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Sr no</th>
                            <th>Date</th>
                            <th>Holiday Title</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($CustomeHoliday as $i )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="highlight"><?= $i->leaves ?></td>
                            <td><?= $i->title ?></td>
                            <td><?= $i->reason ?></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if (isset($absent)): ?>
            <div class="data-container">
                <div class="data-header">
                    <h2 class="data-title">Absent Today</h2>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($absent as $i): ?>
                            <tr>
                                <td><?= $i->name ?></td>
                                <td><?= $i->email ?></td>
                                <td><?= $i->mobile ?></td>
                                <td><span class="status-badge status-late">Absent Today</span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <script>
        function toggleMenu() {
            const panel = document.getElementById('panel');
            panel.classList.toggle('collapsed');

            const isCollapsed = panel.classList.contains('collapsed');
            localStorage.setItem('adminPanelCollapsed', isCollapsed);
        }

        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            const panel = document.getElementById('panel');
            panel.classList.toggle('open');
        });

        document.addEventListener('DOMContentLoaded', function() {
            const panel = document.getElementById('panel');
            const navItems = document.querySelectorAll('.nav-item');
            const currentPath = window.location.pathname;

            const savedState = localStorage.getItem('adminPanelCollapsed');
            if (savedState === 'true') {
                panel.classList.add('collapsed');
            }

            navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active');
                }
            });

            document.addEventListener('click', function(e) {
                const panel = document.getElementById('panel');
                const mobileBtn = document.getElementById('mobileMenuBtn');

                if (window.innerWidth <= 992 &&
                    !panel.contains(e.target) &&
                    e.target !== mobileBtn &&
                    !mobileBtn.contains(e.target)) {
                    panel.classList.remove('open');
                }
            });
        });

        window.addEventListener('resize', function() {
            const panel = document.getElementById('panel');
            if (window.innerWidth > 992) {
                panel.classList.remove('open');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const filterParam = urlParams.get('filter');

            if (filterParam) {
                const selectElement = document.getElementById('filterSelect');
                if (selectElement.value !== filterParam) {
                    selectElement.value = filterParam;
                    selectElement.dispatchEvent(new Event('change'));
                }
            }
        });
    </script>
</body>

</html>
<!-- Enhanced Holiday Settings Page with Gold Accent Line -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Holiday Settings • Admin Panel</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        :root {
            --navy: #111F4D;
            --light: #F2F4F7;
            --accent: #E43A19;
            --dark: #020205;
            --navy-light: #2A3A6D;
            --accent-light: #FF5C3A;
            --gold: #FFD700;
            --silver: #C0C0C0;
            --shadow-sm: 0 4px 8px rgba(0, 0, 0, 0.06);
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--light);
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
            display: flex;
            min-height: 100vh;
        }

        /* ===== Main Content ===== */
        main {
            flex: 1;
            padding: 40px;
            transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .admin-panel.collapsed~main {
            margin-left: 80px;
        }

        h1.section-title {
            font-size: 2.2rem;
            color: var(--navy);
            margin-bottom: 0.75rem;
            position: relative;
            display: inline-block;
            overflow: hidden;
        }

        h1.section-title::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }

        p.description {
            margin-bottom: 1.5rem;
            color: #555;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: var(--shadow);
            transform: translateY(-3px);
        }

        /* ===== Form Elements ===== */
        .btn-primary,
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 12px 24px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--accent-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-secondary {
            background: var(--navy);
            color: #fff;
        }

        .btn-secondary:hover {
            background: var(--navy-light);
            transform: translateY(-2px);
        }

        select,
        input[type="date"],
        input[type="text"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid rgba(2, 2, 5, 0.12);
            font-size: 14px;
            transition: var(--transition);
            background: #fff;
        }

        select:hover,
        input:focus,
        textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(228, 58, 25, 0.2);
            outline: none;
        }

        .date-group,
        .select-group {
            background: rgba(242, 244, 247, 0.55);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 1rem;
            position: relative;
            display: grid;
            gap: 1rem;
            animation: fadeIn 0.4s ease-out forwards;
        }

        .remove-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #e74c3c;
            color: #fff;
            font-size: 0.75rem;
            padding: 6px 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
        }

        .remove-btn:hover {
            background: #c0392b;
        }

        /* ===== Mobile Nav Toggle ===== */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 110;
            background: var(--accent);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 8px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
        }

        .mobile-menu-btn span {
            display: block;
            width: 24px;
            height: 2px;
            background: white;
            margin: 3px 0;
            transition: var(--transition);
            border-radius: 2px;
        }

        /* ===== Responsive ===== */
        @media (max-width: 992px) {
            .admin-panel {
                transform: translateX(-100%);
            }

            .admin-panel.open {
                transform: translateX(0);
            }

            main {
                margin-left: 0;
                padding: 80px 20px 40px;
            }

            .mobile-menu-btn {
                display: flex;
            }

            h1.section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            h1.section-title {
                font-size: 1.75rem;
            }
        }

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
    </style>
</head>

<body>
    <!-- Mobile menu button -->
    <x-menu />

    <!-- ===== Main Content ===== -->
    <main>
        <!-- Set Weekly Holiday -->
        <section class="card">
            <form action="/setweeklyholiday" method="post" id="selctDays">
                @csrf
                <h1 class="section-title">Set Weekly Holiday</h1>
                <p class="description">Select the days you want to set as weekly holidays</p>
                <button type="button" class="btn-secondary" onclick="showDays()" id="daycounter">Add Holiday Day</button>
                <div id="selectContainer"></div>
                <button type="submit" class="btn-primary" style="margin-top: 1.5rem;">Set Holidays</button>
            </form>
        </section>

        <section class="card">
            <form action="/setholiday" method="post" id="otherHolidaysForm">
                @csrf
                <h1 class="section-title">Set Other Holidays</h1>
                <p class="description">Add special holidays with dates and descriptions</p>
                <div id="dateInputs">
                    <div class="date-group">
                        <input type="date" name="leaves" required />
                        <input type="text" name="title" placeholder="Enter holiday title" required />
                        <textarea name="reason" placeholder="Reason for holiday" required></textarea>
                        <!-- <button type="button" class="remove-btn" onclick="this.parentNode.remove()">Remove</button> -->
                    </div>
                </div>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1rem;">
                    <!-- <button type="button" class="btn-secondary" onclick="addDateInput()">Add Another Date</button> -->
                    <button type="submit" class="btn-primary">Submit Holidays</button>
                </div>
            </form>
        </section>

        <!-- Set Timing -->
        <section class="card">
            <form action="/set_time" method="post">
                @csrf
                <h1 class="section-title">Set Timing</h1>
                <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1rem;">
                    <div style="flex: 1 1 150px;">
                        <label for="fromTime" style="font-weight: 600; color: var(--navy);">From</label>
                        <input type="time" id="fromTime" name="from" required />
                    </div>
                    <div style="flex: 1 1 150px;">
                        <label for="toTime" style="font-weight: 600; color: var(--navy);">To</label>
                        <input type="time" id="toTime" name="to" required />
                    </div>
                </div>
                <button type="submit" class="btn-primary" style="margin-top: 1.5rem; width: 200px;">Submit</button>
            </form>
        </section>
    </main>

    @if(session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', () => alert('Weekly holidays set successfully!'));
    </script>
    @endif
    @if(session('error'))
    <script>
        window.addEventListener('DOMContentLoaded', () => alert('Error setting weekly holidays.'));
    </script>
    @endif


    @if(session('saved success'))
    <script>
        window.addEventListener('DOMContentLoaded', () => alert('Holiday is set'));
    </script>
    @endif
    @if(session('not success'))
    <script>
        window.addEventListener('DOMContentLoaded', () => alert('oops something went wrong please try again later...'));
    </script>
    @endif

    <script>
        const panel = document.getElementById('panel');
        const mobileBtn = document.getElementById('mobileMenuBtn');
        let weeklyDaysCounter = 0;

        function toggleMenu() {
            panel.classList.toggle('collapsed');
            localStorage.setItem('adminPanelCollapsed', panel.classList.contains('collapsed'));
        }

        mobileBtn.addEventListener('click', () => panel.classList.toggle('open'));

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 992 && !panel.contains(e.target) && !mobileBtn.contains(e.target)) {
                panel.classList.remove('open');
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 992) panel.classList.remove('open');
        });

        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('adminPanelCollapsed') === 'true') panel.classList.add('collapsed');
        });

        /* ===== Weekly Holiday Selects ===== */
        function showDays() {
            if (weeklyDaysCounter >= 6) return;
            weeklyDaysCounter++;
            if (weeklyDaysCounter >= 6) {
                const btn = document.getElementById('daycounter');
                btn.disabled = true;
                btn.textContent = 'Maximum days added';
            }

            const selectContainer = document.getElementById('selectContainer');
            const wrapper = document.createElement('div');
            wrapper.className = 'select-group';
            wrapper.innerHTML = `
                <select name="weekly_holiday[]" required>
                    <option value="" disabled selected>Select a day</option>
                    <option value="sun">Sunday</option>
                    <option value="mon">Monday</option>
                    <option value="tue">Tuesday</option>
                    <option value="wed">Wednesday</option>
                    <option value="thu">Thursday</option>
                    <option value="fri">Friday</option>
                    <option value="satur">Saturday</option>
                </select>
                <button type="button" class="remove-btn" aria-label="Remove day" onclick="removeDay(this)">Remove</button>`;
            selectContainer.appendChild(wrapper);
        }

        function removeDay(btn) {
            btn.parentElement.remove();
            weeklyDaysCounter--;
            const counterBtn = document.getElementById('daycounter');
            counterBtn.disabled = false;
            counterBtn.textContent = `Add Holiday Day`;
        }

        /* ===== Other Holidays Dynamic Inputs ===== */
        function addDateInput() {
            const dateInputs = document.getElementById('dateInputs');
            const template = document.createElement('div');
            template.className = 'date-group';
            template.innerHTML = `
                <input type="date" name="dates[]" required />
                <input type="text" name="titles[]" placeholder="Enter holiday title" required />
                <textarea name="reasons[]" placeholder="Reason for holiday" required></textarea>
                <button type="button" class="remove-btn" onclick="this.parentNode.remove()">Remove</button>`;
            dateInputs.appendChild(template);
        }
    </script>
</body>

</html>
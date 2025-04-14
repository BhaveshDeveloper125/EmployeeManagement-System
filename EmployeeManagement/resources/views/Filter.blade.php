<style>
    :root {
        --navy: #111F4D;
        --light: #F2F4F7;
        --accent: #E43A19;
        --dark: #020205;
        --navy-light: #2A3A6D;
        --accent-light: #FF5C3A;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: var(--light);
        color: var(--dark);
        line-height: 1.6;
    }

    .dashboard-container {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar Styles */
    .admin-panel {
        width: 280px;
        background: var(--navy);
        color: var(--light);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        z-index: 100;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
    }

    .admin-panel.collapsed {
        width: 80px;
    }

    .panel-header {
        padding: 24px 20px;
        display: flex;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logo {
        font-size: 22px;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
    }

    .logo-icon {
        font-size: 28px;
        color: var(--accent);
    }

    .menu-toggle {
        margin-left: auto;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .menu-toggle:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .menu-toggle span {
        display: block;
        width: 22px;
        height: 2px;
        background: white;
        margin: 3px 0;
        transition: all 0.3s ease;
        border-radius: 2px;
    }

    /* Changed these selectors to show cross when expanded */
    .admin-panel:not(.collapsed) .menu-toggle span:nth-child(1) {
        transform: translateY(5px) rotate(45deg);
    }

    .admin-panel:not(.collapsed) .menu-toggle span:nth-child(2) {
        opacity: 0;
    }

    .admin-panel:not(.collapsed) .menu-toggle span:nth-child(3) {
        transform: translateY(-5px) rotate(-45deg);
    }

    .panel-nav {
        padding: 20px 0;
    }

    .nav-item {
        display: flex;
        align-items: center;
        padding: 14px 24px;
        margin: 4px 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--light);
        opacity: 0.9;
        position: relative;
        overflow: hidden;
    }

    .nav-item:hover {
        background: rgba(255, 255, 255, 0.1);
        opacity: 1;
        transform: translateX(4px);
    }

    .nav-item.active {
        background: var(--accent);
        box-shadow: 0 4px 12px rgba(228, 58, 25, 0.3);
    }

    .nav-item.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: white;
    }

    .nav-icon {
        width: 24px;
        height: 24px;
        margin-right: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nav-text {
        font-size: 15px;
        font-weight: 500;
        transition: opacity 0.3s ease;
    }

    .admin-panel.collapsed .nav-text {
        opacity: 0;
        width: 0;
        height: 0;
        overflow: hidden;
    }

    .logout-btn {
        display: flex;
        align-items: center;
        width: calc(100% - 24px);
        margin: 20px 12px 0;
        padding: 14px 24px;
        background: rgba(228, 58, 25, 0.2);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 15px;
        font-weight: 500;
    }

    .logout-btn:hover {
        background: var(--accent);
        box-shadow: 0 4px 12px rgba(228, 58, 25, 0.3);
    }

    .logout-icon {
        margin-right: 16px;
    }

    .admin-panel.collapsed .logout-btn span {
        opacity: 0;
        width: 0;
        height: 0;
        overflow: hidden;
    }

    /* Main Content Styles */
    .main-content {
        flex: 1;
        padding: 30px;
        background: var(--light);
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--navy);
    }

    .filter-container {
        position: relative;
    }

    .filter-select {
        padding: 10px 16px;
        border-radius: 8px;
        border: 1px solid rgba(2, 2, 5, 0.1);
        background: white;
        font-size: 14px;
        color: var(--dark);
        cursor: pointer;
        appearance: none;
        padding-right: 40px;
        min-width: 200px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .filter-select:hover {
        border-color: rgba(2, 2, 5, 0.2);
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 2px rgba(228, 58, 25, 0.2);
    }

    .filter-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    /* Data Table Styles */
    .data-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .data-header {
        padding: 20px;
        border-bottom: 1px solid rgba(2, 2, 5, 0.05);
    }

    .data-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--navy);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        background: rgba(17, 31, 77, 0.05);
        padding: 14px 20px;
        text-align: left;
        font-weight: 600;
        color: var(--navy);
        font-size: 14px;
    }

    .data-table td {
        padding: 16px 20px;
        border-bottom: 1px solid rgba(2, 2, 5, 0.05);
        font-size: 14px;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .data-table tr:hover td {
        background: rgba(228, 58, 25, 0.03);
    }

    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-present {
        background: rgba(46, 204, 113, 0.1);
        color: #2ecc71;
    }

    .status-late {
        background: rgba(231, 76, 60, 0.1);
        color: #e74c3c;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .admin-panel {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1000;
            transform: translateX(-100%);
        }

        .admin-panel.open {
            transform: translateX(0);
        }

        .main-content {
            padding: 20px;
        }
    }
</style>

<div class="dashboard-container">
    <div class="admin-panel" id="panel">
        <div class="panel-header">
            <div class="logo">
                <span class="logo-icon">⚡</span>
            </div>
            <button class="menu-toggle" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <nav class="panel-nav">
            <a href="/adminPanel/records" class="nav-item active">
                <div class="nav-icon">📁</div>
                <span class="nav-text">Records</span>
            </a>
            <a href="/adminPanel/generate_user" class="nav-item">
                <div class="nav-icon">👥</div>
                <span class="nav-text">Generate User</span>
            </a>
            <a href="/adminPanel/downloadData" class="nav-item">
                <div class="nav-icon">⏬</div>
                <span class="nav-text">Download Data</span>
            </a>
            <a href="/adminPanel/search_user" class="nav-item">
                <div class="nav-icon">🔍</div>
                <span class="nav-text">Search User</span>
            </a>
            <a href="/adminPanel/holiday" class="nav-item">
                <div class="nav-icon">🌴</div>
                <span class="nav-text">Holiday Settings</span>
            </a>
        </nav>

        <button class="logout-btn" onclick="document.querySelector('form').submit()">
            <div class="nav-icon logout-icon">🚪</div>
            <span>Logout</span>
        </button>
        <form action="/logout" method="post" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="main-content">
        <div class="content-header">
            <h1 class="page-title">Employee Records</h1>
            <div class="filter-container">
                <form action="/filter" method="post">
                    @csrf
                    <select name="filters" class="filter-select" onchange="this.form.submit()">
                        <option value="">-- Select Filter --</option>
                        <option value="late" <?= isset($late) ? 'selected' : '' ?>>Late Employees</option>
                        <option value="employeelist" <?= isset($emplist) ? 'selected' : '' ?>>All Employees</option>
                        <option value="present" <?= isset($present) ? 'selected' : '' ?>>Present Today</option>
                    </select>
                    <div class="filter-icon">▼</div>
                </form>
            </div>
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
                                <td><?= $i->entry ?></td>
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
                                <td><?= $i->entry ?></td>
                                <td><?= $i->leave ?></td>
                                <td><span class="status-badge status-present">Present</span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function toggleMenu() {
        const panel = document.getElementById('panel');
        panel.classList.toggle('collapsed');
    }

    // Highlight active nav item based on current URL
    document.addEventListener('DOMContentLoaded', function() {
        const navItems = document.querySelectorAll('.nav-item');
        const currentPath = window.location.pathname;

        navItems.forEach(item => {
            item.classList.remove('active');
            if (item.getAttribute('href') === currentPath) {
                item.classList.add('active');
            }
        });
    });
</script>
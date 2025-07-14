<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <style>
        :root {
            --navy: #111F4D;
            --light: #F2F4F7;
            --accent: #E43A19;
            --dark: #020205;
            --navy-light: #2A3A6D;
            --gold: #FFD700;
            --success: #10B981;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --card-radius: 16px;
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --header-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light);
            color: var(--navy);
        }

        .settings-container {
            height: 100vh;
            width: 100vw;
            display: flex;
        }

        .set-container {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .settings-header {
            margin-bottom: 2rem;
        }

        .settings-header h1,
        h3 {
            font-size: 2rem;
            color: var(--navy);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .settings-header p {
            color: var(--navy-light);
            font-size: 1rem;
        }

        .settings-card {
            background: white;
            border-radius: var(--card-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .settings-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .settings-card h2 {
            color: var(--navy);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .settings-card h2 svg {
            margin-right: 0.75rem;
            color: var(--accent);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--navy-light);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background-color: var(--light);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(228, 58, 25, 0.2);
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            font-size: 100px;
            opacity: 0;
            right: 0;
            top: 0;
            cursor: pointer;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            background-color: var(--light);
            border: 1px dashed #ccc;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .file-input-label:hover {
            border-color: var(--accent);
            background-color: rgba(228, 58, 25, 0.05);
        }

        .file-input-text {
            color: var(--navy-light);
        }

        .file-input-button {
            background-color: var(--accent);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .time-inputs {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .time-inputs .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background-color: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background-color: #c53216;
            transform: translateY(-2px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn svg {
            margin-right: 0.5rem;
        }

        .divider {
            height: 1px;
            background-color: rgba(0, 0, 0, 0.1);
            margin: 2rem 0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .settings-container {
                flex-direction: column;
            }

            .set-container {
                padding: 1.5rem;
            }

            .time-inputs {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="settings-container">
        <x-menu />
        <div class="set-container">
            <div class="settings-header">
                <h1>System Settings</h1>
                <p>Configure your application preferences and system parameters</p>
            </div>

            <div class="settings-card">
                <h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg>
                    General Settings
                </h2>

                <form action="/set_setting" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="baseUrl">Base URL</label>
                        <input type="text" id="baseUrl" name="baseUrl" class="form-control" placeholder="https://example.com">
                    </div>

                    <div class="form-group">
                        <label for="logo">Application Logo</label>
                        <div class="file-input-wrapper">
                            <label class="file-input-label">
                                <span class="file-input-text">Choose a file or drag it here</span>
                                <span class="file-input-button">Browse</span>
                                <input type="file" id="logo" name="logo" class="form-control">
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="appName">Application Name</label>
                        <input type="text" id="appName" name="appName" class="form-control" placeholder="My Awesome App">
                    </div>

                    <div class="form-group">
                        <label for="wifiName">WiFi Network Name</label>
                        <input type="text" id="wifiName" name="wifiName" class="form-control" placeholder="Office WiFi">
                    </div>

                    <h3>Coordinates</h3>

                    <div class="form-group">
                        <label for="wifiName">Lantitude</label>
                        <input type="text" id="wifiName" name="lantitude" class="form-control" placeholder="Lantitude">
                    </div>

                    <div class="form-group">
                        <label for="wifiName">Longitude</label>
                        <input type="text" id="wifiName" name="longitude" class="form-control" placeholder="Longitude">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Update Settings
                    </button>
                </form>
            </div>

            <div class="settings-card">
                <h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Office Hours
                </h2>

                <form action="/set_time" method="post">
                    @csrf
                    <div class="time-inputs">
                        <div class="form-group">
                            <label for="from">Opening Time</label>
                            <input type="time" id="from" name="from" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="to">Closing Time</label>
                            <input type="time" id="to" name="to" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        Save Schedule
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
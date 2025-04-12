<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holidays Settings</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: #f0f2f5;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
        }

        .holidaySection {
            display: flex;
            flex: 1;
        }

        .admin_panel {
            height: 100vh;
            width: 250px;
            background: linear-gradient(135deg, #111F4D, #020205);
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.4);
            transition: all 0.5s ease;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 10px;
        }

        .admin_panel2 {
            height: 100vh;
            width: 80px;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            transition: all 0.5s ease;
            overflow: hidden;
        }

        .three_line_container {
            height: 60px;
            width: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin: 10px;
            transition: all 0.3s ease;
        }

        .three_line_container:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        .three_line {
            height: 3px;
            width: 30px;
            background: #fff;
            margin: 3px 0;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .admin_panel .three_line_container {
            align-self: flex-start;
            margin-left: 10px;
        }

        .panel_ul {
            list-style: none;
            padding: 20px 0;
            margin: 0;
            width: 100%;
        }

        .panel_ul li {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            margin: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .panel_ul li:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .panel_ul li img {
            height: 32px;
            width: 32px;
            filter: brightness(0) invert(1);
            transition: filter 0.3s ease;
        }

        .panel_ul li:hover img {
            filter: brightness(1) invert(0);
        }

        .panel_ul li span {
            color: #F2F4F7;
            font-size: 16px;
            font-weight: 500;
            padding-left: 15px;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .panel_ul li:hover span {
            opacity: 1;
        }

        .admin_panel .panel_ul li span {
            display: block;
        }

        .admin_panel2 .panel_ul li span {
            display: none;
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        form {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            max-width: 600px;
        }

        form h1 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #111F4D;
        }

        form select,
        form input[type="text"],
        form input[type="date"],
        form textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        form input[type="submit"],
        form button {
            padding: 10px 20px;
            background-color: #E43A19;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 10px;
        }

        form button.remove-btn {
            background-color: #888;
            margin-top: 10px;
        }

        .date-group {
            background: #F2F4F7;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="holidaySection">
        <div class="admin_panel2" id="panel">
            <button class="three_line_container" onclick="ExpandMenu()">
                <div class="three_line"></div>
                <div class="three_line"></div>
                <div class="three_line"></div>
            </button>

            <ul class="panel_ul">
                <a href="/adminPanel/records">
                    <li>
                        <img src="{{ URL('Images/directory.png') }}" alt="Records">
                        <span>Records</span>
                    </li>
                </a>
                <a href="/adminPanel/generate_user">
                    <li>
                        <img src="{{ URL('Images/working.png') }}" alt="Generate User">
                        <span>Generate User</span>
                    </li>
                </a>
                <a href="/adminPanel/downloadData">
                    <li>
                        <img src="{{ URL('Images/download.png') }}" alt="Download Data">
                        <span>Download Data</span>
                    </li>
                </a>
                <a href="/adminPanel/search_user">
                    <li>
                        <img src="{{ URL('Images/cv.png') }}" alt="Search User">
                        <span>Search User</span>
                    </li>
                </a>
                <a href="/adminPanel/holiday">
                    <li>
                        <img src="{{ URL('Images/cv.png') }}" alt="Holiday Settings">
                        <span>Holiday Settings</span>
                    </li>
                </a>
            </ul>
        </div>

        <div class="content">
            <form action="" method="post">
                <h1>Set Weekly Holiday</h1>
                <select name="weekly_holiday" id="">
                    <option value="sun">Sunday</option>
                    <option value="mon">Monday</option>
                    <option value="tue">Tuesday</option>
                    <option value="wed">Wednesday</option>
                    <option value="thurs">Thursday</option>
                    <option value="fri">Friday</option>
                    <option value="satur">Saturday</option>
                    <option value="no">No Holiday</option>
                </select>
                <input type="submit" value="Set">
            </form>

            <form action="/setholiday" method="post">
                @csrf
                <h1>Set Other Holidays</h1>
                <div id="dateInputs">
                    <div class="date-group">
                        <input type="date" name="dates[]" required>
                        <input type="text" name="titles[]" placeholder="Enter holiday title" required>
                        <textarea name="reasons[]" placeholder="Reason for holiday" required></textarea>
                    </div>
                </div>
                <button type="button" onclick="addDateInput()">Add Another Date</button>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function ExpandMenu() {
            const panel = document.querySelector('#panel');
            if (panel) {
                if (panel.classList.contains('admin_panel2')) {
                    panel.classList.remove('admin_panel2');
                    panel.classList.add('admin_panel');
                } else {
                    panel.classList.remove('admin_panel');
                    panel.classList.add('admin_panel2');
                }
            } else {
                console.error('Element with ID #panel not found!');
            }
        }

        function addDateInput() {
            const dateInputs = document.getElementById('dateInputs');
            const newGroup = document.createElement('div');
            newGroup.className = 'date-group';
            newGroup.innerHTML = `
                <input type="date" name="dates[]" required>
                <input type="text" name="titles[]" placeholder="Enter holiday title" required>
                <textarea name="reasons[]" placeholder="Reason for holiday" required></textarea>
                <button type="button" class="remove-btn" onclick="this.parentNode.remove()">Remove</button>
            `;
            dateInputs.appendChild(newGroup);
        }
    </script>
</body>

</html>
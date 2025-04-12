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
            background: #F2F4F7;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .admin_panel {
            height: 100vh;
            width: 20vw;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            transition: all 0.5s ease;
            overflow: hidden;
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

        .panel_ul {
            list-style: none;
            padding: 20px 0;
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

        .panel_ul li:hover img {
            filter: brightness(1) invert(0);
        }

        .panel_ul li img {
            height: 32px;
            width: 32px;
            filter: brightness(0) invert(1);
            transition: all 0.3s ease;
        }

        .panel_ul li span {
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            padding-left: 15px;
            opacity: 0.9;
            transition: all 0.3s ease;
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

        .admin_panel .three_line_container:hover .three_line:nth-child(1) {
            transform: translateY(-2px);
        }

        .admin_panel .three_line_container:hover .three_line:nth-child(3) {
            transform: translateY(2px);
        }

        .holidaySection {
            display: flex;
            flex: 1;
        }

        form,
        .holidaySection>div:not(.admin_panel2) {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin: 40px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            flex: 1;
        }

        form h1 {
            color: #111F4D;
            margin-bottom: 20px;
        }

        select,
        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: 0.3s;
        }

        select:focus,
        input:focus,
        textarea:focus {
            outline: none;
            border-color: #E43A19;
            box-shadow: 0 0 8px rgba(228, 58, 25, 0.4);
        }

        input[type="submit"],
        button[type="submit"],
        button[type="button"] {
            background-color: #111F4D;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        input[type="submit"]:hover,
        button[type="submit"]:hover,
        button[type="button"]:hover {
            background-color: #E43A19;
        }

        .date-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 12px;
            background-color: #F2F4F7;
        }

        .remove-btn {
            background-color: #E43A19;
            color: white;
            align-self: flex-end;
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

        <div>
            <form action="" method="post">
                <h1>Set Weekly Holiday</h1>
                <select name="" id="">
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
        </div>

        <div>
            <h1>Set Other Holidays</h1>
            <form action="/setholiday" method="post">
                @csrf
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

            <script>
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
    </script>
</body>

</html>
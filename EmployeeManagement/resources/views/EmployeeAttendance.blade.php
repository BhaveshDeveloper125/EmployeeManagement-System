<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
    <style>
        :root {
            --primary-color: #111F4D;
            --secondary-color: #F2F4F7;
            --accent-color: #E43A19;
            --text-color: #020205;
            --light-gray: #e5e7eb;
            --dark-gray: #6b7280;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--secondary-color);
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
        }

        .checkIn,
        .checkOut {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-color);
        }

        input[type="datetime-local"] {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            font-size: 16px;
            margin-bottom: 20px;
            transition: border-color 0.3s;
        }

        input[type="datetime-local"]:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        button[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s, transform 0.2s;
        }

        button[type="submit"]:hover {
            background-color: #4338ca;
            transform: translateY(-2px);
        }

        .checkOut button[type="submit"] {
            background-color: var(--accent-color);
        }

        .checkOut button[type="submit"]:hover {
            background-color: #0d9f6e;
        }

        hr {
            border: none;
            height: 1px;
            background-color: var(--light-gray);
            margin: 30px 0;
        }

        .attendance-link {
            display: block;
            text-align: center;
            padding: 15px;
            background-color: white;
            border-radius: 6px;
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .attendance-link:hover {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.2);
        }

        .login-link {
            display: block;
            text-align: center;
            padding: 15px;
            background-color: white;
            border-radius: 6px;
            color: var(--dark-gray);
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .login-link:hover {
            background-color: var(--light-gray);
            color: var(--text-color);
        }

        .status-message {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        .success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .error {
            background-color: #fee2e2;
            color: #b91c1c;
        }
    </style>
</head>

<body>
    <h1>Attendance Tracking</h1>

    <form action="/Entery" method="post" class="checkIn">
        @csrf
        <label for="EntryTime">Check In</label>
        <input type="datetime-local" name="start" id="EntryTime" required>
        <button type="submit">Check In</button>
    </form>

    <hr>

    <form action="/leave" method="post" class="checkOut">
        @csrf
        <label for="EndTime">Check Out</label>
        <input type="datetime-local" name="end" id="EndTime" required>
        <button type="submit">Check Out</button>
    </form>





    <hr>



    @auth
    <a href="/attendance/{{ Auth::id() }}" class="attendance-link">View Your Attendance History</a>
    @else
    <a href="/login" class="login-link">Login to Track Attendance</a>
    @endauth

    <script>
        // Set default datetime-local values to current time
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            // Format for datetime-local input
            const localDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000)
                .toISOString()
                .slice(0, 16);

            document.getElementById('EntryTime').value = localDateTime;
            document.getElementById('EndTime').value = localDateTime;
        });

        // Simple functions for button clicks (you can expand these)
        function DisplayCheckout() {
            alert('Check-in recorded successfully!');
        }

        function DisplayCheckin() {
            alert('Check-out recorded successfully!');
        }
    </script>
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        setInterval(() => {
            let entryDate = new Date();

            let day = String(entryDate.getDate()).padStart(2, '0');
            let month = String(entryDate.getMonth() + 1).padStart(2, '0');
            let year = String(entryDate.getFullYear()).padStart(2, '0');
            let hour = String(entryDate.getHours()).padStart(2, '0');
            let min = String(entryDate.getMinutes()).padStart(2, '0');
            let sec = String(entryDate.getSeconds()).padStart(2, '0');

            let date = `${year}-${month}-${day}T${hour}:${min}`;
            document.querySelector('#EntryTime').value = date;
            document.querySelector('#EndTime').value = date;
            console.log(`Hello Bhavesh`);
        }, 1000);

    })


    document.querySelector('.checkOut').style.display = "none";

    document.querySelector('.checkIn').addEventListener('submit', () => {
        document.querySelector('.checkIn').style.display = "none";
        document.querySelector('.checkOut').style.display = "block";
    })

    document.querySelector('.checkOut').addEventListener('submit', () => {
        document.querySelector('.checkIn').style.display = "block";
        document.querySelector('.checkOut').style.display = "none";
    })
</script>
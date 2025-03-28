<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
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

        .cardcontainer {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .cards {
            background: linear-gradient(135deg, var(--navy-blue), #1a2b6d);
            border-radius: 12px;
            padding: 25px;
            color: var(--soft-white);
            box-shadow: 0 6px 15px rgba(17, 31, 77, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cards:nth-child(2) {
            background: linear-gradient(135deg, var(--vibrant-red), #f05a3a);
        }

        .cards:nth-child(3) {
            background: linear-gradient(135deg, #10B981, #0d9f6e);
        }

        .cards:nth-child(4) {
            background: linear-gradient(135deg, var(--gold-accent), #e6c200);
        }

        .cards::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
            transition: all 0.3s ease;
        }

        .cards:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(17, 31, 77, 0.3);
        }

        .cards:hover::before {
            transform: rotate(30deg) translate(20px, 20px);
        }

        .cards h1 {
            color: var(--soft-white);
            margin: 0;
            font-size: 18px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
        }

        .cards h1:last-child {
            font-size: 32px;
            font-weight: 700;
            margin-top: 15px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--deep-black);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .attendance-container {
            width: 100%;
            max-width: 1000px;
            overflow-x: auto;
            background: var(--soft-white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(1, 31, 77, 0.2);
            padding: 30px;
            position: relative;
        }

        .attendance-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--navy-blue), var(--vibrant-red), var(--gold-accent));
        }

        h1 {
            color: var(--navy-blue);
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            position: relative;
            padding-bottom: 15px;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--vibrant-red);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            font-size: 15px;
        }

        th {
            background-color: var(--navy-blue);
            color: var(--soft-white);
            padding: 16px 12px;
            text-align: center;
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
            text-align: center;
            border-bottom: 1px solid var(--light-gray);
            transition: all 0.2s ease;
        }

        tr:nth-child(even) {
            background-color: rgba(242, 244, 247, 0.5);
        }

        tr:hover {
            background-color: var(--table-highlight);
        }

        tr:last-child td {
            border-bottom: none;
        }

        .working {
            color: var(--vibrant-red);
            font-weight: 600;
        }

        .hours {
            font-weight: 600;
            color: var(--navy-blue);
        }

        .day-weekend {
            color: var(--vibrant-red);
        }

        @media (max-width: 768px) {
            .attendance-container {
                padding: 20px 15px;
            }

            h1 {
                font-size: 24px;
            }

            th,
            td {
                padding: 12px 8px;
                font-size: 14px;
            }
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            height: 8px;
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-gray);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--navy-blue);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--vibrant-red);
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="attendance-container">
        <div class="cardcontainer">
            <div class="cards">
                <h1>Attendance/Month</h1>
                <h1>{{ $attendance }}</h1>
            </div>
            <div class="cards">
                <h1>Late Attendance/Month</h1>
                <h1>{{ $lateattendance }}</h1>
            </div>
            <!-- <div class="cards">
                <h1>Leave Today</h1>
                <h1></h1>
            </div> -->
            <div class="cards">
                <h1>Absent/Month</h1>
                <h1></h1>
            </div>
            <div class="cards">
                <h1>Early Leave/Month</h1>
                <h1></h1>
            </div>
        </div>
        <h1>Attendance Records</h1>

        <table>
            <thead>
                <tr>
                    <th>Index</th>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Working Hours</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($i->entry)->format('d-m-y') }}</td>
                    <td class="{{ in_array(\Carbon\Carbon::parse($i->entry)->format('D'), ['Sat', 'Sun']) ? 'day-weekend' : '' }}">
                        {{ \Carbon\Carbon::parse($i->entry)->format('D') }}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($i->entry)->format('H:i') }}</td>
                    <td class="{{ !$i->leave ? 'working' : '' }}">
                        {{ $i->leave ? \Carbon\Carbon::parse($i->leave)->format('H:i') : 'Working...' }}
                    </td>
                    <td class="hours">
                        {{ $i->entry && $i->leave ? \Carbon\Carbon::parse($i->entry)->diff(\Carbon\Carbon::parse($i->leave))->format('%H:%I') : '' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
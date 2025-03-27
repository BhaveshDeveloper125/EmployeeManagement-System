<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
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

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--deep-black);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        /* Form Styling */
        .form-container {
            background-color: var(--soft-white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(1, 31, 77, 0.2);
            padding: 30px;
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

        h1,
        h2 {
            color: var(--navy-blue);
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        h2 {
            font-size: 24px;
            margin: 40px 0 20px;
        }

        h1::after,
        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--vibrant-red);
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid var(--light-gray);
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: var(--navy-blue);
            box-shadow: 0 0 0 3px rgba(17, 31, 77, 0.2);
        }

        input::placeholder {
            color: var(--deep-black);
            opacity: 0.5;
        }

        input[type="submit"] {
            background-color: var(--navy-blue);
            color: var(--soft-white);
            border: none;
            padding: 16px 32px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        input[type="submit"]:hover {
            background-color: var(--vibrant-red);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(228, 58, 25, 0.3);
        }

        /* Table Styling */
        .table-container {
            background-color: var(--soft-white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(1, 31, 77, 0.2);
            padding: 30px;
            margin: 40px 0;
            overflow-x: auto;
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

        .working-hours {
            font-weight: 600;
            color: var(--navy-blue);
        }

        .empty-message {
            text-align: center;
            padding: 40px;
            color: var(--vibrant-red);
            font-size: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }

            .form-container,
            .table-container {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            h2 {
                font-size: 20px;
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
    <div class="container">
        <div class="form-container">
            <h1>Generate User</h1>
            <form action="user_register" method="post">
                @csrf
                <input type="text" name="name" placeholder="Enter Name" required>
                <input type="email" name="email" placeholder="Enter Email" required>
                <input type="password" name="password" placeholder="Enter Password" required>
                <input type="password" name="password_confirmed" placeholder="Confirm Password" required>
                <input type="submit" value="Register User">
            </form>
        </div>

        <div class="table-container">
            <h2>Employee Records</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>CheckIn</th>
                        <th>CheckOut</th>
                        <th>Post</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Qualification</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->entry }}</td>
                        <td>{{ $i->leave }}</td>
                        <td>{{ $i->post }}</td>
                        <td>{{ $i->mobile }}</td>
                        <td>{{ $i->address }}</td>
                        <td>{{ $i->qualificatio }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="form-container">
            <h2>Search Employee</h2>
            <form action="/get_user_info" method="post">
                @csrf
                <input type="text" name="name" placeholder="Enter the Name" required>
                <input type="submit" value="Search">
            </form>
        </div>

        @if (isset($alldata) && $alldata->isNotEmpty())
        <div class="table-container">
            <h2>Search Results</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sr no</th>
                        <th>Name</th>
                        <th>CheckIn</th>
                        <th>CheckOut</th>
                        <th>Working Hour</th>
                        <th>Date(D-M-Y)</th>
                        <th>Post</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Qualification</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alldata as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $i->name }}</td>
                        <td>{{ Carbon\Carbon::parse($i->entry)->format('H:i') }}</td>
                        <td>{{ Carbon\Carbon::parse($i->leave)->format('H:i') }}</td>
                        <td class="working-hours">
                            {{ $i->entry && $i->leave ? \Carbon\Carbon::parse($i->entry)->diff(\Carbon\Carbon::parse($i->leave))->format('%H:%I') : '' }}
                        </td>
                        <td>{{ Carbon\Carbon::parse($i->entry)->format('d-m-y') }}</td>
                        <td>{{ $i->post }}</td>
                        <td>{{ $i->mobile }}</td>
                        <td>{{ $i->address }}</td>
                        <td>{{ $i->qualificatio }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-message">
            No search results found
        </div>
        @endif
    </div>
</body>

</html>
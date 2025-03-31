<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Management System</title>
<style>
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

    /* Action Links Styling */
    .action-links {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .action-links a {
        display: inline-flex;
        align-items: center;
        padding: 12px 24px;
        background-color: var(--navy-blue);
        color: var(--soft-white);
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(17, 31, 77, 0.2);
    }

    .action-links a:hover {
        background-color: var(--vibrant-red);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(228, 58, 25, 0.3);
    }

    .action-links a::before {
        content: '';
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-right: 10px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .action-links a:nth-child(1)::before {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6zm8-6v5h5v-5h-5z'/%3E%3C/svg%3E");
    }

    .action-links a:nth-child(2)::before {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6zm5-11H9v2h2v-2zm0 3H9v2h2v-2zm0 3H9v2h2v-2zm4-6h-4v2h4v-2zm0 3h-4v2h4v-2zm0 3h-4v2h4v-2z'/%3E%3C/svg%3E");
    }

    .action-links a:nth-child(3)::before {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z'/%3E%3C/svg%3E");
    }

    @media (max-width: 768px) {
        .cardcontainer {
            grid-template-columns: 1fr 1fr;
        }

        .action-links {
            flex-direction: column;
            gap: 12px;
        }

        .action-links a {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .cardcontainer {
            grid-template-columns: 1fr;
        }

        .cards {
            min-height: 140px;
        }

        .cards h1:last-child {
            font-size: 28px;
        }
    }

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

    .cardcontainer {
        height: fit-content;
        width: 100%;
        background-color: #111F4D;
        padding: 8px;
        display: flex;
        gap: 8px;
    }

    .cards {
        height: 16rem;
        width: 25%;
        background-color: #E43A19;
        /* --navy-blue: #111F4D;
            --light-gray: #F2F4F7;
            --vibrant-red: #E43A19;
            --deep-black: #020205;
            --gold-accent: #FFD700;
            --soft-white: #FFFFFF; */
    }

    .cards h1 {
        color: white;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">

        <div class="cardcontainer">
            <div class="cards">
                <h1>Total Employees</h1>
                <h1>{{ $userData }}</h1>
            </div>
            <div class="cards">
                <h1>Late Today</h1>
                <h1>{{ $lateEmp }}</h1>
            </div>
            <div class="cards">
                <h1>Present Today</h1>
                <h1>{{ $presentToday }}</h1>
            </div>
            <div class="cards">
                <h1>Leave Today</h1>
                <h1>{{ $leaveToday }}</h1>
            </div>
            <div class="cards">
                <h1>Absent Today</h1>
                <h1>{{ $absent }}</h1>
            </div>
            <div class="cards">
                <h1>Early Leave Today</h1>
                <h1>{{ $earlyLeave }}</h1>
            </div>
        </div>

        <div class="action-links">
            <a href="/pdfdatas">Download Records As PDF</a>
            <a href="/pdfdatas">Download Records As Excel</a>
            <a href="/pdfdatas">Print Records</a>
        </div>
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
                        <th>Edit User Details</th>
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
                        <td class="edit">
                            <a href={{ "/editemps/".$i->user_id }}>
                                Edit
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </td>
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
                        <th>Edit User Details</th>
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
                        <td>
                            <button><i class="fas fa-pencil-alt"></i></button>
                        </td>
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
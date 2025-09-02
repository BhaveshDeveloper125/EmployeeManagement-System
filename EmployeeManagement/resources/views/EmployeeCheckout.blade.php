<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Checkout | Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        :root {
            --navy-blue: #111F4D;
            --light-navy: #1A2A6C;
            --light-gray: #F8FAFC;
            --vibrant-red: #E43A19;
            --soft-red: #FF6B6B;
            --deep-black: #020205;
            --gold-accent: #FFD700;
            --soft-white: #FFFFFF;
            --success-green: #10B981;
            --pending-yellow: #F59E0B;
            --rejected-red: #EF4444;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--navy-blue);
            height: 100vh;
            width: 100vw;
            display: flex;
            overflow-x: hidden;
        }

        #empcheckoutlist {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
            background-color: var(--light-gray);
        }

        h1 {
            color: var(--navy-blue);
            margin-bottom: 2rem;
            font-weight: 600;
            position: relative;
            display: inline-block;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--vibrant-red);
            border-radius: 2px;
        }

        .checkout-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: var(--soft-white);
            box-shadow: var(--card-shadow);
            border-radius: 12px;
            overflow: hidden;
        }

        .checkout-table th {
            background-color: var(--navy-blue);
            color: var(--soft-white);
            padding: 1rem;
            text-align: left;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .checkout-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            vertical-align: middle;
        }

        .checkout-table tr:last-child td {
            border-bottom: none;
        }

        .checkout-table tr:hover {
            background-color: rgba(26, 42, 108, 0.03);
        }

        .checkout-form {
            display: contents;
        }

        .checkout-form input[type="text"] {
            display: none;
        }

        .datetime-input {
            padding: 0.6rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            transition: var(--transition);
            background-color: var(--soft-white);
        }

        .datetime-input:focus {
            outline: none;
            border-color: var(--light-navy);
            box-shadow: 0 0 0 2px rgba(26, 42, 108, 0.1);
        }

        .checkout-btn {
            background-color: var(--vibrant-red);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 6px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            transition: var(--transition);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .checkout-btn:hover {
            background-color: var(--soft-red);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(228, 58, 25, 0.2);
        }

        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--pending-yellow);
        }

        .status-completed {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: rgba(17, 31, 77, 0.5);
        }

        .empty-state img {
            max-width: 200px;
            margin-bottom: 1.5rem;
            opacity: 0.7;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            #empcheckoutlist {
                padding: 1rem;
            }

            .checkout-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    <x-menu />

    <div id="empcheckoutlist">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1>Employee Checkout</h1>
            <div style="font-size: 0.9rem; color: var(--light-navy);">
                <span id="current-date-time"></span>
            </div>
        </div>

        @if(count($checkoutdata) > 0)
        <table class="checkout-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee</th>
                    <th>Email</th>
                    <th>Check In Time</th>
                    <th>Checkout Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($checkoutdata as $i)
                <tr>
                    <form class="checkout-form" action="/adminPanel/checkout_emp">
                        @csrf
                        <input type="hidden" name="id" value="{{ $i->id }}" required>
                        <input type="hidden" name="user_id" value="{{ $i->id }}" required>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div style="font-weight: 500;">{{ $i->user->name }}</div>
                            <div style="font-size: 0.8rem; color: rgba(17, 31, 77, 0.7);">ID: {{ $i->id }}</div>
                        </td>
                        <td>{{ $i->user->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($i->entry)->format('d-m-y H:i') }}</td>
                        <td>
                            <input type="datetime-local" name="end" class="datetime-input" required>
                        </td>
                        <td>
                            <button type="submit" class="checkout-btn">
                                Checkout
                                <i class="fas fa-sign-out-alt" style="margin-left: 5px;"></i>
                            </button>
                        </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png" alt="No employees">
            <h3 style="margin-bottom: 0.5rem; color: var(--navy-blue);">No Employees to Checkout</h3>
            <p style="color: rgba(17, 31, 77, 0.6);">All employees have been checked out for today.</p>
        </div>
        @endif
    </div>

    @if(session('success_checkout'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": 5000,
            "extendedTimeOut": 2000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.success("{{ session('success_checkout') }}", "Success!");
    </script>
    @endif

    @if(Session::has('error_checkout'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": 5000,
            "extendedTimeOut": 2000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.error("{{ session('error_checkout') }}", "Error!");
    </script>
    @endif

    <script>
        // Update current date and time
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('current-date-time').textContent = now.toLocaleDateString('en-US', options);
        }

        updateDateTime();
        setInterval(updateDateTime, 60000); // Update every minute
    </script>
</body>

</html>
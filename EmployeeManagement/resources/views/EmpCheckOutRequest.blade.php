<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Request | TimeTracker</title>
    <!-- J query -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr Notification Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        :root {
            --navy-blue: #111F4D;
            --light-gray: #F2F4F7;
            --vibrant-red: #E43A19;
            --deep-black: #020205;
            --gold-accent: #FFD700;
            --soft-white: #FFFFFF;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--light-gray) 0%, #e6e9f0 100%);
            color: var(--deep-black);
            min-height: 100vh;
            display: flex;
            line-height: 1.6;
        }

        .main-container {
            display: flex;
            width: 100%;
        }

        /* Sidebar styling would be handled by the Laravel component */

        .main-content {
            flex: 1;
            padding: 30px;
            margin-left: 0;
            /* Adjust based on your menu width */
        }

        .header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(17, 31, 77, 0.1);
        }

        .header h1 {
            font-size: 32px;
            color: var(--navy-blue);
            margin-bottom: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header h1 i {
            color: var(--gold-accent);
            background: var(--navy-blue);
            padding: 10px;
            border-radius: 10px;
        }

        .header p {
            color: #5a5a5a;
            font-size: 16px;
            max-width: 800px;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
            gap: 25px;
        }

        .checkout-card {
            background: var(--soft-white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 25px;
            transition: var(--transition);
            border-top: 5px solid var(--navy-blue);
            position: relative;
            overflow: hidden;
        }

        .checkout-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--navy-blue), var(--gold-accent));
            opacity: 0;
            transition: var(--transition);
        }

        .checkout-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .checkout-card:hover::before {
            opacity: 1;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .checkin-time {
            font-size: 16px;
            color: var(--navy-blue);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkin-time i {
            color: var(--navy-blue);
            background: rgba(17, 31, 77, 0.1);
            padding: 8px;
            border-radius: 8px;
        }

        .checkout-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-weight: 500;
            color: var(--navy-blue);
            font-size: 14px;
        }

        .datetime-input {
            position: relative;
        }

        .datetime-input input {
            width: 100%;
            padding: 14px 15px;
            border: 2px solid #e1e5eb;
            border-radius: 8px;
            font-size: 15px;
            transition: var(--transition);
            background-color: var(--soft-white);
        }

        .datetime-input input:focus {
            border-color: var(--navy-blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(17, 31, 77, 0.1);
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--navy-blue) 0%, #1a2d6d 100%);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #0a1739 0%, var(--navy-blue) 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(17, 31, 77, 0.2);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #777;
            background: var(--soft-white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-top: 30px;
        }

        .empty-state i {
            font-size: 60px;
            margin-bottom: 20px;
            color: #ccc;
        }

        .empty-state p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .empty-state .action-btn {
            display: inline-block;
            padding: 12px 24px;
            background: var(--navy-blue);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
        }

        .empty-state .action-btn:hover {
            background: #0a1739;
            transform: translateY(-2px);
        }

        @media (max-width: 1100px) {
            .cards-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }

            .header h1 {
                font-size: 26px;
            }

            .checkout-form {
                flex-direction: column;
                align-items: stretch;
            }

            .datetime-input {
                min-width: 100%;
            }
        }

        /* Toastr customization */
        .toast-success {
            background-color: #4CAF50 !important;
        }

        .toast-error {
            background-color: var(--vibrant-red) !important;
        }

        /* Animation for cards */
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

        .checkout-card {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .checkout-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .checkout-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .checkout-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .checkout-card:nth-child(4) {
            animation-delay: 0.4s;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- Laravel menu component -->
        <x-emp-menu />

        <div class="main-content">

            <div class="cards-container">
                @forelse($checkouts as $i)
                <div class="checkout-card">
                    <div class="card-header">
                        <div class="checkin-time">
                            <i class="far fa-clock"></i>
                            Check In: {{ $i->entry }}
                        </div>
                    </div>
                    <form action="/ask_checkout" method="post" class="checkout-form">
                        @csrf
                        <div class="form-group">
                            <label for="checkout-{{ $loop->index }}">Select Checkout Time</label>
                            <div class="datetime-input">
                                <input type="datetime-local" name="checkout" id="checkout-{{ $loop->index }}" required>
                            </div>
                        </div>
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            Submit Request
                        </button>
                    </form>
                </div>
                @empty
                <div class="empty-state">
                    <i class="far fa-calendar-alt"></i>
                    <p>No check-in records found</p>
                    <p>You need to check in first before requesting a checkout</p>
                    <a href="#" class="action-btn">Check In Now</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    @if (session()->has('success'))
    <script>
        toastr.success("{{ session('success') }}", "Success", {
            closeButton: true,
            progressBar: true,
            timeOut: 5000,
            extendedTimeOut: 2000,
            positionClass: "toast-bottom-right"
        });
    </script>
    @endif

    @if (session()->has('error'))
    <script>
        toastr.error("{{ session('error') }}", "Error", {
            closeButton: true,
            progressBar: true,
            timeOut: 5000,
            extendedTimeOut: 2000,
            positionClass: "toast-bottom-right"
        });
    </script>
    @endif

    <script>
        // Set minimum datetime to current time
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            // Format to YYYY-MM-DDTHH:MM (datetime-local input format)
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');

            const minDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

            // Set min attribute for all datetime inputs
            const datetimeInputs = document.querySelectorAll('input[type="datetime-local"]');
            datetimeInputs.forEach(input => {
                input.min = minDateTime;
            });
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <style>
        :root {
            --navy-blue: #111F4D;
            --light-gray: #F2F4F7;
            --vibrant-red: #E43A19;
            --deep-black: #020205;
            --gold-accent: #FFD700;
            --soft-white: #FFFFFF;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--deep-black);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background-color: var(--soft-white);
            width: 100%;
            max-width: 600px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(1, 31, 77, 0.2);
            border-top: 5px solid var(--vibrant-red);
            position: relative;
            overflow: hidden;
        }

        form::before {
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

        pre {
            background-color: var(--navy-blue);
            color: var(--light-gray);
            padding: 20px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
        }

        input[type="text"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid var(--light-gray);
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: var(--navy-blue);
            box-shadow: 0 0 0 3px rgba(17, 31, 77, 0.2);
        }

        input[type="text"]::placeholder {
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
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: var(--vibrant-red);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(228, 58, 25, 0.3);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--navy-blue);
        }

        @media (max-width: 768px) {
            form {
                padding: 30px 20px;
                margin: 20px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <form action="/user_details" method="post">
        <h1>Enter Employee Details</h1>

        <pre>
            Name : {{ $data->name }}
            Email : {{ $data->email }}
        </pre>

        @csrf
        <input type="hidden" name="user_id" value="{{ $data->id }}">

        <div class="form-group">
            <input type="text" name="post" placeholder="Enter Post" required>
        </div>

        <div class="form-group">
            <input type="text" name="mobile" placeholder="Enter Mobile Number" required>
        </div>

        <div class="form-group">
            <input type="text" name="address" placeholder="Enter Address" required>
        </div>

        <div class="form-group">
            <input type="text" name="qualificatio" placeholder="Enter Qualification" required>
        </div>

        <div class="form-group">
            <input type="text" name="exp" placeholder="Enter Years of Experience" required>
        </div>

        <div class="form-group">
            <input type="date" name="joining_date" placeholder="Enter Joining Date" required>
        </div>

        <input type="submit" value="Submit Details">
    </form>
    @if ($errors->any())

    @foreach ($errors->all() as $i)
    <div style="color: red;">
        <script>
            alert("{{ $i }}")
        </script>
    </div>
    @endforeach

    @endif
</body>

</html>
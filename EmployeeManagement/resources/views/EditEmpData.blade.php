<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee Data</title>
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
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: var(--deep-black);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .update-container {
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 30rem;
            padding-right: 30rem;
            padding-top: 0rem;
            padding-bottom: 0rem;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .header h1 {
            font-size: 2.5rem;
            color: var(--navy-blue);
            margin-bottom: 1rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .header::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--vibrant-red), var(--gold-accent));
            margin: 0 auto;
            border-radius: 2px;
        }

        .employee-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

        .employee-card {
            background: var(--soft-white);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(17, 31, 77, 0.08);
            padding: 2rem;
            border-left: 4px solid var(--vibrant-red);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
        }

        .employee-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(17, 31, 77, 0.15);
        }

        .employee-id {
            display: inline-block;
            background-color: var(--navy-blue);
            color: var(--soft-white);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            color: var(--navy-blue);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
            background-color: #f8fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--navy-blue);
            box-shadow: 0 0 0 3px rgba(17, 31, 77, 0.1);
            background-color: var(--soft-white);
        }

        .admin-toggle {
            display: flex;
            align-items: center;
            margin-top: 0.5rem;
        }

        .admin-toggle input {
            width: 60px;
            margin-right: 1rem;
            text-align: center;
        }

        .toggle-note {
            font-size: 0.8rem;
            color: var(--vibrant-red);
            font-weight: 500;
        }

        .update-btn {
            background: linear-gradient(135deg, var(--navy-blue), #1a2b6d);
            color: var(--soft-white);
            border: none;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 1rem;
        }

        .update-btn:hover {
            background: linear-gradient(135deg, #0a1435, var(--navy-blue));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(17, 31, 77, 0.2);
        }

        .card-decoration {
            position: absolute;
            top: 0;
            right: 0;
            width: 60px;
            height: 60px;
            background-color: rgba(228, 58, 25, 0.1);
            border-bottom-left-radius: 100%;
        }

        @media (max-width: 768px) {
            .employee-grid {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="update-container">

        <div class="employee-grid">
            @foreach ($data as $i)
            <form action="/editedData/{{ $i->id }}" method="post" class="employee-card">
                @csrf
                <input type="hidden" name="_method" value="put" required>

                <div class="card-decoration"></div>
                <div class="employee-id">ID: {{ $i->id }}</div>

                <div class="form-group">
                    <label for="post-{{ $i->id }}">Position</label>
                    <input type="text" class="form-control" id="post-{{ $i->id }}" name="post" value="{{ $i->post }}" required>
                </div>

                <div class="form-group">
                    <label for="mobile-{{ $i->id }}">Mobile</label>
                    <input type="text" class="form-control" id="mobile-{{ $i->id }}" name="mobile" value="{{ $i->mobile }}" required>
                </div>

                <div class="form-group">
                    <label for="address-{{ $i->id }}">Address</label>
                    <input type="text" class="form-control" id="address-{{ $i->id }}" name="address" value="{{ $i->address }}" required>
                </div>

                <div class="form-group">
                    <label for="qualificatio-{{ $i->id }}">Qualification</label>
                    <input type="text" class="form-control" id="qualificatio-{{ $i->id }}" name="qualificatio" value="{{ $i->qualificatio }}" required>
                </div>

                <div class="form-group">
                    <label for="exp-{{ $i->id }}">Experience (Years)</label>
                    <input type="text" class="form-control" id="exp-{{ $i->id }}" name="exp" value="{{ $i->exp }}" required>
                </div>

                <div class="form-group">
                    <label>Admin Privileges</label>
                    <div class="admin-toggle">
                        <input type="number" class="form-control" name="isAdmin" value="{{ $i->isAdmin }}" min="0" max="1" step="1" required>
                        <span class="toggle-note">1 = Admin, 0 = User</span>
                    </div>
                </div>

                <button type="submit" class="update-btn">Update Profile</button>
            </form>
            @endforeach
        </div>
    </div>
</body>

</html>
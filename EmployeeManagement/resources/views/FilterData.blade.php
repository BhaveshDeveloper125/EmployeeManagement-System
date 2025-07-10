<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filteration of Data</title>
    <style>
        .filterationcontainer {
            height: 100vh;
            width: 100vw;
            display: flex;
        }

        .ok {
            flex: 1;
        }

        .employeeDataContainer {
            height: 50%;
            width: 50%;
        }
    </style>
</head>

<body>

    <div class="filterationcontainer">
        <x-menu />
        <div class="ok">
            <div style="width: 100%; background-color: red;">
                <form action="/emp_attendance_records/{{ Auth::id() }}" method="post">
                    @csrf
                    <input type="date" name="from" id="" required>
                    <input type="date" name="to" id="" required>
                    <input type="submit" value="Submit">
                </form>
            </div>

            <div class="employeeDataContainer">
                @if ($attendances)
                {{ $attendances->name }}
                <br>
                {{ $attendances->email }}
                <br>

                @foreach ($attendances->extraUserData as $i)
                {{ $i->post }}
                <br>
                {{ $i->mobile }}
                <br>
                {{ $i->address }}
                <br>
                {{ $i->qualificatio }}
                <br>
                {{ $i->exp }}
                <br>
                {{ $i->joining_date }}
                <br>
                {{ $i->leaves }}
                <br>
                @endforeach

                @endif
            </div>

            <table border="1">
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Checkin</th>
                    <th>Checkout</th>
                </tr>
                @forelse($record as $i)
                <tr>
                    <td>{{ $i->entry }}</td>
                    <td>{{ $i->entry }}</td>
                    <td>{{ $i->entry }}</td>
                    <td>{{ $i->leave }}</td>
                </tr>
                @empty
                <tr>
                    <td>Empty</td>
                </tr>
                @endforelse
                <tr>
                    <td style="text-align: center;" colspan="4">
                        {{ $record->links() }}
                    </td>
                </tr>

            </table>
        </div>
    </div>

</body>

</html>
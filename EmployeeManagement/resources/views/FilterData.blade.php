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
    </style>
</head>

<body>

    <div class="filterationcontainer">
        <x-menu />
        <div class="ok">
            <div style="width: 100%; background-color: red;">All filters here</div>
            <table border="1">
                <tr>
                    <th>name</th>
                    <th>Email</th>
                    <th>Checkin</th>
                    <th>Checkout</th>
                </tr>
                @forelse($users as $i)
                <tr>
                    <td>{{ $i->name }}</td>
                    <td>{{ $i->email }}</td>
                    @forelse($i->employeTimeWatcher as $j)
                    <td>{{ $j->entry }}</td>
                    <td>{{ $j->leave }}</td>
                    @empty
                    <td>Empty</td>
                    <td>Empty</td>
                    @endforelse
                </tr>
                @empty
                <tr>
                    <td colspan="4">Empty</td>
                </tr>
                @endforelse
            </table>
            {{ $users->links() }}
        </div>
    </div>

</body>

</html>
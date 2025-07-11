<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .settings-container {
            height: 100vh;
            width: 100vw;
            display: flex;
        }

        .set-container {
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="settings-container">
        <x-menu />
        <div class="set-container">
            <form action="/set_setting" method="post">
                @csrf
                <input type="text" name="baseUrl" placeholder="Enter baseurl"> <br>
                <input type="file" name="logo" placeholder="Logo"> <br>
                <input type="text" name="appName" placeholder="app name"> <br>
                <input type="text" name="wifiName" placeholder="Wifi name"> <br>
                <input type="submit" value="Update">
            </form>
            <h1>set office Timing</h1>
            <form action="/set_time" method="post">
                @csrf
                <label for="">From</label>
                <input type="time" name="from" required />
                <label for="">To</label>
                <input type="time" name="to" required />
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>
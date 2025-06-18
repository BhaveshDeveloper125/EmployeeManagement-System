<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management</title>
</head>
<body>
    <h1>Leave Management</h1>
    <form action="/ask_leave" method="post">

    <input type="text" name="name" placeholder="Enter Name" required> <br><br>
    <input type="hidden" name="name" value="{{ Auth::id() }}" placeholder="Enter Name" readonly required> <br><br>
    <input type="text" name="department" id="" placeholder="Enter Department Name" required> <br><br>
    
    <select name="type" id="" required>
        <option value="medical_leave">Mediacal Leaves</option>
        <option value="half_leave">Casual Leaves</option>
    </select>
    
    <br><br>
    <input type="date" name="from" id="" placeholder="from" required> <br><br>
    <input type="date" name="to" id="" placeholder="to" required> <br><br>

    <select name="duration" id="" required>
        <option value="half_day">Half Day</option>
        <option value="full_day">Full Day</option>
    </select>

    <br><br>

    <textarea name="reason" id="" placeholder="Enter the Reason for this leave/leaves" required>

    </textarea>

    <br><br>

    <input type="submit" value="Submit">




    </form>

    <div>
        <h1>Leaves This Month</h1>
    <div>
        Status : Pending/Approved/Rejected
    </div>
    </div>

</body>
</html>
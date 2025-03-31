@foreach ($data as $i)
<form action="/editedData" method="post">
    @csrf
    Position : <input type="text" name="post" value={{ $i->post }} placeholder="Enter Post" required> <br><br>
    Mobile : <input type="text" name="mobile" value={{ $i->mobile }} placeholder="Enter Mobile" required> <br><br>
    Address : <input type="text" name="address" value={{ $i->address }} placeholder="Enter Address" required> <br><br>
    Qualification : <input type="text" name="qualificatio" value={{ $i->qualificatio }} placeholder="Enter Qualification" required> <br><br>
    Experience : <input type="text" name="exp" value={{ $i->exp }} placeholder="Enter Experience" required> <br><br>
    Make Admin : <input type="number" name="isAdmin" value={{ $i->isAdmin }} placeholder="Make users Admin" min="0" max="1" step="1" required>Type 1 to make Users admin or Type 0 to make Admin a normal user <br><br>
    <input type="submit" value="Submit">
</form>
@endforeach
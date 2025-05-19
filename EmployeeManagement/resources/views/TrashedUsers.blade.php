<h1>TrashedUser</h1>

<pre>
{{ $users }}

<table border="1">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>Restore</th>
        <th>Delete</th>
    </tr>
    <tr>
        @foreach ($users as $i)
        <th>{{ $i->id }}</th>
        <th>{{ $i->name }}</th>
        <th>{{ $i->email }}</th>
        <th> <a href="{{ "/restore/{$i->id}" }}">Restore</a> </th>
        <th> <a href="{{ $i->id }}">Delete</a> </th>
        @endforeach
    </tr>
</table>

</pre>
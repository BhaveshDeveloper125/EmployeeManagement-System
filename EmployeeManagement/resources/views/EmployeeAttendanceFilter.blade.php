<h1>EmployeeAttendance Filter</h1>

@if(isset($attend) && isset($user) && isset($extra) && isset($time))
<p>Attend : {{ $attend }}</p>

<div>
    {{ $user->name }}
    {{ $user->email }}

    @foreach ($extra as $i)
    {{ $i->post }}
    {{ $i->mobile }}
    {{ $i->address }}
    {{ $i->qualificatio }}
    @endforeach
</div>

<h1>{{ $time->from }}</h1>
<h1>{{ $time->to }}</h1>





<table border="1">
    <tr>
        <th>Sr No</th>
        <th>Entry</th>
        <th>Leave</th>
        <th>Statu</th>
    </tr>
    @foreach ($attend as $i)
    <tr>
        <td>

        </td>
        <td>
            {{ $i->entry }}
        </td>
        <td>
            {{ $i->leave }}
        </td>

        <td>
            @if ($i->entry > $time->from)
            <b>Late</b>
            @endif

            @if ($i->entry)

            @endif

            @if ($i->leave < $time->to)
                <b>Early Leave</b>
                @endif

                @if ($i->entry < $time->from && $i->leave >= $time->to)
                    <b>OK</b>
                    @else
                    <b> </b>
                    @endif

        </td>
    </tr>
    @endforeach
</table>


@else
<p>Error while fetching or Receiving Data</p>
@endif
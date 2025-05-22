<h1>EmployeeAttendance Filter</h1>

@if(isset($attend) && isset($user) && isset($extra) && isset($time))

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
        <th>Status</th>
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

            @if ($i->entry < $time->from)
                <b>Early working start</b>
                @endif

                @if ($i->leave < $time->to)
                    <b>Early Leave</b>
                    @endif


                    @if ($i->leave > $time->to)
                    <b>Over Time</b>
                    @endif

        </td>
    </tr>
    @endforeach
</table>


@elseif(isset($late))
<h1>Late Attendance of Current Month</h1>
<table border="1">
    <tr>
        <th>Sr no</th>
        <th>Date</th>
        <th>Entry</th>
        <th>Leave</th>
    </tr>
    @foreach ($late as $i)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ Carbon\Carbon::parse($i->entry)->format('d-m-y')}}</td>
        <td>{{ Carbon\Carbon::parse($i->entry)->format('h-i-A')}}</td>
        <td>{{ $i->leave ?  Carbon\Carbon::parse($i->leave)->format('h-i-A') : 'Working' }}</td>
    </tr>
    @endforeach
</table>
@elseif(isset($early))
<h1> Early Leave of this Month </h1>
<table border="1">
    <tr>
        <th>Sr no</th>
        <th>Date</th>
        <th>Entry</th>
        <th>Leave</th>
    </tr>
    @foreach ($early as $i)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ Carbon\Carbon::parse($i->entry)->format('d-m-y') }}</td>
        <td>{{ Carbon\Carbon::parse($i->entry)->format('h-i-s') }}</td>
        <td>{{ Carbon\Carbon::parse($i->leave)->format('h-i-s') }}</td>
    </tr>
    @endforeach
</table>

@elseif(isset($overtime))
<h1>Overtime</h1>
{{ $overtime }}

<table border="1">
    <tr>
        <th>Sr no</th>
        <th>Date</th>
        <th>Entry</th>
        <th>Leave</th>
    </tr>
    @foreach ($overtime as $i)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ Carbon\Carbon::parse($i->leave)->format('d-m-y') }}</td>
        <td>{{ Carbon\Carbon::parse($i->entry)->format('h-i-s') }}</td>
        <td>{{ Carbon\Carbon::parse($i->leave)->format('h-i-s') }}</td>
    </tr>
    @endforeach
</table>

@else
<p>{{ $message }}</p>
@endif
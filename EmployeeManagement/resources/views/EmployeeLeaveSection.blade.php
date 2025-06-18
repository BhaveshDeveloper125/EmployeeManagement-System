<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Emp Leaves</title>
</head>

<body>
    <a href="" class="nav-link dropdown-toggle" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-bell"></i>
        @if (auth()->user()->unreadNotifications->count() > 0)
        <span class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
        @endif

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
            @if (auth()->user()->unreadNotifications->count() > 0)
            <li class="dropdown-item">
                <a href="/mark_as_read" class="btn btn-sm btn-success">Mark All as Read</a>
            </li>
            @foreach (auth()->user()->unreadNotifications as $notification)
            <li class="dropdown-item">
                <a href="{{ $notification->data['url'] ?? '#' }}">{{ $notification->data['message'] }}</a>
            </li>
            @endforeach
            @else
            <li class="dropdown-item">No new notifications</li>
            @endif
        </ul>
    </a>
</body>

</html>
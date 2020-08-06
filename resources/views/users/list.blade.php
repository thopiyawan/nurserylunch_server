<!doctype html>
<html>
    <body>
        <h1 class="page-title">All users</h1>
        <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} / {{ $user->email }} //  {{ $user->setting->is_weekday }}</li>

        @endforeach
        </ul>
    </body>
</html>


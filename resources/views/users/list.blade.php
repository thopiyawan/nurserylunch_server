<!doctype html>
<html>
    <body>
        <h1>All users</h1>
        <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} / {{ $user->email }}</li>
        @endforeach
        </ul>
    </body>
</html>

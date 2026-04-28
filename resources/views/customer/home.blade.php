<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h1>Selamat datang, {{ auth()->user()->name }}!</h1>
    <p>Role: {{ auth()->user()->role }}</p>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
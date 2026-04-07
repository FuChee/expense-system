

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h2>Welcome, {{ auth()->user()->name }}</h2>

    <a href="/categories">Go to Categories</a>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    @vite(['resources/css/home-style.css'])
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div>
            <div class="brand">Expense System</div>

            <div class="nav-links">
                <a href="/home">Dashboard</a>
                <a href="/expenses/index">Expenses</a>
                <a href="/expenses/create">Add Expense</a>
                <a href="/categories">Categories</a>
                <a href="/users" class="active">View Users</a>
            </div>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
            <h1>Edit User</h1>
            <a href="/users" class="btn">Back</a>
        </div>

        <div class="card">
            <form method="POST" action="/users/{{ $user->id }}">
                @csrf
                @method('PUT')

                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn">Update User</button>
            </form>
        </div>
    </main>
</div>
</body>
</html>
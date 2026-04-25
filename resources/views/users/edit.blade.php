<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    @vite(['resources/css/add-user-style.css'])
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div>
            <div class="brand">Expense System</div>

            <div class="nav-links">
                <a href="/home" class="active">Dashboard</a>
                <a href="/expenses/index">My Expenses</a>
                <a href="/expenses/create">Add Expense</a>
                <a href="/categories">My Categories</a>
                @can('isAdmin')
                    <a href="/users">View Users</a>
                @endcan
            </div>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
            <h1>Edit User</h1>
            <a href="/users" class="back">Back to View Users</a>
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
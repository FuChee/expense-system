<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    @vite(['resources/css/add-user-style.css'])
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
            <h1>Add User</h1>
            <a href="/users" class="back">Back to View Users</a>
        </div>

        <div class="card">
            <form method="POST" action="/users">
                @csrf

                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label>Password</label>
                <input type="password" name="password" required>

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label>Role</label>
                <select name="role" required>
                    <option value="user">User</option>
                    <option value="author">Author</option>
                    <option value="admin">Admin</option>
                </select>

                @error('role')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn">Add User</button>
            </form>
        </div>
    </main>
</div>
</body>
</html>
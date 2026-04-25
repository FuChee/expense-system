<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    @vite(['resources/css/view-user-style.css'])
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
            <h1>Users</h1>
            <a href="/users/create" class="btn-add">+ Add User</a>
        </div>

        <div class="card">

            <form method="GET" action="/users" class="filter-form">
                <input
                    type="text"
                    name="search"
                    placeholder="Search by name or email"
                    value="{{ request('search') }}"
                >

                <select name="role">
                    <option value="">All Roles</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>

                <button type="submit" class="btn">Search</button>
                <a href="/users" class="btn">Reset</a>
            </form>

            <table border="1" cellpadding="10" width="100%">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>

                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="/users/{{ $user->id }}/edit" class="btn-edit">Edit</a>

                        <form method="POST" action="/users/{{ $user->id }}" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>

        </div>
    </main>
</div>
</body>
</html>
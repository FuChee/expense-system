<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
</head>
<body>
    <h2>My Categories</h2>

    <a href="/home">Back to Home</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h3>Add New Category</h3>
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Type:</label><br>
        <select name="type">
            <option value="expense">Expense</option>
            <option value="income">Income</option>
        </select><br><br>

        <button type="submit">Add Category</button>
    </form>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h3>Your Categories</h3>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->type }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}">Edit</a>

                        <form method="POST" action="{{ route('categories.destroy', $category) }}" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No categories yet. Add one above!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
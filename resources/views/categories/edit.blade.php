<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
</head>
<body>
    <h2>Edit Category</h2>

    <a href="{{ route('categories.index') }}">Back to Categories</a>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf
        @method('PUT')

        <label>Name:</label><br>
        <input type="text" name="name" value="{{ $category->name }}"><br><br>

        <label>Type:</label><br>
        <select name="type">
            <option value="expense" {{ $category->type == 'expense' ? 'selected' : '' }}>Expense</option>
            <option value="income" {{ $category->type == 'income' ? 'selected' : '' }}>Income</option>
        </select><br><br>

        <button type="submit">Update Category</button>
    </form>

</body>
</html>
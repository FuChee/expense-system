<!DOCTYPE html>
<html>
<head>
    <title>Edit Expense</title>
</head>
<body>
    <h2>Edit Expense</h2>

    <a href="{{ route('expenses.index') }}">Back to Expenses</a>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('expenses.update', $expense) }}">
        @csrf
        @method('PUT')

        <label>Category:</label><br>
        <select name="category_id">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $expense->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }} ({{ $category->type }})
                </option>
            @endforeach
        </select><br><br>

        <label>Amount (RM):</label><br>
        <input type="number" name="amount" step="0.01" min="0" value="{{ $expense->amount }}"><br><br>

        <label>Description:</label><br>
        <input type="text" name="description" value="{{ $expense->description }}"><br><br>

        <label>Date:</label><br>
        <input type="date" name="transaction_date" value="{{ $expense->transaction_date->format('Y-m-d') }}"><br><br>

        <button type="submit">Update Expense</button>
    </form>

</body>
</html>
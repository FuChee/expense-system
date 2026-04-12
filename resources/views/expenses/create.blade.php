<!DOCTYPE html>
<html>
<head>
    <title>Add Expense</title>
</head>
<body>
    <h2>Add New Expense</h2>

    <a href="{{ route('expenses.index') }}">Back to Expenses</a>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('expenses.store') }}">
        @csrf

        <label>Category:</label><br>
        <select name="category_id">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->type }})</option>
            @endforeach
        </select><br><br>

        <label>Amount (RM):</label><br>
        <input type="number" name="amount" step="0.01" min="0" value="{{ old('amount') }}"><br><br>

        <label>Description:</label><br>
        <input type="text" name="description" value="{{ old('description') }}"><br><br>

        <label>Date:</label><br>
        <input type="date" name="transaction_date" value="{{ old('transaction_date') }}"><br><br>

        <button type="submit">Save Expense</button>
    </form>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Expenses</title>
</head>
<body>
    <h2>My Expenses</h2>

    <a href="/home">Back to Home</a> |
    <a href="{{ route('expenses.create') }}">Add New Expense</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($expenses as $expense)
                <tr>
                    <td>{{ $expense->transaction_date->format('Y-m-d') }}</td>
                    <td>{{ $expense->category->name }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>RM {{ number_format($expense->amount, 2) }}</td>
                    <td>
                        <a href="{{ route('expenses.edit', $expense) }}">Edit</a>

                        <form method="POST" action="{{ route('expenses.destroy', $expense) }}" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No expenses found. Add one!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
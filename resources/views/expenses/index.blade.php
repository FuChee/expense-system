<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Expenses</title>
        @vite(['resources/css/view-expense-style.css'])
    </head>
    <body>
        <div class="container">
            <a href="/home" class="back">Back to Dashboard</a>

            <div class="header">
                <h2>My Expenses</h2>

                <a href="/expenses/create" class="btn-add">
                    + Add Expense
                </a>
            </div>

            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Amount (RM)</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($expenses as $expense)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td class="amount">
                                    RM {{ number_format($expense->amount, 2) }}
                                </td>

                                <td>
                                    {{ $expense->category->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $expense->transaction_date }}
                                </td>

                                <td>
                                    {{ $expense->description ?? '-' }}
                                </td>

                                <td class="actions">
                                    <a href="/expenses/{{ $expense->id }}/edit" class="btn-edit">
                                        Edit
                                    </a>

                                    <form action="/expenses/{{ $expense->id }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn-delete"
                                            onclick="return confirm('Delete this expense?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty">
                                    No expenses found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
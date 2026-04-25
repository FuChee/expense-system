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

            <div style="margin-bottom: 10px; font-size: 14px; color: #555;">
                Sort by: 
                <strong>
                    {{ $sort == 'amount' ? 'Amount' : 'Date' }}
                </strong>
                ({{ $direction == 'asc' ? 'Ascending ↑' : 'Descending ↓' }})

            </div>
                <form method="GET" action="/expenses/index" style="margin-bottom: 10px;">
                    <label>Filter by Category:</label>

                    <select name="category" onchange="this.form.submit()">
                        <option value="">All</option>

                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" 
                                {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- keep sorting -->
                    <input type="hidden" name="sort" value="{{ $sort }}">
                    <input type="hidden" name="direction" value="{{ $direction }}">
                </form>

            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>
                                <a href="?sort=amount&direction={{ $sort == 'amount' && $direction == 'asc' ? 'desc' : 'asc' }}" class="sort-link">
                                    Amount (RM)
                                    @if($sort == 'amount')
                                        {{ $direction == 'asc' ? '↑' : '↓' }}
                                    @else
                                        ⇅
                                    @endif
                                </a>
                            </th>
                            <th>Category</th>
                            <th>
                                <a href="?sort=transaction_date&direction={{ $sort == 'transaction_date' && $direction == 'asc' ? 'desc' : 'asc' }}" class="sort-link">
                                    Date
                                    @if($sort == 'transaction_date')
                                        {{ $direction == 'asc' ? '↑' : '↓' }}
                                    @else
                                        ⇅
                                    @endif
                                </a>
                            </th>
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
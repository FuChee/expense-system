<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Expense</title>
        @vite(['resources/css/edit-expense-style.css'])
    </head>
    <body>
        <div class="container">
            <a href="/expenses/index" class="back">Back to Expenses</a>

            <div class="card">
                <h2>Edit Expense</h2>
                <p class="subtitle">Update your expense details below.</p>

                <form method="POST" action="/expenses/{{ $expense->id }}">
                    @csrf
                    @method('PUT')

                    <label for="amount">Amount (RM)</label>
                    <input
                        type="number"
                        id="amount"
                        name="amount"
                        step="0.01"
                        value="{{ old('amount', $expense->amount) }}"
                        required
                    >
                    @error('amount')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id', $expense->category_id) == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <label for="date">Date</label>
                    <input
                        type="date"
                        id="date"
                        name="date"
                        value="{{ old('date', $expense->transaction_date ? \Carbon\Carbon::parse($expense->transaction_date)->format('Y-m-d') : '') }}"
                        required
                    >
                    @error('date')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <label for="description">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Optional"
                    >{{ old('description', $expense->description) }}</textarea>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <div class="actions">
                        <button type="submit" class="btn-save">Update Expense</button>
                        <a href="/expenses/index" class="btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
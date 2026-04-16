<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Expense</title>
        @vite(['resources/css/add-expense-style.css'])
    </head>
    <body>
        <div class="container">
            <a href="/home" class="back">Back to Dashboard</a>

            <h2>Add New Expense</h2>

            <form method="POST" action="/expenses">
                @csrf

                <!-- Amount -->
                <label>Amount (RM)</label>
                <input type="number" name="amount" step="0.01" required>
                @error('amount') <div class="error">{{ $message }}</div> @enderror

                <!-- Category -->
                <label>Category</label>
                <select name="category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="error">{{ $message }}</div> @enderror

                <!-- Date -->
                <label>Date</label>
                <input type="date" name="date" required>
                @error('date') <div class="error">{{ $message }}</div> @enderror

                <!-- Description -->
                <label>Description</label>
                <input type="text" name="description" placeholder="Optional">

                <!-- Submit -->
                <button type="submit" class="btn">Add Expense</button>
            </form>
        </div>
    </body>
</html>
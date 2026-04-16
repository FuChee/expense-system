<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Category | Personal Expense System</title>
        @vite(['resources/css/edit-category.css'])
    </head>
    <body>
        <div class="page">
            <div class="card">
                <div class="card-header">
                    <h1>Edit Category</h1>
                    <p>Update the selected category information below.</p>
                </div>

                <div class="card-body">
                    <div class="info-box">
                        You are editing category: <strong>{{ $category->name }}</strong>
                    </div>

                    <form method="POST" action="/categories/{{ $category->id }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $category->name) }}"
                                placeholder="Enter category name"
                            >
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="actions">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                            <a href="/categories" class="btn btn-light">Cancel</a>
                        </div>
                    </form>

                    <div class="meta">
                        <div><strong>Category ID:</strong> {{ $category->id }}</div>
                        <div><strong>Created At:</strong> {{ $category->created_at ? $category->created_at->format('d M Y, h:i A') : '-' }}</div>
                        <div><strong>Last Updated:</strong> {{ $category->updated_at ? $category->updated_at->format('d M Y, h:i A') : '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
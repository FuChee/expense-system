<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Category</title>
        @vite(['resources/css/category.css'])
    </head>
    <body>
        <div class="page">
            <div class="topbar">
                <div class="title-group">
                    <h1>Categories</h1>
                    <p>Manage your expense categories for better organization.</p>
                </div>

                <a href="/home" class="btn btn-light">Back to Dashboard</a>
            </div>

            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid">
                <!-- Add Category Form -->
                <div class="card">
                    <h2>Add Category</h2>

                    <form method="POST" action="/categories">
                        @csrf

                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                placeholder="e.g. Food, Transport, Bills"
                                value="{{ old('name') }}"
                            >
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </form>
                </div>

                <!-- Category List -->
                <div class="card">
                    <h2>Category List</h2>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="category-badge">{{ $category->name }}</span>
                                        </td>
                                        <td>{{ $category->created_at ? $category->created_at->format('d M Y') : '-' }}</td>
                                        <td>
                                            <div class="action-group">
                                                <a href="/categories/{{ $category->id }}/edit" class="btn btn-light">Edit</a>

                                                <form method="POST" action="/categories/{{ $category->id }}" class="inline-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this category?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="empty">No categories added yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
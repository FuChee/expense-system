<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    @vite(['resources/css/profile.css'])
</head>
<body>
    <div class="page">
        <div class="topbar">
            <div class="title-group">
                <h1>Edit Profile</h1>
                <p>Update your account information.</p>
            </div>

            <a href="/profile" class="btn btn-light">Back to Profile</a>
        </div>

        <div class="grid">
            <div class="card">
                <h2>Edit Information</h2>

                <form method="POST" action="/profile">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name"
                            value="{{ old('name', auth()->user()->name) }}"
                        >
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input 
                            type="text" 
                            name="email" 
                            id="email"
                            value="{{ old('email', auth()->user()->email) }}"
                        >
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update Profile
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
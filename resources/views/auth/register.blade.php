<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    @vite(['resources/css/register-style.css'])
</head>
<body>

<div class="card">
    <h2>Create Account</h2>
    <div class="subtitle">Register to start tracking your expenses</div>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf
        
        <div class="form-group @error('name') error @enderror">
            <label for="name">Full Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                placeholder="Enter your full name" 
                value="{{ old('name') }}"
                required
            >
            @error('name')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group @error('email') error @enderror">
            <label for="email">Email Address</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Enter your email" 
                value="{{ old('email') }}"
                required
            >
            @error('email')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group @error('password') error @enderror">
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                placeholder="Minimum 6 characters" 
                required
            >
            @error('password')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Create Account</button>
    </form>

    <div class="footer">
        <p>Already have an account? <a href="/login">Login here</a></p>
    </div>
</div>

</body>
</html>
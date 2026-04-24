<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    @vite(['resources/css/login-style.css'])
</head>
<body>

<div class="card">
    <h2>Welcome Back</h2>
    <div class="subtitle">Login to your account</div>

    @if (Session::get('success'))
        <div class="success">
            {{ Session::get('success') }}
        </div>
    @endif

    @isset($url)
        <form method="POST" action="{{ url('login/'.$url) }}">
    @else
        <form method="POST" action="{{ url('/login') }}">
    @endisset
        @csrf
        
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
                placeholder="Enter your password" 
                required
            >
            @error('password')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="footer">
        <p>Don't have an account? <a href="/register">Register here</a></p>
    </div>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    @vite(['resources/css/profile.css'])
</head>
<body>
    <div class="page">
        <div class="topbar">
            <div class="title-group">
                <h1>My Profile</h1>
                <p>View your account information.</p>
            </div>

            <a href="/home" class="btn btn-light">Back to Dashboard</a>
        </div>

        <div class="grid">
            <div class="card">
                <h2>User Information</h2>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" value="{{ $user->name }}" disabled>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" value="{{ $user->email }}" disabled>
                </div>

                <a href="/profile/edit" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>
</body>
</html>
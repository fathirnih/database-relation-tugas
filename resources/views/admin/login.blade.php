<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .error { color: red; }
        form div { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Login Admin</h2>

    {{-- Tampilkan error --}}
    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    {{-- Tampilkan success --}}
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <small style="color:red">{{ $message }}</small> @enderror
        </div>

        <div>
            <label>Password:</label><br>
            <input type="password" name="password" required>
            @error('password') <small style="color:red">{{ $message }}</small> @enderror
        </div>

        <button type="submit">Login</button>
    </form>
</body>
</html>

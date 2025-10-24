<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Argon Dashboard --}}
    <link href="https://cdn.jsdelivr.net/npm/@creative-tim-official/argon-dashboard@2.0.5/assets/css/argon-dashboard.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #172b4d, #1a174d);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="card">
                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <h4 class="text-dark fw-bold">Login Admin</h4>
                            <p class="text-muted">Masuk untuk mengelola website</p>
                        </div>

                        {{-- Tampilkan error --}}
                        @if(session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Tampilkan success --}}
                        @if(session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.login.submit') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email"
                                       value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Login</button>
                            </div>
                        </form>

                    </div>
                </div>

                <p class="text-center text-light mt-4 small">
                    &copy; 2025 King Dev — Argon Dashboard Theme
                </p>

            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

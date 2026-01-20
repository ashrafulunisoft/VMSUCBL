<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f8f9fa;
        }
        .form-signin {
            width: 100%;
            max-width: 360px;
            padding: 2rem;
            margin: auto;
        }
        .form-signin .btn {
            margin-top: 1rem;
        }
    </style>
</head>
<body class="text-center">

    <main class="form-signin">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger text-start">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Session Status (e.g., "You have been logged out.") -->
        @if (session('status'))
            <div class="alert alert-success text-start">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-floating mb-3">
                <input
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="name@example.com"
                >
                <label for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback text-start">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-floating mb-3">
                <input
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    id="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Password"
                >
                <label for="password">Password</label>
                @error('password')
                    <div class="invalid-feedback text-start">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-check text-start mb-3">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="remember_me"
                    name="remember"
                >
                <label class="form-check-label" for="remember_me">
                    Remember me
                </label>
            </div>

            <!-- Forgot Password & Submit -->
            <div class="d-flex justify-content-between align-items-center">
                @if (Route::has('password.request'))
                    <a class="text-decoration-none small" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif

                <button class="w-40 btn btn-lg btn-primary" type="submit">
                    Log in
                </button>
            </div>
        </form>
    </main>

    <!-- Bootstrap 5 JS (optional, but needed for some components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

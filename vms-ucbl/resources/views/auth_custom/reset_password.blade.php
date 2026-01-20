<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ $email }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">New Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button class="btn btn-success w-100">
        Reset Password
    </button>
</form>

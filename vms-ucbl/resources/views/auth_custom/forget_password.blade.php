<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <button class="btn btn-primary w-100">
        Send Reset Link
    </button>
</form>

<x-layout title="Reset Password">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4 shadow-sm">
                    <h4 class="mb-3">Reset Password</h4>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">


                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ $email }}" class="form-control"
                                type="disabled" readonly>
                        </div>

                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">
                            Reset Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>

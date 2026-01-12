<x-layout title="Lupa Password">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-3">Lupa Password</h5>

                    <form method="POST" action="{{ route('email.send') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button class="btn btn-primary w-100">
                            Kirim Link Reset
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</x-layout>

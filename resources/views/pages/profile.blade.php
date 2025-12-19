<x-layout title="Profile">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center p-4">

                    {{-- Avatar --}}
                    <div class="mb-3">
                        <div
                            class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                            style="width: 80px; height: 80px; font-size: 28px; font-weight: 600;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>

                    {{-- Name --}}
                    <h5 class="fw-semibold mb-1">
                        {{ $user->name }}
                    </h5>

                    {{-- Email --}}
                    <p class="text-muted small mb-4">
                        {{ $user->email }}
                    </p>

                    {{-- Action --}}
                    <button
                        class="btn btn-outline-primary btn-sm px-4"
                        data-bs-toggle="modal"
                        data-bs-target="#editProfileModal">
                        Edit Profile
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>

@include('profile.edit-modal')

</x-layout>

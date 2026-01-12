<x-layout title="Loyalty Program">
    <div class="container py-5">

        {{-- HEADER SECTION --}}
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5 mb-3">Loyalty Program</h1>
            <div class="mx-auto" style="width: 80px; height: 4px; background-color: #ffc400; border-radius: 2px;"></div>
            <p class="text-muted mt-3 col-lg-6 mx-auto">
                Kumpulkan poin dari setiap transaksi dan tukarkan dengan voucher belanja eksklusif.
            </p>
        </div>

        {{-- CARD SALDO POIN --}}
        <div class="card border-0 shadow rounded-4 mb-5 overflow-hidden text-white" style="background: linear-gradient(135deg, #212529 0%, #343a40 100%);">
            <div class="card-body p-5 position-relative d-flex align-items-center justify-content-between flex-wrap gap-4">

                <div class="position-relative z-2">
                    <h6 class="text-uppercase fw-bold text-white-50 mb-2 ls-1">Saldo Poin Anda</h6>
                    <h1 class="display-3 fw-bold mb-0 text-warning">
                        <i class="fas fa-coins me-3"></i>{{ number_format(auth()->user()->points) }}
                    </h1>
                    <p class="text-white-50 mt-2 mb-0 small">Terus belanja untuk kumpulkan lebih banyak poin!</p>
                </div>

                <div class="position-relative z-2">
                    <a href="#rewards" class="btn btn-warning fw-bold rounded-pill px-4 py-2 shadow-sm text-dark">
                        Tukar Poin Sekarang <i class="fas fa-arrow-down ms-2"></i>
                    </a>
                </div>

                {{-- Dekorasi Background --}}

            </div>
        </div>

        {{-- LIST REWARD --}}
        <div id="rewards">
            <h4 class="fw-bold mb-4 border-start border-4 border-warning ps-3">Tukarkan Poin</h4>

            <div class="row g-4">
                @forelse ($rewards as $reward)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-2 shadow-sm rounded-4 h-100 transition-hover">
                            <div class="card-body p-4 text-center d-flex flex-column">

                                {{-- Icon / Visual --}}
                                <div class="bg-light rounded-4 py-4 mb-3 border border-dashed d-flex flex-column align-items-center justify-content-center flex-grow-1" style="min-height: 120px;">
                                    <h2 class="fw-bold text-dark mb-0">Rp {{ number_format($reward->discount_amount, 0, ',', '.') }}</h2>
                                    <small class="text-muted fw-bold text-uppercase mt-1 ls-1">Voucher Diskon</small>
                                </div>

                                {{-- Info Reward --}}
                                <h5 class="fw-bold text-dark mb-2">{{ $reward->name }}</h5>
                                <div class="d-inline-block bg-warning bg-opacity-10 text-dark px-3 py-1 rounded-pill fw-bold small mb-3 border border-warning border-opacity-25">
                                    Butuh <i class="fas fa-coins text-warning mx-1"></i> {{ number_format($reward->points_required) }} Poin
                                </div>

                                {{-- Logic Progress Bar --}}
                                @php
                                    $userPoints = auth()->user()->points;
                                    $required = $reward->points_required;
                                    // Hindari pembagian dengan nol
                                    $percent = $required > 0 ? min(($userPoints / $required) * 100, 100) : 0;
                                    $isEnough = $userPoints >= $required;
                                @endphp

                                <div class="progress mb-3 bg-light" style="height: 6px;">
                                    <div class="progress-bar {{ $isEnough ? 'bg-success' : 'bg-warning' }}"
                                         role="progressbar"
                                         style="width: {{ $percent }}%"></div>
                                </div>

                                {{-- Action Button --}}
                                @if($isEnough)
                                    <form action="{{ route('loyalty.redeem', $reward->id) }}" method="POST" onsubmit="return confirm('Tukar {{ $reward->points_required }} poin dengan voucher ini?')">
                                        @csrf
                                        <button type="submit" class="btn btn-dark w-100 rounded-pill fw-bold py-2 shadow-sm">
                                            <i class="fas fa-gift me-2"></i> Tukar Sekarang
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-light text-muted border w-100 rounded-pill fw-bold py-2" disabled>
                                        <i class="fas fa-lock me-2"></i> Kurang {{ number_format($required - $userPoints) }} Poin
                                    </button>
                                @endif

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-ticket-alt fa-3x mb-3 opacity-25"></i>
                            <p>Belum ada reward yang tersedia saat ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-layout>

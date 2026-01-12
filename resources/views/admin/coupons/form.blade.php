<x-admin-layout title="Kupon">

    <h4 class="mb-4 fw-semibold">Manajemen Kupon</h4>

    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Kode Kupon</label>
            <input type="text" name="code" class="form-control" value="{{ old('code') }}">

            @error('code')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Jenis Potongan</label>
            <select name="type" class="form-select">
                <option value="fixed">Nominal Tetap (Rp)</option>
                <option value="percent">Persentase (%)</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Nilai</label>
            <input type="number" name="value" class="form-control" value="{{ old('value') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Kupon</button>
    </form>
</x-admin-layout>

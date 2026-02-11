<x-app-layout>

    <x-slot name="header">
        <h4>Pengaturan Voting</h4>
    </x-slot>

    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf

            <div class="mb-3">
                <label>Status Voting</label>
                <select name="voting_open" class="form-control">
                    <option value="1" {{ $setting->voting_open ? 'selected' : '' }}>Dibuka</option>
                    <option value="0" {{ !$setting->voting_open ? 'selected' : '' }}>Ditutup</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Mulai Voting</label>
                <input type="datetime-local" name="voting_start" class="form-control"
                    value="{{ $setting->voting_start }}">
            </div>

            <div class="mb-3">
                <label>Akhir Voting</label>
                <input type="datetime-local" name="voting_end" class="form-control" value="{{ $setting->voting_end }}">
            </div>

            <button class="btn btn-primary">Simpan Pengaturan</button>

        </form>

    </div>

</x-app-layout>

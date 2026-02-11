<x-app-layout>

    <x-slot name="header">
        Edit Kandidat Ketua
    </x-slot>

    <div class="container mt-4">

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ implode('', $errors->all(':message')) }}
            </div>
        @endif

        <form method="POST" action="{{ route('candidates.update', $candidate->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Kandidat</label>
                <input type="text" name="nama" class="form-control" value="{{ $candidate->nama }}">
            </div>

            <div class="mb-3">
                <label>Visi</label>
                <textarea name="visi" class="form-control">{{ $candidate->visi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Misi</label>
                <textarea name="misi" class="form-control">{{ $candidate->misi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Nomor Urut</label>
                <input type="number" name="nomor_urut" class="form-control" value="{{ $candidate->nomor_urut }}">
            </div>

            <div class="mb-3">
                <label>Foto Sekarang</label><br>

                @if ($candidate->foto)
                    <img src="{{ asset('storage/' . $candidate->foto) }}" width="120">
                @else
                    <p>Tidak ada foto</p>
                @endif
            </div>

            <div class="mb-3">
                <label>Ganti Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <button class="btn btn-primary">
                Update Kandidat
            </button>

            <a href="{{ route('candidates.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</x-app-layout>

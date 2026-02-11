<x-app-layout>

    <x-slot name="header">
        Tambah Kandidat
    </x-slot>

    <div class="container mt-4">

        <form method="POST" action="{{ route('candidates.store') }}" enctype="multipart/form-data">
            @csrf

            <input type="text" name="nama" class="form-control mb-2" placeholder="Nama kandidat">

            <textarea name="visi" class="form-control mb-2" placeholder="Visi"></textarea>

            <textarea name="misi" class="form-control mb-2" placeholder="Misi"></textarea>

            <input type="number" name="nomor_urut" class="form-control mb-2" placeholder="Nomor urut">

            <input type="file" name="foto" class="form-control mb-2">

            <button class="btn btn-primary">Simpan</button>

        </form>

    </div>

</x-app-layout>

<x-app-layout>

    <x-slot name="header">
        Kelola Kandidat Ketua
    </x-slot>

    <div class="container mt-4">

        <a href="{{ route('candidates.create') }}" class="btn btn-primary mb-3">
            + Tambah Kandidat
        </a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Nomor Urut</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($candidates as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            @if ($c->foto)
                                <img src="{{ asset('storage/' . $c->foto) }}" width="70">
                            @endif
                        </td>

                        <td>{{ $c->nama }}</td>
                        <td>{{ $c->nomor_urut }}</td>

                        <td>
                            <a href="{{ route('candidates.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form method="POST" action="{{ route('candidates.destroy', $c->id) }}"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</x-app-layout>

<x-app-layout>

    <x-slot name="header">
        Data Ketua Himpasikom
    </x-slot>

    <div class="container mt-4">

        <a href="{{ route('ketua.create') }}" class="btn btn-primary mb-3">
            Tambah Ketua
        </a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Periode</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($ketuas as $k)
                    <tr>
                        <td>
                            @if ($k->foto)
                                <img src="{{ asset('storage/' . $k->foto) }}" width="70">
                            @endif
                        </td>
                        <td>{{ $k->nama }}</td>
                        <td>{{ $k->periode }}</td>

                        <td>
                            <a href="{{ route('ketua.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form method="POST" action="{{ route('ketua.destroy', $k->id) }}" style="display:inline;">
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

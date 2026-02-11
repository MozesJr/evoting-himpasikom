<x-app-layout>

    <x-slot name="header">
        <h4>Data Voting Pemilih</h4>
    </x-slot>

    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.votes.reset') }}">
            @csrf
            <button class="btn btn-danger mb-3" onclick="return confirm('Reset semua vote?')">
                Reset Semua Voting
            </button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemilih</th>
                    <th>Email</th>
                    <th>Kandidat Dipilih</th>
                    <th>Waktu Vote</th>
                    <th>IP Address</th>
                    <th>Device</th>

                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($votes as $vote)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vote->user->name }}</td>
                        <td>{{ $vote->user->email }}</td>
                        <td>{{ $vote->candidate->nama }}</td>
                        <td>{{ $vote->created_at }}</td>
                        <td>{{ $vote->ip_address }}</td>
                        <td>{{ $vote->device }}</td>

                        <td>
                            <form method="POST" action="{{ route('admin.votes.delete', $vote->id) }}">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</x-app-layout>

<x-app-layout>

    <x-slot name="header">
        <h4>Dashboard Admin Voting Himpasikom</h4>
    </x-slot>

    <div class="container mt-4">

        <div class="row mb-4">

            <div class="col-md-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5>Total Pemilih</h5>
                        <h2>{{ $totalPemilih }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5>Sudah Vote</h5>
                        <h2>{{ $sudahVote }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5>Belum Vote</h5>
                        <h2>{{ $belumVote }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5>Total Kandidat</h5>
                        <h2>{{ $totalKandidat }}</h2>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mb-4">

            <div class="col-md-6">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5>Total Suara Masuk</h5>
                        <h2>{{ $totalSuaraMasuk }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5>Status Voting</h5>

                        @if ($setting->voting_open)
                            <span class="badge bg-success">DIBUKA</span>
                        @else
                            <span class="badge bg-danger">DITUTUP</span>
                        @endif

                    </div>
                </div>
            </div>

        </div>

        <div class="card shadow">
            <div class="card-body">
                <h5>Perolehan Suara Kandidat</h5>

                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Ranking</th>
                            <th>Nama Kandidat</th>
                            <th>Jumlah Suara</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($hasilVoting as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->votes_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</x-app-layout>

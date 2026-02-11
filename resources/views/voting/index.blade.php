<x-app-layout>

    <x-slot name="header">
        <h4 class="mb-0">Voting Ketua Himpasikom</h4>
    </x-slot>

    <div class="container mt-4">

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- STATUS USER --}}
        @if ($user->sudah_vote)
            <div class="alert alert-info text-center">
                Anda sudah melakukan voting.
            </div>
        @endif

        <div class="row">

            @foreach ($candidates as $candidate)
                <div class="col-md-4 mb-4">

                    <div class="card shadow-sm h-100 border-0">

                        {{-- FOTO --}}
                        @if ($candidate->foto)
                            <img src="{{ asset('storage/' . $candidate->foto) }}" class="card-img-top">
                        @else
                            <img src="https://via.placeholder.com/400x250" class="card-img-top">
                        @endif

                        <div class="card-body text-center">

                            <span class="badge bg-primary mb-2">
                                No. {{ $candidate->nomor_urut }}
                            </span>

                            <h5 class="card-title">
                                {{ $candidate->nama }}
                            </h5>

                            <hr>

                            <p class="text-start">
                                <strong>Visi:</strong><br>
                                {{ $candidate->visi }}
                            </p>

                            <p class="text-start">
                                <strong>Misi:</strong><br>
                                {{ $candidate->misi }}
                            </p>

                        </div>

                        <div class="card-footer bg-white border-0">

                            @if (!$user->sudah_vote)
                                <form action="{{ route('voting.vote') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">

                                    <button type="submit" class="btn btn-primary w-100"
                                        onclick="return confirm('Yakin memilih kandidat ini?')">
                                        Pilih Kandidat
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary w-100" disabled>
                                    Sudah Vote
                                </button>
                            @endif

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

</x-app-layout>

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemilih = User::where('role', 'pemilih')->count();
        $sudahVote = User::where('sudah_vote', true)->count();
        $belumVote = User::where('sudah_vote', false)->where('role', 'pemilih')->count();
        $totalKandidat = Candidate::count();
        $totalSuaraMasuk = Vote::count();

        $setting = Setting::first();

        $hasilVoting = Candidate::withCount('votes')
            ->orderByDesc('votes_count')
            ->get();

        return view('admin.dashboard', compact(
            'totalPemilih',
            'sudahVote',
            'belumVote',
            'totalKandidat',
            'totalSuaraMasuk',
            'setting',
            'hasilVoting'
        ));
    }
}

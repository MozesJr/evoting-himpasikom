<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;


class VoteController extends Controller
{
    /**
     * Tampilkan halaman voting
     */
    public function index()
    {
        // ambil semua kandidat
        $candidates = Candidate::orderBy('nomor_urut')->get();

        $setting = Setting::first();

        if (!$setting->voting_open) {
            return view('voting.closed');
        }


        $user = Auth::user();

        return view('voting.index', compact('candidates', 'user'));
    }

    /**
     * Proses submit voting
     */
    public function vote(Request $request)
    {

        $setting = Setting::first();

        // voting ditutup manual
        if (!$setting->voting_open) {
            return back()->with('error', 'Voting sedang ditutup admin');
        }

        // belum mulai
        if ($setting->voting_start && now()->lt($setting->voting_start)) {
            return back()->with('error', 'Voting belum dimulai');
        }

        // otomatis lock saat waktu habis
        if ($setting->voting_end && now()->gt($setting->voting_end)) {

            // auto update status voting
            $setting->update(['voting_open' => false]);

            return back()->with('error', 'Voting sudah berakhir');
        }


        $request->validate([
            'candidate_id' => 'required|exists:candidates,id'
        ]);

        $user = Auth::user();

        // cek verifikasi
        if (!$user->verified) {
            return back()->with('error', 'Akun belum diverifikasi admin');
        }

        // cek sudah vote
        if ($user->sudah_vote) {
            return back()->with('error', 'Anda sudah melakukan voting');
        }

        // simpan vote
        Vote::create([
            'user_id' => $user->id,
            'candidate_id' => $request->candidate_id,
            'waktu_vote' => now(),
            'ip_address' => $request->ip(),
            'device' => $request->userAgent()
        ]);


        // update user
        $user->update([
            'sudah_vote' => true
        ]);

        return redirect()->route('voting.index')
            ->with('success', 'Voting berhasil dilakukan!');
    }

    /**
     * Halaman hasil realtime
     */
    public function hasil()
    {
        $candidates = Candidate::withCount('votes')
            ->orderByDesc('votes_count')
            ->get();

        return view('voting.hasil', compact('candidates'));
    }

    public function realtime()
    {
        $candidates = Candidate::withCount('votes')
            ->orderBy('nomor_urut')
            ->get();

        return response()->json($candidates);
    }
}

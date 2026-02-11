<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\User;

class VoteController extends Controller
{
    public function index()
    {
        $votes = Vote::with(['user', 'candidate'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.votes.index', compact('votes'));
    }

    public function destroy($id)
    {
        $vote = Vote::findOrFail($id);

        // kembalikan status user
        $vote->user->update([
            'sudah_vote' => false
        ]);

        $vote->delete();

        return back()->with('success', 'Vote berhasil dihapus');
    }

    public function reset()
    {
        Vote::truncate();

        User::where('role', 'pemilih')->update([
            'sudah_vote' => false
        ]);

        return back()->with('success', 'Semua voting berhasil direset');
    }
}

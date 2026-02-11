<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::orderBy('nomor_urut')->get();
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        return view('admin.candidates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'nomor_urut' => 'required|numeric',
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('candidates', 'public');
        }

        Candidate::create([
            'nama' => $request->nama,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'nomor_urut' => $request->nomor_urut,
            'foto' => $fotoPath
        ]);

        return redirect()->route('candidates.index')
            ->with('success', 'Kandidat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('admin.candidates.edit', compact('candidate'));
    }

    public function update(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'nomor_urut' => 'required|numeric',
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {

            if ($candidate->foto) {
                Storage::disk('public')->delete($candidate->foto);
            }

            $candidate->foto = $request->file('foto')->store('candidates', 'public');
        }

        $candidate->update([
            'nama' => $request->nama,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'nomor_urut' => $request->nomor_urut,
            'foto' => $candidate->foto
        ]);

        return redirect()->route('candidates.index')
            ->with('success', 'Kandidat berhasil diupdate');
    }

    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);

        if ($candidate->foto) {
            Storage::disk('public')->delete($candidate->foto);
        }

        $candidate->delete();

        return back()->with('success', 'Kandidat dihapus');
    }
}

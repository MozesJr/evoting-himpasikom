<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ketua;
use Illuminate\Support\Facades\Storage;

class KetuaController extends Controller
{
    public function index()
    {
        $ketuas = Ketua::latest()->get();
        return view('admin.ketua.index', compact('ketuas'));
    }

    public function create()
    {
        return view('admin.ketua.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'periode' => 'required',
            'foto' => 'image|mimes:jpg,png|max:2048'
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('ketua', 'public');
        }

        Ketua::create([
            'nama' => $request->nama,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'periode' => $request->periode,
            'keterangan' => $request->keterangan,
            'foto' => $foto
        ]);

        return redirect()->route('ketua.index')->with('success', 'Data ketua ditambahkan');
    }

    public function edit($id)
    {
        $ketua = Ketua::findOrFail($id);
        return view('admin.ketua.edit', compact('ketua'));
    }

    public function update(Request $request, $id)
    {
        $ketua = Ketua::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($ketua->foto) {
                Storage::disk('public')->delete($ketua->foto);
            }

            $ketua->foto = $request->file('foto')->store('ketua', 'public');
        }

        $ketua->update([
            'nama' => $request->nama,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'periode' => $request->periode,
            'keterangan' => $request->keterangan,
            'foto' => $ketua->foto
        ]);

        return redirect()->route('ketua.index')->with('success', 'Data ketua diperbarui');
    }

    public function destroy($id)
    {
        $ketua = Ketua::findOrFail($id);

        if ($ketua->foto) {
            Storage::disk('public')->delete($ketua->foto);
        }

        $ketua->delete();

        return back()->with('success', 'Data ketua dihapus');
    }
}

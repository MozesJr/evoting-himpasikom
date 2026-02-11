<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'pemilih')->orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'verified' => true
        ]);

        return back()->with('success', 'User berhasil diverifikasi');
    }

    public function getUsersJson()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return response()->json($users);
    }
}

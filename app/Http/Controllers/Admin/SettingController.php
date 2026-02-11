<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        $setting->update([
            'voting_open' => $request->voting_open ? true : false,
            'voting_start' => $request->voting_start,
            'voting_end' => $request->voting_end
        ]);

        return back()->with('success', 'Pengaturan voting diperbarui');
    }
}

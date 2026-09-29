<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings.edit', ['settings' => Setting::pluck('value', 'key')]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'business_name' => ['nullable', 'string', 'max:120'],
            'phone' => ['nullable', 'string', 'max:40'],
            'whatsapp' => ['nullable', 'string', 'max:40'],
            'address' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:160'],
            'opening_hours' => ['nullable', 'string', 'max:120'],
            'hero_title' => ['nullable', 'string', 'max:180'],
            'hero_subtitle' => ['nullable', 'string', 'max:500'],
            'company_description' => ['nullable', 'string', 'max:500'],
            'google_maps' => ['nullable', 'url', 'max:500'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'tiktok' => ['nullable', 'url', 'max:255'],
            'default_meta_title' => ['nullable', 'string', 'max:70'],
            'default_meta_description' => ['nullable', 'string', 'max:170'],
            'google_search_console' => ['nullable', 'string', 'max:120'],
            'google_analytics_id' => ['nullable', 'string', 'max:40'],
            'google_tag_manager_id' => ['nullable', 'regex:/\AGTM-[A-Z0-9]{6,14}\z/'],
        ]);

        $keys = [
            'business_name',
            'phone',
            'whatsapp',
            'address',
            'email',
            'opening_hours',
            'hero_title',
            'hero_subtitle',
            'company_description',
            'google_maps',
            'instagram',
            'facebook',
            'tiktok',
            'default_meta_title',
            'default_meta_description',
            'google_search_console',
            'google_analytics_id',
            'google_tag_manager_id',
        ];

        foreach ($keys as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $validated[$key] ?? null]);
        }

        return back()->with('ok', 'Pengaturan disimpan.');
    }

    public function profile()
    {
        return view('admin.users.index');
    }

    public function password(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:10'],
        ]);

        $request->user()->update(['password' => Hash::make($data['password'])]);

        return back()->with('ok', 'Password admin diperbarui.');
    }
}

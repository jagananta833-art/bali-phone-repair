<?php

namespace App\Http\Controllers;

use App\Services\LicenseService;
use Illuminate\Http\Request;

class LicenseRenewalController extends Controller
{
    /**
     * Menampilkan halaman input perpanjangan lisensi.
     */
    public function show()
    {
        $status = LicenseService::verify();

        return view('admin.license.renew', compact('status'));
    }

    /**
     * Memproses token aktivasi lisensi baru.
     */
    public function submit(Request $request)
    {
        $request->validate([
            'license_token' => ['required', 'string'],
        ]);

        $token = trim((string) $request->input('license_token'));
        $result = LicenseService::activate($token);

        if (!$result['valid']) {
            return back()->with('error', $result['reason'] ?? 'Token lisensi tidak valid.');
        }

        $expiryString = $result['expires_at'] ? $result['expires_at']->format('d M Y') : '1 tahun';

        return redirect()->route('license.renew')
            ->with('ok', "Lisensi berhasil diaktifkan! Masa aktif diperpanjang hingga {$expiryString} ({$result['days_left']} hari). Website kini beroperasi normal.");
    }
}


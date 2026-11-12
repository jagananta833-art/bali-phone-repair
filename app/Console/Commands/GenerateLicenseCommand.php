<?php

namespace App\Console\Commands;

use App\Services\LicenseService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateLicenseCommand extends Command
{
    protected $signature = 'license:generate 
                            {--days= : Durasi lisensi dalam hari} 
                            {--months= : Durasi lisensi dalam bulan} 
                            {--years= : Durasi lisensi dalam tahun} 
                            {--owner=jagananta833-art : Pemilik/penerbit lisensi} 
                            {--domain=baliphonerepair.com : Domain aplikasi} 
                            {--install : Pasang langsung lisensi ini ke database web}';

    protected $description = 'Membuat kunci lisensi terenkripsi kriptografis untuk Bali Phone Repair';

    public function handle(): int
    {
        $days = null;

        if ($this->option('years')) {
            $days = (int) $this->option('years') * 365;
        } elseif ($this->option('months')) {
            $days = (int) $this->option('months') * 30;
        } elseif ($this->option('days')) {
            $days = (int) $this->option('days');
        } else {
            $days = 365; // Default 1 tahun
        }

        $owner = (string) $this->option('owner');
        $domain = (string) $this->option('domain');

        $token = LicenseService::generate($days, $owner, $domain);
        $verify = LicenseService::verify($token);

        $this->newLine();
        $this->info('===========================================================');
        $this->info('       BALI PHONE REPAIR - CRYPTOGRAPHIC LICENSE KEY       ');
        $this->info('===========================================================');
        $this->line("Target Domain : <comment>{$domain}</comment>");
        $this->line("Owner / Issuer: <comment>{$owner}</comment>");
        $this->line("Duration      : <comment>{$days} days</comment>");
        $this->line("Expiry Date   : <comment>{$verify['expires_at']->format('d M Y, H:i:s')} UTC</comment>");
        $this->newLine();
        $this->line('License Key:');
        $this->warn($token);
        $this->newLine();

        if ($this->option('install')) {
            $result = LicenseService::activate($token);
            if ($result['valid']) {
                $this->info(' [OK] Lisensi ini telah BERHASIL DIPASANG ke database web!');
            } else {
                $this->error(' [FAIL] Gagal memasang lisensi: ' . ($result['reason'] ?? 'Unknown error'));
            }
        } else {
            $this->comment('Untuk mengaktifkan: Copy token di atas dan masukkan ke halaman /renew-license');
            $this->comment('atau jalankan dengan opsi: php artisan license:generate --install');
        }

        $this->newLine();

        return 0;
    }
}


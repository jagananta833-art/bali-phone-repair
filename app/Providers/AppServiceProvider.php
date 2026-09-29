<?php
namespace App\Providers;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}
    public function boot(): void
    {
        View::composer('*', function ($view): void {
            static $settings = null;

            if ($settings === null) {
                $settings = [];
                try { if (Schema::hasTable('settings')) $settings = Setting::pluck('value','key')->all(); } catch (\Throwable) {}
            }

            $view->with('siteSettings', $settings);
        });
    }
}

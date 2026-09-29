@echo off
setlocal
echo ===================================================
echo [1/3] Memeriksa perubahan lokal...
echo ===================================================
git status --short

echo.
echo ===================================================
echo [2/3] Mengirim (push) perubahan ke GitHub...
echo ===================================================
git push origin main
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Gagal push ke GitHub! Silakan periksa koneksi atau commit lokal Anda.
    pause
    exit /b %ERRORLEVEL%
)

echo.
echo ===================================================
echo [3/3] Melakukan deploy otomatis ke Hostinger via SSH...
echo ===================================================
ssh -i "%~dp0hostinger_deploy_key" -p 65002 -o StrictHostKeyChecking=no u774609161@153.92.15.53 "cd /home/u774609161/laravel && git pull origin main && php artisan optimize:clear && php artisan optimize && echo. && echo [OK] DEPLOY HOSTINGER SUKSES! Web telah diperbarui."

echo.
echo ===================================================
echo Selesai! Perubahan sudah aktif di https://baliphonerepair.com
echo ===================================================
pause

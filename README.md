revisi dan penambahan di dalam halaman tagihan dan pembayaran.

Thank You 

<!-- Cara Clone Project -->
git clone https://github.com/fann133/pembayaran-spp_laravel.git
cd pembayaran-spp_laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan serve


<!-- Update ke Repo -->
git status
git add .
git commit -m "Pesan"
git push origin main
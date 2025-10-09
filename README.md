<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Perintah Laravel

php artisan make:migration remove_usulan_kegiatan_score_to_indikator_detail_table --table=penilaian
php artisan migrate
php artisan migrate:rollback
php artisan serve

php artisan make:seeder NamaSeeder
php artisan db:seed --class=NamaSeeder

php artisan migrate:rollback

php artisan make:model namaModel -mcr /// membuat dengan controller

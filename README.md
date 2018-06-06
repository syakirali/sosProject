# sosProject
Website berbasis laravel (versi 5.4) tentang sosialisasi serta ploting suatu kegiatan.

# requirement
1. php versi 7 keatas (alternatinya pakai xampp versi 3 keatas)
2. mysql-server (alternatifnya pakai xampp versi 3 keatas)
3. composer, download di https://getcomposer.org/Composer-Setup.exe

# cara instalasi di laptop
1. download project (buka https://github.com/syakirali/sosProject lalu klik "clone or download", kemudian "download zip")
2. extract project sosProject-master.zip
3. buka cmd lalu arahkan ke folder project (untuk memastikan, ketik dir, jika terdapat artisan.php beserta file lainnya anda sudah benar)
4. di cmd, ketik composer insatall
5. di cmd, ketik php artisan key:genearte
1. download project (buka https://github.com/syakirali/sosProject lalu klik "clone or download", kemudian "download zip")
2. extract project sosProject-master.zip
3. buka folder hasil extract, buat database baru bernama pbisos, lalu import file pbisos.sql ke database baru di mysql-server (phpmyadmin)
4. copy file .env.example, paste di folder yang sama dan beri nama .env
5. edit file .env sesuai dengan kebutuhan (untuk localhost edit DB_HOST=localhost. atur DB_USERNAME, DB_PASSWORD sesuai dengan username dan password database yang tersedia, atur juga DB_DATABASE=pbisos sesuai dengan nama database baru yang dibuat
6. buka cmd lalu arahkan ke folder project (untuk memastikan, ketik dir, jika terdapat artisan.php beserta file lainnya anda sudah benar)
7. di cmd, ketik composer insatall
8. di cmd, ketik php artisan key:genearte
9. di cmd, ketik php artisan serve
10. buka browser, masukkan url localhost:8000, lalu enter

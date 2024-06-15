# Saver App
Selamat datang di repository kami!

## Tentang Saver App
Jadi Saver App ini adalah website yang dikhususkan untuk menyimpan foto foto dokumentasi orang orang yang bekerja di PID Korpolairud Baharkam Polri!
Website ini dibuat oleh dua anak dari SMKN 12 Jakarta!

## Credit
Dibuat oleh: 
- Muhammad Habibullah Mursalin [cinosjuhchi](https://github.com/cinosjuhchi)
- Zidane Athallah Winata [Azepp](https://github.com/Azepp)

## Langkah Langkah Penginstallan

**Klon Proyek**

```shell
git clone https://github.com/pid2024/saver-app.git
```

```shell
cd saver-app
```

```shell
composer install
```

```shell
npm install
```

```shell
cp .env-example .env
```

```shell
php artisan key:generate
```

```shell
php artisan storage:link
```

### Jalankan migrate di awal

```shell
php artisan migrate
```

```shell
php artisan --seed
```

## Jalankan Web 

```shell
php artisan serve
```

```shell
npm run dev
```
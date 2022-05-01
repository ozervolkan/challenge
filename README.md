

## Kurulum

- Proje indirilir. Bir klasörde dockera yüklenir.

```bash
Docker-compose up
```

Dockerda kurulumdan sonra Container içerisinde terminalden : 

Bağımlıklar kurulur :

```bash
composer update
```

Veritabanı tabloları kurulur : 

```bash
php artisan migrate
```

dummy datalar tablolalara eklenir :

```bash
php artisan db:seed
```

---

Veritabanı Bilgileri

| Bilgi | Değer |
|--|--|
| Veritabanı|laravel |
|Kullanıcı adı|root|
|Şifre|root|

---

| Method | EndPoint | Description
|--|--|--|
|POST|api/v1/register| Cihaz kayıt olma işlemi |
|POST|api/v1/purchase| Satın alma isteği |
|POST|api/v1/check| Güncel abonelik durumunu döndürür |

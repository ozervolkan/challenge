

## Kurulum

- Proje indirilir. Bir klasörde dockera yüklenir.

```bash
docker-compose up
```

Dockerda kurulumdan sonra Container içerisinde terminalden : 

Bağımlılıklar kurulur :

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

---

Worker

Worker aşağıdaki url den çalışacaktır. Cron veya Supervisord henüz eklenmemiştir. Yetki kontrolü yapılmadı

```bash
http://127.0.0.1:8000/worker
```

---

Callback

Callback eventları ilgili bölümlere eklenmiştir.

---

Raporlama

Rapor aşağıdaki url den json olarak dönmektedir. Yetki kontrolü yapılmadı.

```bash
http://127.0.0.1:8000/report
```

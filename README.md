

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

Bu işlemlerden sonra aşağıdaki url den yayına geçecektir.

```bash
http://127.0.0.1:8000
```


---

Veritabanı Bilgileri

| Bilgi | Değer |
|--|--|
| Veritabanı|laravel |
|Kullanıcı adı|root|
|Şifre|root|
|Port|3306|

---

| Method | Auth | EndPoint | Parameters | Description
|--|--|--|--|
|POST|Yok|api/v1/register| uid, appId, os, language | Cihaz kayıt olma işlemi, Client-Token alınır. |
|POST|Bearer Token|api/v1/purchase| receipt | Satın alma isteği |
|GET|Bearer Token|api/v1/check| Güncel abonelik durumunu döndürür |

---

Worker

Worker aşağıdaki url den çalışacaktır. Cron veya Supervisord henüz eklenmemiştir. Yetki kontrolü yapılmadı

```bash
http://127.0.0.1:8000/worker
```

Workerı çalıştırmak için terminalden aşağıdaki komut çalıştırılmalıdır: 

```bash
php artisan queue:work
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

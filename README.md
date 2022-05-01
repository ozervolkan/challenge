

## Kurulum

- Proje indirilir. Bir klasörde dockera yüklenir.

```bash
Docker-compose up
```

Dockerda kurulumdan sonra Container içerisinden

Veritabanı Kurulumu

```bash
php artisan migrate
```

dummy datalar tablolalara eklenir:

```bash
php artisan db:seed
```

routes :
api versiyon : 
```bash
/v1
```

kayıt olma
```bash
/register
```

abonelik
```bash
/purchase
```




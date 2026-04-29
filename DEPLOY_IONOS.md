# Deploy Produce a Value su IONOS VPS

## Prerequisiti VPS

- PHP 8.3+ con estensioni comuni Laravel: `mbstring`, `openssl`, `pdo`, `pdo_sqlite`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`
- Composer
- Nginx o Apache puntato alla cartella `public`
- Git
- Certificato SSL per `produceavalue.com`

## Prima installazione

```bash
cd /var/www
git clone <GITHUB_REPO_URL> produceavalue
cd produceavalue
composer install --no-dev --optimize-autoloader
cp .env.vps.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed --class=CaseStudySeeder --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Poi configura `.env` con:

- `APP_URL=https://produceavalue.com`
- `ADMIN_EMAIL`
- `ADMIN_PASSWORD_HASH` preferito rispetto a `ADMIN_PASSWORD`
- eventuale mailer reale quando serviranno notifiche email

Per generare una password admin hashata:

```bash
php artisan tinker
Hash::make('password-forte-qui')
```

## Permessi

```bash
chown -R www-data:www-data storage bootstrap/cache database
chmod -R ug+rwx storage bootstrap/cache database
```

Su alcune VPS IONOS l'utente web può essere diverso da `www-data`.

## Nginx server block

```nginx
server {
    listen 80;
    server_name produceavalue.com www.produceavalue.com;
    root /var/www/produceavalue/public;

    index index.php index.html;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## Deploy successivi

```bash
cd /var/www/produceavalue
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Checklist go-live

- `APP_DEBUG=false`
- SSL attivo
- dominio e `www` funzionanti
- admin password cambiata
- `/admin` protetto
- `/audit` salva dati
- `/work` mostra case study pubblicati
- privacy/cookie aggiornate prima di tracking reali

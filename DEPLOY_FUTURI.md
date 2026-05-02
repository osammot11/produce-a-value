# Deploy Futuri

Quando devi aggiornare il sito sulla VPS, entra via SSH e lancia questi comandi:

```bash
cd /var/www/produceavalue
sudo -u www-data git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

cd /var/www/html/
composer install
FILE=/var/www/html/.env
if [ -f "$FILE" ]; then
    echo "$FILE exists."
else 
		cp /var/www/html/.env.example /var/www/html/.env
    echo "$FILE created."
fi
php artisan key:generate
chmod 777 storage -R
chmod 777 vendor -R
chmod 777 bootstrap/cache/ -R
chmod 777 database/ -R
apachectl -D FOREGROUND

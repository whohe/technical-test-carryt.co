FROM php:8-apache
RUN apt update
RUN apt install -y libmcrypt-dev libzip-dev libonig-dev libpng-dev libxml2-dev libpq-dev libmongoc-dev sqlite3
RUN pecl install mcrypt
RUN docker-php-ext-enable mcrypt
RUN docker-php-ext-install zip mbstring gd opcache xml pdo 
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
COPY ./entrypoint.sh /entrypoint.sh
RUN chmod 777 /entrypoint.sh
ENTRYPOINT /entrypoint.sh

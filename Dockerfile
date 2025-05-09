FROM php:8.2-fpm

copy . /var/www/html/

#composer install
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN mv composer-setup.php /usr/local/bin/composer
RUN php -r "unlink('composer-setup.php');"

RUN /bin/sh -c /bin/bash -c sudo composer install

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html/

RUN mv .env.example .env

#laravel
RUN php artisan key:generate
RUN php artisan config:clear
#
CMD ["php","artisan", "migrate"]

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
FROM php:7.2-apache

RUN apt-get update && apt-get install -y libmcrypt-dev openssl\
&& docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install pdo mcrypt mbstring 

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app
RUN composer install

RUN chmod 777 -R -c /var/www/html

EXPOSE 80
EXPOSE 8000
EXPOSE 8080
EXPOSE 8081

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT [ "entrypoint.sh" ]

CMD php artisan serve --host=0.0.0.0 --port=8081
FROM php:7.2-apache

RUN sudo apt-get update && sudo apt-get install -y \
&& apt-get install -y openssl zip unzip git \
&& docker-php-ext-install pdo pdo_mysql 

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmode rewrite

RUN chmod 777 -R -c /var/www/html

EXPOSE 8080
EXPOSE 8081

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entryponit.sh
ENTRYPOINT [ "entryponit.sh" ]
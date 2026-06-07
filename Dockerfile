FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    dos2unix \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html

<<<<<<< Updated upstream
RUN ./vendor/bin/doctrine-migrations migrate --no-interaction

RUN php seed.php
=======
COPY entrypoint.sh /entrypoint.sh
RUN dos2unix /entrypoint.sh && chmod +x /entrypoint.sh
>>>>>>> Stashed changes

EXPOSE 80

# ✅ ENTRYPOINT em vez de CMD
ENTRYPOINT ["bash", "/entrypoint.sh"]
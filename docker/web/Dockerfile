FROM php:alpine

RUN docker-php-ext-install -j$(nproc) json mbstring pdo_mysql tokenizer

WORKDIR /var/www/html

CMD ["php", "/var/www/html/artisan", "serve", "--host", "0.0.0.0"]

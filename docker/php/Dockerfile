FROM php:8.2-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Очистка кеша
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html 
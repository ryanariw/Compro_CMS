# Stage 1: PHP + Node
FROM php:8.2-fpm-alpine

WORKDIR /var/www

# Install PHP system dependencies
RUN apk add --no-cache \
    bash \
    curl \
    git \
    libzip-dev \
    oniguruma-dev \
    jpeg-dev \
    freetype-dev \
    libpng-dev \
    zlib-dev \
    icu-dev \
    nodejs \
    npm \
    bash \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql zip intl mbstring

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

# Copy composer files
COPY composer.json composer.lock ./
# Composer install (development safe)

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts --ignore-platform-reqs

# Set permissions
RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copy production environment
COPY .env.production .env

# Install Node dependencies for Vue/Vite
RUN npm install

# Build frontend
RUN npm run build

EXPOSE 8000

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000

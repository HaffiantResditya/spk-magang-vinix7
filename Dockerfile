FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

# Copy all application files
COPY . .

# Image environment configuration
ENV WEBROOT=/var/www/html/public
ENV PHP_CATCHALL=1
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1
ENV APP_ENV=production

# Install Node.js, install Composer production dependencies, and build Vite frontend assets
RUN apk add --no-cache nodejs npm \
    && composer install --no-dev --optimize-autoloader --no-interaction \
    && npm ci --include=dev \
    && npm run build \
    && rm -rf node_modules \
    && chmod -R 777 storage bootstrap/cache \
    && chmod +x scripts/*.sh

EXPOSE 80

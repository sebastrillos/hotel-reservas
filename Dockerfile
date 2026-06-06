FROM richarvey/nginx-php-fpm:latest

# Copiar el proyecto al contenedor
COPY vendor /var/www/html

# Configurar variables para que apunte a la carpeta public de Laravel
ENV LARA_APP_NAME=hotel-reserva
ENV WEBROOT=/var/www/html/public
ENV APP_ENV=production
ENV APP_DEBUG=false

# Ejecutar comandos de optimización de Laravel
RUN composer install --no-dev --optimize-autoloader


RUN chown -R nwuser:nwuser /var/www/html/storage /var/www/html/bootstrap/cache

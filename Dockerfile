FROM richarvey/nginx-php-fpm:latest

# 1. Establecer el directorio de trabajo correcto
WORKDIR /var/www/html

# 2. Copiar todo el contenido de tu repositorio dentro del contenedor
COPY . /var/www/html

# Configurar variables para que apunte a la carpeta public de Laravel
ENV LARA_APP_NAME=GrandHotel
ENV WEBROOT=/var/www/html/public
ENV APP_ENV=production
ENV APP_DEBUG=false

# 3. Permitir que Composer corra como superusuario en este entorno no interactivo
ENV COMPOSER_ALLOW_SUPERUSER=1

# Ejecutar comandos de optimización de Laravel
RUN composer install --no-dev --optimize-autoloader

# Dar permisos correctos a las carpetas de almacenamiento
RUN chown -R nwuser:nwuser /var/www/html/storage /var/www/html/bootstrap/cache

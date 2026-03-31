FROM php:8.3-apache

# Installer les extensions PostgreSQL et autres utilities
RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl \
    git \
    && docker-php-ext-install pgsql pdo_pgsql \
    && a2enmod rewrite \
    && apt-get clean

# Configurer Apache VirtualHost
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    ServerName localhost\n\
    <Directory /var/www/html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
        RewriteEngine On\n\
        RewriteCond %{REQUEST_FILENAME} !-f\n\
        RewriteCond %{REQUEST_FILENAME} !-d\n\
        RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]\n\
    </Directory>\n\
    <FilesMatch "\\.php$">\n\
        SetHandler application/x-httpd-php\n\
    </FilesMatch>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Fix permissions
RUN chown -R www-data:www-data /var/www

EXPOSE 80

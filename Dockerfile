FROM ubuntu:16.04

# Update & install required packages
RUN apt-get update && apt-get install -y \
    nano \
    apache2 \
    php \
    php-pdo \
    php-mcrypt \
    php-mbstring \
    php-xml \
    libapache2-mod-php

# Create directories structure & change chown
RUN mkdir -p /var/www/mvhost
RUN chown -R www-data:www-data /var/www

# Set global environment variables
ENV TERM xterm

# Enable Apache mods and configs
RUN a2enmod rewrite
RUN a2enmod ssl

# Expose port 80 & 443
EXPOSE 80 443

CMD ["apache2ctl", "-D", "FOREGROUND"]

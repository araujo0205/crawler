FROM debian:11
# Install dependencies
RUN apt-get update && apt-get -y install ca-certificates apt-transport-https gnupg wget git zip 

# PHP
RUN wget -q https://packages.sury.org/php/apt.gpg -O- | apt-key add -
RUN echo "deb https://packages.sury.org/php/ bullseye main" | tee /etc/apt/sources.list.d/php.list
RUN apt-get update
RUN apt-get -y install curl
RUN apt-get -y install php8.1
RUN apt-get -y install php8.1-gd php8.1-dom php8.1-curl
RUN apt-get -y install composer
RUN apt-get -y install phpunit

# Apache
RUN a2enmod rewrite
# Allow .htaccess overwrite rules
RUN sed -i 's#AllowOverride [Nn]one#AllowOverride All#' /etc/apache2/apache2.conf
# block envfiles
RUN printf "<FilesMatch \"^\.env\">\n\tRequire all denied\n</FilesMatch>\n" > /etc/apache2/conf-enabled/env.conf
# change DocumentRoot
RUN sed -i 's#/var/www/html#/var/www/html/public#' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html/public/

EXPOSE 80
CMD ["/usr/sbin/apachectl", "-D", "FOREGROUND"]
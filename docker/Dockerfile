FROM php:8.2-fpm

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache mysqli pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash

WORKDIR /prototype

# Display initial message
RUN echo 'The Symfony installation process has commenced. This may take some time to complete. You will receive a notification once the installation is finished.'

# Copy spinner script
COPY spinner.sh /usr/bin/spinner
RUN chmod +x /usr/bin/spinner

# Run Composer install with spinner animation
CMD /usr/bin/spinner && composer install -n ; wait-for-it maria_db:3306 -- bin/console doctrine:migrations:migrate --no-interaction ;  php-fpm

# Display final message after completion
RUN echo 'The Symfony has been successfully installed and the database migration is completed. Please visit <a href="http://prototype.local">prototype.local</a>.'
EXPOSE 9000

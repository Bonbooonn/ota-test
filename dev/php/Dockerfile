FROM php:8.4-fpm

ARG USER_ID=1000
ARG GROUP_ID=1000
ARG USER=dev
ARG INSTALL_XDEBUG=false

RUN apt-get update && apt-get install -y \
    libcurl4-gnutls-dev \
    libxml2-dev\
    libonig-dev \
    libssl-dev \
    libpcre3-dev \
    zlib1g-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    supervisor \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip \
    && docker-php-ext-install pdo pdo_mysql mysqli bcmath sockets pcntl opcache exif intl calendar gettext soap

# Additional PHP extensions
RUN docker-php-ext-install ctype
RUN docker-php-ext-install curl
RUN docker-php-ext-install dom
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install fileinfo
RUN docker-php-ext-install filter
RUN docker-php-ext-install xml

RUN mkdir -p /usr/src/php/ext/redis \
    && git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis \
    && cd /usr/src/php/ext/redis \
    && phpize \
    && ./configure \
    && make \
    && make install \
    && docker-php-ext-enable redis

# Copy custom php config
COPY ./php/conf.d/php.ini $PHP_INI_DIR/conf.d/php.ini

# Install Xdebug
RUN if [ "${INSTALL_XDEBUG}" = "true" ]; then \
    pecl install xdebug-3.4.1 && docker-php-ext-enable xdebug && \
    echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    fi

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN groupadd -g ${GROUP_ID} ${USER} \
    && useradd -d /home/${USER} -s /bin/bash -m ${USER} -u ${USER_ID} -g ${USER} \
    && chown -R ${USER}:${USER} /home/${USER}

USER ${USER}

WORKDIR /home/${USER}/app

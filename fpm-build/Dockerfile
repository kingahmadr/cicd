FROM php:8.1-fpm
RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
		vim \
		libicu-dev\
		imagemagick \
		ghostscript \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd \
	&& docker-php-ext-configure intl \
	&& docker-php-ext-install intl \
	&& docker-php-ext-configure mysqli \
	&& docker-php-ext-install mysqli \
	&& docker-php-ext-configure curl \
	&& docker-php-ext-install curl \
        && docker-php-ext-configure json \
        && docker-php-ext-install json \
        && docker-php-ext-configure dom \
        && docker-php-ext-install dom \
        && docker-php-ext-configure exif \
        && docker-php-ext-install exif \
        && docker-php-ext-configure fileinfo \
        && docker-php-ext-install fileinfo \
        && docker-php-ext-configure hash \
        && docker-php-ext-install hash \
        && docker-php-ext-configure imagick \
        && docker-php-ext-install imagick \
        && docker-php-ext-configure mbstring \
        && docker-php-ext-install mbstring \
        && docker-php-ext-configure openssl \
        && docker-php-ext-install openssl \
        && docker-php-ext-configure pcre \
        && docker-php-ext-install pcre \
        && docker-php-ext-configure xml \
        && docker-php-ext-install xml \
        && docker-php-ext-configure zip \
        && docker-php-ext-install zip \
        && docker-php-ext-configure bc \
        && docker-php-ext-install bc \
        && docker-php-ext-configure filter \
        && docker-php-ext-install filter \
        && docker-php-ext-configure image \
        && docker-php-ext-install image \
        && docker-php-ext-configure iconv \
        && docker-php-ext-install iconv \
        && docker-php-ext-configure simplexml \
        && docker-php-ext-install simplexml \
        && docker-php-ext-configure sodium \
        && docker-php-ext-install sodium \
        && docker-php-ext-configure xmlreader \
        && docker-php-ext-install xmlreader \
        && docker-php-ext-configure zlib \
        && docker-php-ext-install zlib 

#  Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    mkdir /apps
COPY ./wordpress/ /apps/
	 

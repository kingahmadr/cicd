FROM php:7.4-fpm
RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd 

#  Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

ADD codeigniter4-advanced-app /var/www/html/
#WORKDIR /var/www/html/
#RUN cd /var/www/html
#CMD ["php","/var/www/html/spark","migrate -all"]

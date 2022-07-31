FROM wordpress:6.0.1-php8.1-fpm
RUN apt-get update && apt-get install -y \
	apt-get install inetutils-ping mariadb-client vim nano
#  Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

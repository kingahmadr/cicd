FROM nginx:latest

# Use the default production configuration
#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

#COPY ./phpinfo.php /var/www/html/
RUN apt-get update \
    && apt-get install inetutils-ping mariadb-client -y
	
COPY ./sites.conf /etc/nginx/conf.d/
RUN rm -rf /etc/nginx/conf.d/default.conf

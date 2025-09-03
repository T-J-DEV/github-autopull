FROM php:8.2-apache
RUN mkdir -p /var/www/html
COPY index.html /var/www/html/
RUN chown -R www-data:www-data /var/www/html
EXPOSE 80
CMD ["apache2-foreground"]

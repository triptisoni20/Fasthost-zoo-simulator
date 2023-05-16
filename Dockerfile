#Select Image		
FROM php:8.1-apache

#Enable Mod Rewrite
RUN a2enmod rewrite
RUN service apache2 restart

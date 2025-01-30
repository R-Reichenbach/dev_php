# Usa a imagem oficial do PHP como base
FROM php:8.0-fpm

# Instala as dependências necessárias
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

# Define o diretório de trabalho dentro do container
WORKDIR /var/www

# Copia o conteúdo do diretório local para o diretório de trabalho no container
COPY . .

# Instala as dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Executa o Composer para instalar as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Configura as permissões necessárias para o Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expõe a porta que o servidor web vai usar
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]

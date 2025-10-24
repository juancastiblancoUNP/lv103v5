#!/bin/bash

# 1. Instalar Composer (si no está disponible globalmente)
# Usaremos una versión local de Composer si no está en el PATH
if ! command -v composer &> /dev/null
then
    echo "Instalando Composer localmente..."
    curl -sS https://getcomposer.org/installer | php
    COMPOSER_COMMAND="php composer.phar"
else
    COMPOSER_COMMAND="composer"
fi

# 2. Restaurar dependencias
echo "Ejecutando composer install..."
$COMPOSER_COMMAND install --no-dev --prefer-dist --optimize-autoloader

# 3. Mover los archivos a la carpeta de la web (necesario en algunos contenedores Linux)
# Define la carpeta de destino donde App Service espera encontrar tu código web
# Asegúrate de que esta ruta sea correcta para tu App Service Linux. 
# Usualmente es /home/site/wwwroot
TARGET_DIR="/home/site/wwwroot"
SOURCE_DIR="."

if [ -d "$TARGET_DIR" ]; then
    echo "Copiando archivos a $TARGET_DIR..."
    rsync -av --exclude '.git' --exclude '.deployment' --exclude 'deploy.sh' "$SOURCE_DIR/" "$TARGET_DIR/"
fi

echo "Despliegue completado."

#!/bin/bash
set -e

echo "Rodando migrations..."
./vendor/bin/doctrine-migrations migrate --no-interaction

echo "Rodando seed..."
php seed.php

echo "Iniciando Apache..."
exec apache2-foreground
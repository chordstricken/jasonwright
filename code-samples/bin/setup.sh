#!/bin/bash
# Run this on an ubuntu server having version 14.04 or above
if [ ! `id -u` = 0 ]; then
    echo "Run as root"
    exit 1
fi

apt-get install -y apache2 mongodb-server php5-common php5-mongo

wget -O /usr/bin/phpunit https://phar.phpunit.de/phpunit.phar && chmod +x /usr/bin/phpunit
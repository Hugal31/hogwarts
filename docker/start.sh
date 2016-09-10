#!/bin/bash

# Seed database
if $SEED_DATABASE; then
    # Wait for database
    wait-for-it.sh -t 60 $DB_HOST:$DB_PORT > /log1 # The mysql database can be long to init
    cd $APACHE_DOCUMENTROOT
    php artisan migrate && php artisan db:seed > /log2
fi

# Start apache
/usr/sbin/apache2 -D FOREGROUND

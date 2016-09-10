#!/bin/bash

IMAGE_NAME='hogwarts'
BUILD_IMAGE=false
MIGRATE_DATABASE=false
SEED_DATABASE=true

APACHE_SERVERNAME=hogwarts.lan

APP_ENV=local # TODO Change
APP_DEBUG=true # TODO Change
APP_KEY=
DB_PORT=3306
DB_DATABASE=hogwarts
DB_USERNAME=hogwarts
DB_PASSWORD=1324

DB_DATA_DIR=

while [[ ! -z $1 ]]; do
    case $1 in
	'--build')
	    BUILD_IMAGE=true
	    ;;
	*)
	    DB_DATA_DIR="$1"
	    ;;
    esac
    shift
done

if [[ -z $DB_DATA_DIR ]]; then
    echo "Please give a directory for mysql database" >&2
    exit 1
fi

if [[ -z $(docker images -q $IMAGE_NAME 2> /dev/null) ]] || $BUILD_IMAGE; then
    docker build -t "$IMAGE_NAME" . || exit 1
fi

DB_CONTAINER=`docker run -d -p $DB_PORT:3306 \
       -v "$DB_DATA_DIR:/var/lib/mysql" \
       -e MYSQL_RANDOM_ROOT_PASSWORD=yes \
       -e MYSQL_ONETIME_PASSWORD=yes \
       -e MYSQL_DATABASE="$DB_DATABASE" \
       -e MYSQL_USER="$DB_USERNAME" \
       -e MYSQL_PASSWORD="$DB_PASSWORD" \
       mysql`
echo $DB_CONTAINER

DB_HOST=`docker inspect --format='{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $DB_CONTAINER`

docker run -i -d -p 80:80 \
       -v /etc/localtime:/etc/localtime:ro \
       -e APACHE_SERVERNAME="$APACHE_SERVERNAME" \
       -e APP_ENV="$APP_ENV" \
       -e APP_DEBUG="$APP_DEBUG" \
       -e APP_KEY="$APP_KEY" \
       -e DB_HOST="$DB_HOST" \
       -e DB_PORT="$DB_PORT" \
       -e DB_DATABASE="$DB_DATABASE" \
       -e DB_USERNAME="$DB_USERNAME" \
       -e DB_PASSWORD="$DB_PASSWORD" \
       -e SEED_DATABASE="$SEED_DATABASE" \
       "$IMAGE_NAME"

#!/bin/sh
set -xe

# Detect the host IP
export DOCKER_BRIDGE_IP=$(ip ro | grep default | cut -d' ' -f 3)

if [ "$SYMFONY_ENV" = 'prod' ]; then
    composer install --prefer-dist --no-dev --no-progress --no-suggest --optimize-autoloader --classmap-authoritative
else
    composer install --prefer-dist --no-progress --no-suggest
fi

# Start Apache with the right permissions after removing pre-existing PID file
# REMOVED, does not work with Docker for Windows
# rm -f /var/run/apache2/apache2.pid
# exec docker/apache/start_safe_perms -DFOREGROUND

exec apache2-foreground

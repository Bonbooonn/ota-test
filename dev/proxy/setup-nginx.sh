#!/bin/sh

rm -f /etc/nginx/conf.d/*

for app in $SELECTED_APPS; do
    conf_file="/opt/nginx-config/${app}.conf"
    if [ -f "$conf_file" ]; then
        cp "$conf_file" /etc/nginx/conf.d/
    else
        echo "Warning: No configuration file found for $app"
    fi
done

# Start Nginx
nginx -g 'daemon off;'
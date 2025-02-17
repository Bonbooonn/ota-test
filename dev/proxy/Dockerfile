FROM nginx:stable-alpine

# Copy the setup script into the image
COPY ./proxy/setup-nginx.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/setup-nginx.sh

# Copy configuration files
COPY ./nginx/conf.d.proxy/ /opt/nginx-config/

EXPOSE 443
EXPOSE 80

ENTRYPOINT ["/usr/local/bin/setup-nginx.sh"]
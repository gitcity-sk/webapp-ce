FROM ubuntu:16.04

RUN apt-get update && apt-get install -y nginx

RUN rm /etc/nginx/sites-enabled/default

COPY nginx.conf /etc/nginx/sites-available/maymeow-cloud
ADD docker-entry.sh /

COPY 50x.html /errorpages/50x.html

RUN chmod +x /docker-entry.sh

# You can see the logs using `docker-compose logs web`.
RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

# Define working directory.
WORKDIR /etc/nginx

ENTRYPOINT /docker-entry.sh

EXPOSE 80 443

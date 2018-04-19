FROM registry.gitcity.eu/gitcity-sk/gitcity-build-images:php-7.2-fpm

COPY docker-entry.sh /usr/local/bin/docker-entry
RUN chmod +x /usr/local/bin/docker-entry

CMD ["docker-entry"]

FROM alpine
MAINTAINER May Meow <jdmaymeow@gmail.com>

RUN mkdir -p /var/opt/gitcity/git-data \
  && mkdir -p /var/opt/gitcity/git-data/.ssh \
  && mkdir -p /var/opt/gitcity/spaces-data

COPY . /var/www/html

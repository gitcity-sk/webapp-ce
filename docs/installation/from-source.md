# Installation from source

* Create folders where is data stored
* Install git and GIT + OpenSSH
* Install PHP + Composer
* Install NGINX
* Install and setup Database
* Install Redist
* Download and configure WebApp server
* Download and configure Workhorse
* Download and configure Shell
* Setup swap file (optional)

## data store paths

Create folder where you will have stored data

Main Application files

* `/opt/webapp/webapp-ce` - Web application files and shell
* `/opt/webapp/webapp-workhorse` - Workhorse files 
* `/opt/webapp/webapp-shell` - Workhorse files 
* `/opt/webapp/webapp-ce/storage` - Users uploaded binary files

Git data

* `/var/opt/webapp/data/git-data` - Where all git files are stored owned by GIT:GIT

Create folders

```bash
sudo mkdir -p /opt/webapp/webapp-ce \
&& sudo chown -R www-data:www-data /opt/webapp/webapp-ce
```

## Check for update and prerequisites

```bash
sudo apt update \
&& sudo apt install -y curl
```

## SSH and GIT

Nex create GIT user with folders and add www-data to git group

```bash
sudo apt update \
&& sudo mkdir -p /var/opt/webapp/data/git-data/ \
&& sudo apt install openssh-server git \
&& sudo adduser git --home /var/opt/webapp/data/git-data \
&& sudo chown -R git:git /var/opt/webapp/data/git-data
```

## PHP and Dependencies

```bash
sudo apt update \
&& sudo apt install php7.1-fpm php7.1-pgsql php7.1-mbstring php7.1-mcrypt php7.1-intl php7.1-dev \
&& curl -sSL https://getcomposer.org/installer | php \
&& mv composer.phar /usr/local/bin/composer
```

If you have php lover than 7.1.3 you have to reinstall it from source and install composer

```bash
curl -sSL https://getcomposer.org/installer | sudo php \
&& sudo mv composer.phar /usr/local/bin/composer
```

### Redis Extension Optional

```bash
git clone https://github.com/phpredis/phpredis.git \
&& cd phpredis \
&& git checkout 3.1.4 -b stable \
&& phpize [--enable-redis-igbinary] \
&& ./configure \
&& sudo make && sudo make install \
&& cd .. \
&& sudo rm -rf phpredis
```

```bash
sudo touch /etc/php/7.1/mods-available/redis.ini \
&& sudo echo extension=redis.so > /etc/php/7.1/mods-available/redis.ini \
&& sudo ln -s /etc/php/7.1/mods-available/redis.ini /etc/php/7.1/cli/conf.d/redis.ini \
&& cat /etc/php/7.1/mods-available/redis.ini \
&& sudo phpenmod redis \
&& sudo service php7.1-fpm restart
```

If last snippet not workikng edit redis ini manually and add there extension .


## Database Server

### Mysql

```bash
sudo apt update \
&& sudo apt install mysql-server
```

//TODO create database and user

```bash
mysql -u root -p
mysql> CREATE DATABASE platform DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci;

mysql> CREATE USER 'cakesource'@'localhost' IDENTIFIED BY 'cake$ource.2017';
mysql> GRANT ALL ON platform.* TO 'jeffrey'@'localhost';
mysql> FLUSH PRIVILEGES;
```

### PostgreSql RECOMENDED

Postgres Installation

```bash
sudo apt update \
&& sudo apt install -y postgresql postgresql-contrib
```

Login as Postgres user

```bash
sudo -i -u postgres
```

Following commands run as user `postgres` create new user and database

```bash
createuser --interactive gitcity-psql \
&& createdb gitcity-production
```

Grant acces to tabase for user cakeapp,

```bash
// Open Database console
psql

// And run following command
grant all privileges on database "gitcity-production" to "gitcity-psql" ;
\q
```

Update password for user

```bash
alter user "gitcity-psql" with encrypted password 'dLVk7sBcgL9UcFpxS';
\q
```

## Configure it

```bash
DB_CONNECTION=psql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=gitcity-production
DB_USERNAME=gitcity-psql
DB_PASSWORD=dLVk7sBcgL9UcFpxS
```

## Redis

```bash
sudo apt update \
&& sudo apt install -y redis-server
```

## NGINX

```bash
sudo apt update \
&& sudo apt install -y nginx \
&& sudo usermod -aG git www-data \ #Add www-data user to GIT group
&& sudo usermod -aG www-data git  #Add git to www-data
```

## SSL Settings Optional

We are using certificates from LetsEncrypt

Install certboot

```bash
sudo nano /etc/apt/sources.list.d/backports.list
deb http://ftp.debian.org/debian stretch-backports main

sudo apt update \
&& sudo apt-get install -y certbot -t stretch-backports
```

Sign certificates

```bash
sudo service nginx stop \
&& sudo certbot certonly --standalone -d gitcity.sk \
&& sudo service nginx start
```

## Webapp Download

```bash
sudo -u www-data -H git clone https://github.com/gitcity-sk/webapp-ce.git /opt/webapp/webapp-ce \
&& cd /opt/webapp/webapp-ce \
&& sudo -u www-data -H composer install
```

## CakeApp Configuration

```
cd /opt/webapp/webapp-ce/config \
&& udo -u www-data -H cp nginx.conf.default nginx.conf
```

Edit `nginx.conf` file and add at the end of document right before `}`.

```bash
sudo nano /etc/nginx/nginx.conf

# press i and documment add:
include /opt/webapp/webapp-ce/config/nginx.conf;

# for SSL edit paths to certificates and include
sudo -u www-data -H nano /opt/webapp/webapp-ce/config/nginx-ssl.conf
include /opt/webapp/webapp-ce/config/nginx-ssl.conf;

# press ESC, :wq and enter
sudo service nginx reload
```

## CakeApp-Workhorse

Workhorse is needed for all git operation ehivh is required write permission. Reading permission has GitCity application at it own.

```bash
sudo git clone https://github.com/gitcity-sk/gitcity-workhorse.git /opt/webapp/webapp-workhorse \
&& sudo chown -R git:git /opt/webapp/webapp-workhorse \
&& cd /opt/webapp/webapp-workhorse \
&& sudo -u git -H composer install
```

Configure service

```bash
sudo nano /lib/systemd/system/webapp-workhorse.service
```

Update file content for your requirements. Git user and groum must remain othervise you dont will lose write acces to git data folder.

```bash
[Unit]
Description=GitCity WorkHorse Daemon
After=network.target

[Service]
User=git
Group=git
ExecStart=/usr/bin/php /opt/webapp/webapp-workhorse/srv.php
WorkingDirectory=/var/opt/webapp/data/git-data
Type=simple
Restart=always
RestartSec=10
KillMode=process

[Install]
WantedBy=multi-user.target
```

Make System load new unit

```bash
sudo systemctl daemon-reload
```

Start Service and check status

```bash
systemctl start webapp-workhorse.service \
&& systemctl status webapp-workhorse.service
 ```

 If you want service to run after startup run following command

 ```bash
 sudo systemctl enable webapp-workhorse.service
 ```

# Webapp Git Shell

```bash
sudo git clone https://github.com/gitcity-sk/webapp-shell.git /opt/webapp/webapp-shell \
&& sudo chown -R git:git /opt/webapp/webapp-shell \
&& cd /opt/webapp/webapp-shell \
&& sudo -u git -H composer install
```


```bash
# update user for GIT GIT_SHELL
chown -R git:git /opt/webapp/webapp-ce/embeded/git-shell/ \
&& chmod +x /opt/webapp/webapp-shell/hooks/update \
&& chmod +x /opt/webapp/webapp-shell/hooks/pre-receive \
&& chmod +x /opt/webapp/webapp-shell/ssh-exec
```

# Swap space

Minimum ram is to running is 1GB + 2GB swap. For x GB i recomend to have x+1 GB swap file

```bash
sudo fallocate -l 2G /swapfile \
&& sudo chmod 600 /swapfile \
&& ls -lh /swapfile \
&& sudo mkswap /swapfile \
&& sudo swapon /swapfile
```

Verify if swapfile is awailable

```bash
sudo swapon --show
```

Enable swap after startup

```bash
sudo cp /etc/fstab /etc/fstab.bak \
&& echo '/swapfile none swap sw 0 0' | sudo tee -a /etc/fstab
```

Set swapiness to 10

```bash
sudo nano /etc/sysctl.conf
```

add at bottom of the file

```bash
vm.swappiness=10
```

You can check using of your memory with

```bash
free -m
```

# Instapp PHP from source

Install Build dependenices

```bash
sudo apt update \
&& sudo apt install -y --no-install-recommends \
libargon2-0-dev \
libcurl4-openssl-dev \
libedit-dev \
libsodium-dev \
libsqlite3-dev \
libssl-dev \
libxml2-dev \
zlib1g-dev \
build-essential \
libpq-dev \
pkg-config \
libxslt1-dev
```

Download php source

```bash
wget -O php.tar.gz "https://secure.php.net/get/php-7.2.2.tar.gz/from/this/mirror" \
&& sudo tar -xvzf php.tar.gz \
&& sudo mkdir /usr/src/php \
&& sudo cp -R ./php-7.2.2/* /usr/src/php
```

Configure it

```bash
cd /usr/src/php \
&& sudo mkdir -p /usr/local/etc/php \
&& sudo ./configure --with-config-file-path="/usr/local/etc/php" --with-config-file-scan-dir="/usr/local/etc/php/conf.d" --disable-cgi --enable-ftp --enable-mbstring --enable-intl --with-pdo-mysql --with-pdo-pgsql --with-pgsql --enable-mysqlnd --with-password-argon2 --with-sodium --enable-zip --enable-fpm --with-fpm-user=www-data --with-fpm-group=www-data --with-openssl --enable-exif --enable-bcmath --with-mhash --enable-sockets --with-curl --with-xmlrpc --with-xsl --with-zlib
```

Install php

```bash
cd /usr/src/php \
&& sudo make \
&& sudo make install
```

```bash
sudo pecl update-channels; \
sudo rm -rf /tmp/pear ~/.pearrc
```

## Configure  it

```bash
cd /usr/local/etc \
&& sudo sed 's!=NONE/!=!g' php-fpm.conf.default | sudo tee php-fpm.conf > /dev/null;

cd /usr/local/etc \
&& sudo cp php-fpm.d/www.conf.default php-fpm.d/www.conf;
```

## Update PID file config

```bash
cd /usr/local/etc \
&& sudo nano php-fpm.conf
```

update

```
[...]
pid = run/php-fpm.pid
[...]
```

## FPM port

```bash
cd /usr/local/etc/php-fpm.d \
&& sudo nano www.conf
```


## Create Service

Create service and paste following content

```bash
sudo nano /lib/systemd/system/php-7.2-fpm.service
```

```bash
[Unit]
Description=The PHP 7.2 FastCGI Process Manager
After=network.target

[Service]
Type=simple
PIDFile=/usr/local/var/run/php-fpm.pid
ExecStart=/usr/local/sbin/php-fpm --nodaemonize --fpm-config /usr/local/etc/php-fpm.conf
ExecReload=/bin/kill -USR2 $MAINPID

[Install]
WantedBy=multi-user.target
```

enable and run service

```bash
sudo systemctl enable php-7.2-fpm.service
sudo systemctl daemon-reload
sudo systemctl start php-7.2-fpm.service
sudo systemctl status php-7.2-fpm.service
```

## Memory Limits 

If you want to use project management you have to update memory limits for PHP (sometimes git diff eat a lot of memory) to avoid crashes.

```bash
cd /usr/local/etc/php/conf.d \
&& sudo nano memory.ini
```

then add to file `memory_limit = 2G` or 1G is enough for most situations.

Another possible configuration for php

```bash
./configure --prefix=/opt/php-7.2 --with-pdo-pgsql --with-zlib-dir --with-freetype-dir --enable-mbstring --with-libxml-dir=/usr --enable-soap --enable-calendar --with-curl --with-zlib --with-gd --with-pgsql --disable-rpath --enable-inline-optimization --with-bz2 --with-zlib --enable-sockets --enable-sysvsem --enable-sysvshm --enable-pcntl --enable-mbregex --enable-exif --enable-bcmath --with-mhash --enable-zip --with-pcre-regex --with-pdo-mysql --with-mysqli --with-mysql-sock=/var/run/mysqld/mysqld.sock --with-jpeg-dir=/usr --with-png-dir=/usr --with-openssl --with-fpm-user=www-data --with-fpm-group=www-data --with-libdir=/lib/x86_64-linux-gnu --enable-ftp --with-imap --with-imap-ssl --with-kerberos --with-gettext --with-xmlrpc --with-xsl --enable-opcache --enable-fpm
```

[Url](https://www.howtoforge.com/tutorial/how-to-install-php-7-on-debian/)
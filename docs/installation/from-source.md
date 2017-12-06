# Installation from source

* GIT + OpenSSH
* PHP + Composer
* NGINX
* Database
* Redist

## data store paths

Create folder where you will have stored data

```bash
sudo mkdir -p /var/opt/cakeapp/data/git-data/ /var/opt/cakeapp/data/buckets/ /var/opt/cakeapp/data/certificates/ \
&& sudo chown -R www-data:www-data /var/opt/cakeapp/data/
```

## Check for update and prerequisites

```bash
sudo apt update \
&& sudo apt install curl
```

## SSH and GIT

```bash
sudo apt update \
&& sudo apt install openssh-server git \
&& sudo adduser git --home /var/opt/cakeapp/data/git-data \
&& sudo chown -R git:git /var/opt/cakeapp/data/git-data \
&& sudo usermod -aG www-data git
```

```bash
# update user for GIT GIT_SHELL
chown -R git:git /var/opt/gitcity/embeded/git-shell/ \
&& chmod +x /var/opt/gitcity/embeded/git-shell/hooks/update \
&& chmod +x /var/opt/gitcity/embeded/git-shell/hooks/pre-receive
```

## PHP and Dependencies

```bash
sudo apt update \
&& sudo apt install php7.1-fpm php7.1-pgsql php7.1-mbstring php7.1-mcrypt php7.1-intl php7.1-dev \
&& curl -sSL https://getcomposer.org/installer | php \
&& mv composer.phar /usr/local/bin/composer
```

### Redis Extension

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
&& sudo apt install postgresql postgresql-contrib
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
alter user "gitcity-psql" with encrypted password 'yourPassword';
\q
```

## Configure it

```bash
DB_CONNECTION=psql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=gitcity-production
DB_USERNAME=gitcity-psql
DB_PASSWORD=yourPassword
```

## Redis

```bash
sudo apt update \
&& sudo apt install -y redis-server
```

## NGINX

```bash
sudo apt update \
&& sudo apt install -y nginx
```

## CakeApp Download

```bash
sudo git clone https://gitcity.sk/cakeapp-sk/cakeapp-ce.git /opt/gitcity \
&& sudo chown -R www-data:www-data /opt/gitcity \
&& cd /opt/gitcity \
&& composer install
```

## CakeApp Configuration

Edit `nginx.conf` file and add at the end of document right before `}`.

```bash
vi nginx.conf

# press i and documment add:
include /opt/gitcity/config/gitcity-nginx.conf;

# press ESC, :wq and enter
sudo service nginx reload
```

## CakeApp-Workhorse

Workhorse is needed for all git operation ehivh is required write permission. Reading permission has GitCity application at it own.

```bash
sudo git clone https://gitcity.sk/cakeapp-sk/cakeapp-workhorse.git /opt/gitcity-workhorse \
&& sudo chown -R git:git /opt/gitcity-workhorse \
&& cd /opt/gitcity-workhorse \
&& composer install
```

Configure service

```bash
sudo touch /lib/systemd/system/gitcity-workhorse.service
```

Update file content for your requirements. Git user and groum must remain othervise you dont will lose write acces to git data folder.

```bash
[Unit]
Description=GitCity WorkHorse Daemon
After=network.target

[Service]
User=git
Group=git
ExecStart=/usr/bin/php /opt/gitcity-workhorse/srv.php
WorkingDirectory=/var/opt/cakeapp/data/git-data
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
systemctl start gitcity-workhorse.service \
&& systemctl status gitcity-workhorse.service
 ```

 If you want service to run after startup run following command

 ```bash
 sudo systemctl enable gitcity-workhorse.service
 ```

# Swap space

Minimum ram is to running is 1GB + 3GB swap

```bash
sudo fallocate -l 3G /swapfile \
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

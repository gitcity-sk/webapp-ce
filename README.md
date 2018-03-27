# CodeOcean webapp

[![pipeline status](https://gitcity.sk/gitcity-sk/codeocean/webapp-ce/badges/master/pipeline.svg)](https://gitcity.sk/gitcity-sk/codeocean/webapp-ce/commits/master)

[![coverage report](https://gitcity.sk/gitcity-sk/codeocean/webapp-ce/badges/master/coverage.svg)](https://gitcity.sk/gitcity-sk/codeocean/webapp-ce/commits/master)

Open source software development platform with built-in version control, issue tracking. Build with laravel, self hosted on your own server.

[![](/resources/images/Discord-Logo-Wordmark-Color-sm.png)](https://discord.gg/hXukBug)

## Docummentation

* [Installation](/docs/installation/from-source.md)
* [Configuration](/docs/configuration/Index.md)
* [Api](/docs/apis/Index.md)

## Requirements

* PHP >= 7.0
* Database Mysql, MariaDB, PostgreSQL, MSSQL
* NGINX or APACHE
* REDIS
* Docker
* CodeOcean-workhorse for GIT operations

## Installation

Install PHP dependencies

```bash
composer install
```

Install javascript dependencies

```bash
npm install
```

Update Javascripts and CSS scripts

```bash
npm run dev
```

Update Javascripts and CSS scripts for codebase theme

```bash
gulp build
```

For git features you will need install gitcity-workhorse

```
git clone https://github.com/gitcity-sk/gitcity-workhorse.git
cd gitcity-workhorse
php srv.php
```

## Configuration

All paths are sent to workhorse from webapplicaton. Open `.env` file (in webapp project folder) and add following lines (update paths as you need)

```
GIT_DATA=/var/opt/gitcity/git-data/
GIT_SSH_KEYS=/var/opt/gitcity/git-data/.ssh/
SPACES_DATA=/data/spaces
GITCITY_SHELL_HOOKS=/opt/gitcity/embeded/git-shell/hooks/
```

* Setup Database

Supported are Mysql, MariaDB, PostgreSQL, MSSQL. Edit `.env` file and setup credentials. If you dont have acces to sql server you can use `sqlite`.

* Setup web app application

```
php artisan key:generate
php artisan migrate
php artisan db:seed
```

* Run server and navigate to `localost:8000`.

```
php artisan server
```

## Screenshots

![](/docs/img/chrome_2018-03-27_22-46-25.png)
![](/docs/img/chrome_2018-03-27_22-46-42.png)
![](/docs/img/chrome_2018-03-27_22-46-51.png)
![](/docs/img/chrome_2018-03-27_22-47-02.png)
![](/docs/img/chrome_2018-03-27_22-47-10.png)

## Contributing

1. Create issue in issue tracker. If you dont know what see directions section.
2. Fork it!
3. Create your feature branch: `git checkout -b my-new-feature`. Naming is `{issue-id}-{issue-title-without-spaces}`.
4. Commit your changes: `git commit -am 'Add some feature'`
5. Push to the branch: `git push origin my-new-feature`
6. Submit a pull request :)

## Directions

What to do?

* Next month
  * Add more tests
  * Finalize spaces (add views and controllers), single file uploading
  * Finalize ACL (roles and permissions)
  * Finalize issues (add assignees, allow to close/re-open issue)
  * Add mailers (when role, issue assigned)
* Next two months
  * Chunked upload to spaces

More will come.

## License

MIT

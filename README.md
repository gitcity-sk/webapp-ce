# CodeOcean webapp

Webapp for project management

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
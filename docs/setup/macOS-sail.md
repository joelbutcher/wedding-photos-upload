# macOS Setup - Laravel Sail

- [Pre-requisites](#pre-requisites)
  - [Docker](#docker)
  - [Homebrew, PHP & Composer](#homebrew)
- [Getting Started](#getting-started)
- [Configuration](#configuration)
  - [Environment](#environment)
  - [Database](#database)

<a name="pre-requisites"></a>
## Pre-requisites

<a name="docker"></a>
### Docker
Before continuing, please install the latest version of [Docker Desktop for Windows](https://docs.docker.com/desktop/windows/install/).

> **warning** Ensure you are using the version tailored to your machines architecture

<a name="homebrew"></a>
### Homebrew, PHP & Composer

In order to use Laravel Sail, you first need to install the latest version of PHP (8.1) and composer.
You can do this via [Homebrew](https://brew.sh). Homebrew is a simple package manager for macOS, please
refer to their installation guide before continuing.

To install PHP run the following:

```shell
brew install php
```

Similarly, you can install composer using the same `brew` console command:

```shell
brew install composer
```

Once PHP and composer have been installed, verify they are installed:

```shell
php -v

composer -V
```


To run the site within Laravel Sail, you will first need to install the projects composer dependencies.
This can be done via the `composer` console command:

```shell
composer install
```


<a name="getting-started"></a>
## Getting Started

Once you have Docker Desktop installed and running on your machine, and have installed the required
project dependencies for composer, you're ready to start using Laravel Sail. This is super easy
and can be achieved by using the binary with Laravel Sail:

```shell
./vendor/bin/sail up -d
```

> **note** the `-d` argument instructs docker to run its containers in daemon mode (in the background).

Once your containers have started, you visit the project at [`http://localhost`](http://localhost).

You may want to visit the site from a particular development domain, such as `wedding.test`.
To do so, add the following to you `/etc/hosts` file:


```
127.0.0.1       wedding.test
```

<a name="configuration"></a>
## Configuration

You will need to ensure the application is properly configured to serve the application locally.

<a name="environment"></a>
### Environment

Before we start, please copy the `.env.example` file:

```shell
cp .env.example .env
```

You will then need generate an application key (`APP_KEY`). This is used for a variety of purposes,
such as encrypting session cookies and generating cache keys. This key can be generated using `artisan`:

```shell
sail artisan key:generate
```

<a name="database"></a>
### Database

To create a new database, you will need a database management application tool,
such as [TablePlus](https://tableplus.com) or [Sequel Ace](https://sequel-ace.com).
You will then need to create a database called `wedding`, if it doesn't already exist.

To connect to you database using TablePlus, or Sequel Ace, configure your connection with the following values:

```
host=127.0.0.1
port=3306
database=wedding
user=sail
password=password
```

In order for Laravel to communicate with your database, you will need to update
the `.env` file you copied above to use the correct variable names:


```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wedding
DB_USERNAME=sail
DB_PASSWORD=password
```

You can test the database connection by running your migrations via the `artisan` console command:

```shell
sail artisan mgirate:fresh --seed
```

This command will generate your database schema (table) and seed the application with test data.

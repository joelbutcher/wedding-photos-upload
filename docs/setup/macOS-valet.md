# macOS Setup - Laravel Valet

- [Pre-requisites](#pre-requisites)
  - [Homebrew, PHP & Composer](#homebrew)
  - [Node](#node)
  - [Laravel Valet](#valet)
  - [MySQL](#mysql)
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

In order to use Laravel Valet, you first need to install the latest version of PHP (8.1) and composer.
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


You will then need to install the projects composer dependencies.
This can be done via the `composer` console command:

```shell
composer install
```

<a name="node"></a>
### Node

To compile the projects frontend assets, you will need to have the latest version of Node and NPM installed.
This can be done via the `brew` console command:

```shell
brew install node
```

Confirm Node and NPM are installed using the following commands:

```shell
node -v
npm -v
```

You will then need to install and compile the projects frontend assets.
This can be done via the `npm` console command:

```shell
npm install

npm run dev
```

> **Note** This project also supports hot reloading via `npm run hot`.

<a name="valet"></a>
### Laravel Valet

To serve the site, this project relies on [Laravel Valet](https://laravel.com/docs/valet). You can install Valet using `composer`:

```shell
composer global require laravel/valet
```

You will then need to run the `install` to ensure Laravel Valet has all the required dependencies needed to run:

```shell
valet install
```

<a name="mysql"></a>
### MySQL

This project uses a MySQL database for storing uploads, users, sessions and other data.
It is recommended that you install a MySQL server using [DBngin](https://dbngin.com),
you can then choose the MySQL services you wish to use by launching the desktop application.

DBNgin can be installed using Homebrew and the `brew` console command:

```shell
brew install dbngin
```

<img width="724" alt="Screenshot 2022-06-22 at 19 00 32" src="https://user-images.githubusercontent.com/7163152/175105548-7e303d35-ed72-46ab-9920-fd7907eb78be.png">

<a name="getting-started"></a>
## Getting Started

Once you have all the pre-requisites installed, you are ready to serve your site using Larvel Valet. 
To serve your site use the `valet link` command:

```shell
valet link wedding --secure
```

> **Note** the `--secure` argument instructs Valet to serve the site securely using TLS.
> Whilst this is recommended, you can serve the site over a standard connection by omitting the argument.

You should now be able to visit the site at [`https://wedding.test`](https://wedding.test)

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
user=root
password=<root-user-password>
```

In order for Laravel to communicate with your database, you will need to update
the `.env` file you copied above to use the correct variable names:


```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wedding
DB_USERNAME=root
DB_PASSWORD=<root-user-password>
```

You can test the database connection by running your migrations via the `artisan` console command:

```shell
sail artisan mgirate:fresh --seed
```

This command will generate your database schema (table) and seed the application with test data.

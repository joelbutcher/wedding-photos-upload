# Laravel Photos Upload Demo

- [Installation](#installation)
    - [Install Homebrew](#install-homebrew)
    - [Install PHP](#install-php)
    - [Install Composer](#install-composer)
    - [Install Node](#install-node)
    - [Install Laravel Valet](#install-valet)
    - [Install MySQL](#install-mysql)
- [Configuration](#configuration)
    - [Environment](#environment)
    - [Database](#database)
- [Development](#development)
    - [Frontend](#frontend)

<a name="installation"></a>
## Installation

This setup guide is for macOS only. For Windows, please use [WSL2](https://docs.microsoft.com/en-us/windows/wsl/install) and [Laravel Sail](https://laravel.com/docs/sail) (Docker).

<a name="install-homebrew"></a>
### Install Homebrew

Homebrew is a package manager for macOS. Please follow the official install instructions here: http://brew.sh

<a name="install-php"></a>
### Install PHP

Laravel runs on PHP, install the latest version using the `brew` command:

```shell
brew install php@8.1
```

Confirm PHP is installed

```shell
php -v
```

Ensure the PHP symlink is pointing to the correct version:

```shell
brew link --force --overwrite php@8.2
```

<a name="install-composer"></a>
### Install Composer

Composer is a modern package manager for PHP applications. You can install Composer using the `brew` command:

```shell
brew install composer
```

Confirm composer is installed:

```shell
composer -V
```

<a name="install-node"></a>
### Install Node

To compile the projects frontend assets, you will need to have the latest version of Node and NPM installed, this can be done via the `brew` console command:

```shell
brew install node
```

Confirm Node and NPM are installed using the following commands:

```shell
node -v
npm -v
```

<a name="install-valet"></a>
### Install Laravel Valet

To serve the site, this project relies on [Laravel Valet](https://laravel.com/docs/valet). You can install Valet using `composer`:

```shell
composer global require laravel/valet
```

You will then need to run the `install` to ensure Laravel Valet has all the required dependencies needed to run:

```shell
valet install
```

<a name="install-mysql"></a>
### Install MySQL

This project uses a MySQL database for storing uploads, users, sessions and other data. It is recommended that you install a MySQL server using [DBngin](https://dbngin.com), you can then choose the MySQL services you wish to use by launching the desktop application. DBNgin can be installed using Homebrew and the `brew` console command:

```shell
brew install dbngin
```

<img width="724" alt="Screenshot 2022-06-22 at 19 00 32" src="https://user-images.githubusercontent.com/7163152/175105548-7e303d35-ed72-46ab-9920-fd7907eb78be.png">

<a name="configuration"></a>
## Configuration

You will need to ensure the application is properly configured to serve the application locally. 


<a name="environment"></a>
### Environment

Before we start, please copy the `.env.example` file:

```shell
cp .env.example .env
```

You will then need generate an application key (`APP_KEY`). This is used for a variety of purposes, such as encrypting session cookies and generating cache keys. This key can be generated using `artisan`:

```shell
php artisan key:generate
```

<a name="database"></a>
### Database

To create a new database, you will need a database management application tool, such as [TablePlus](https://tableplus.com) or [Sequel Ace](https://sequel-ace.com). You will then need to create a database called `wedding`. You will then need to ensure the following is configured correctly:

```
host = 127.0.0.1
port = 3306
databaseName = wedding
user = root
password = <root-password>
```

In order for Laravel to communicate with your database, you will need to update the `.env` file you copied above to use the correct variable names:


```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wedding
DB_USERNAME=root
DB_PASSWORD=<root-password>
```

You can test the database connection by running your migrations via the `artisan` console command:

```shell
php artisan mgirate:fresh --seed
```

This command will generate your database schema (table) and seed the application with test data.

<a name="Development"></a>
## Development

Before we're ready to serve the site and view it in a browser, you need to insure we've installed all the projects dependencies.

<a name="frontend"></a>
### Frontend

Frontend dependencies are installed and compiled via the `npm` console command:

```shell
npm install

npm run dev
```

> **Note** You can turn on hot reloading using the `npm run hot` command

<a name="backend"></a>
### Backend

Backend dependencies are installed via the `composer` console command:

```shell
composer install
```

### Serving The Site

Now that we have all the projects dependencies installed, and the site is configured properly, we can serve the site via [Laravel Valet](https://laravel.com/docs/valet):


```shell
valet link my-site --secure
```

You should then be able to "visit" the site locally in your browser at [`https://my-site.test`](https://my-site.test)

> **Note** The `--secure` option instructs Laravel Valet to link the site using TLS and issues an SSL certificate for the site, adding it to your Mac Keychain.

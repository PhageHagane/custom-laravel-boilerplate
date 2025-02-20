# Laravel Boilerplate 6.0.5 (Customized)

## Introduction

Laravel Boilerplate 6.0.5 provides developers with a robust starting point for building Laravel applications. It includes built-in authentication, role and permission management, user management, and various UI components built on Bootstrap.

### Features

- Laravel 6.x Support
- Pre-configured authentication system
- User & Role management
- Bootstrap-based UI
- API-ready structure
- Built-in notifications
- Command-line tools for easier management

## Installation

### 1. Download the Repository

Download the repository through this link: [Laravel Boilerplate v6.0.5](https://github.com/rappasoft/laravel-boilerplate/archive/refs/tags/v6.0.5.zip) and extract the contents.

```sh
cd laravel-boilerplate
```

### 2. Install Dependencies

```sh
composer install
composer config repositories.phagehagane-l5b-crud vcs https://github.com/PhageHagane/l5b-crud/
composer require yajra/laravel-datatables-buttons:^4.10 yajra/laravel-datatables-oracle:^9.14 laravel/helpers pqrs/l5b-crud dev-master
npm install
npm install datatables.net-bs4@^1.10.22 datatables.net-responsive-bs4@^2.2.6 jszip@^3.5.0 pdfmake@^0.1.68 tempusdominus-bootstrap-4@^5.1.2 --save
npm install datatables.net-buttons-bs4@^1.7.1 --save-dev
```

### 3. Configure the Application

```sh
cp .env.example .env
php artisan key:generate
```

### 4. Set Up Database

```sh
php artisan migrate --seed
php artisan storage:link
```

### 5. Configuration Updates

#### config/app.php

```php
'providers' => [
    ...
    Yajra\DataTables\DataTablesServiceProvider::class,
],

'aliases' => [
    ...
    'Datatables' => Yajra\DataTables\Facades\DataTables::class,
],
```

#### resources/js/backend/app.js

```js
// datatables
import "datatables.net-bs4";
require("datatables.net-buttons-bs4");
import "datatables.net-responsive-bs4";
import "datatables.net-buttons/js/buttons.colVis.min";
import "datatables.net-buttons/js/dataTables.buttons.min";
import "datatables.net-buttons/js/buttons.flash.min";
import "datatables.net-buttons/js/buttons.html5.min";
import "datatables.net-buttons/js/buttons.print.min";
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
import jsZip from "jszip";
window.JSZip = jsZip;
pdfMake.vfs = pdfFonts.pdfMake.vfs;
```

#### resources/sass/backend/app.scss

```scss
@import '~datatables.net-bs4/css/dataTables.bootstrap4.css';
@import "~tempusdominus-bootstrap-4/src/sass/_tempusdominus-bootstrap-4";
```

### 6. Start the Development Server

```sh
php artisan serve
```

Access your application at `http://127.0.0.1:8000`.

## Demo Credentials

**User:** [admin@admin.com](mailto:admin@admin.com)\
**Password:** secret

## Official Documentation

[Click here for the official documentation](http://laravel-boilerplate.com)

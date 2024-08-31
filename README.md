
# SAKARITAM APP

A demo application to illustrate how SAKARITAM Admin works.

![SAKARITAM Demo](https://raw.githubusercontent.com/dyzcdn/santulitam/main/public/images/Dashboard%20-%20Santulitam.png)

This project is named SAKARITAM or Sistem Absensi Karisma Santulitam. This web application is used to make it easier for Karisma Santulitam ITPLN 2024 participants.

## Installation

Clone the repo locally:

```sh
git clone https://github.com/dyzcdn/santulitam.git santulitam && cd santulitam
```

Install PHP dependencies:

```sh
composer install
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Create an SQLite database. You can also use another database (MySQL, Postgres), simply update your configuration accordingly.

```sh
touch database/database.sqlite
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

> **Note**  
> If you get an "Invalid datetime format (1292)" error, this is probably related to the timezone setting of your database.  
> Please see https://dba.stackexchange.com/questions/234270/incorrect-datetime-value-mysql


Create a symlink to the storage:

```sh
php artisan storage:link
```

Run the dev server (the output will give the address):

```sh
php artisan serve
```

You're ready to go! Visit the url in your browser, and login with:

-   **Username:** admin@s.id.com
-   **Password:** password

## Features to explore

### QR Code Generator
Check it
```sh
http://localhost:8000/qr/students/{value}/{format}
```

Parameter :

- value
- format
    - png
    - svg
    - html
    

### Attendance

-   Scanner Attendance

-   Attendance Managemer

### Users Management

-   Add, Edit, Delete Users

-   Edit Profile

### Data Master Management

-   Cofasilitator Management

-   Peleton Management

-   Student Management

### Instance Management

-   Faculties Management

-   Major Management

### Karisma Management

-   Theme Management

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

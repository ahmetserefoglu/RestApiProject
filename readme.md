## Installation

Postman üzerinde endpointler verilmiştir.

$ git clone https://github.com/ahmetserefoglu/RestApiProject.git
$ cd www/RestApiProject

//Laravel Bölümü
$ composer install
$ copy .env.example .env
$ php artisan key:generate
$ php artisan migrate
$ php artisan passport:install
$ php artisan serve

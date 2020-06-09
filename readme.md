# Installation

Postman üzerinde endpointler [https://web.postman.co/collections/3980989-74e8347a-c1fc-4c5e-b255-b2ff8b2d5759?version=latest&workspace=16734ff7-b276-4d59-8297-b080943a9421] verilmiştir.

$ git clone https://github.com/ahmetserefoglu/RestApiProject.git
$ cd www/RestApiProject

##Laravel Bölümü		
$ composer install
$ copy .env.example .env
$ php artisan key:generate
$ php artisan migrate
$ php artisan passport:install

$ php artisan serve


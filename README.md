# Laravel To Do List

### We are using following technologies:

 - Laravel
 - [Laravel/sail](https://laravel.com/docs/8.x/sail)
 - Vue v2
 - Tailwindcss
 - php 7.4 or later

### Set up after clone
 
 - cp .env.example .env
 - composer install
 - php artisan sail:install
 - ./vendor/bin/sail up -d
 - ./vendor/bin/sail artisan migrate
 - ./vendor/bin/sail sail yarn
 - ./vendor/bin/sail sail yarn dev

### Running test

 - ./vendor/bin/sail artisan test

# The Open Clinic

An opensource software for small and mini clinics to automate and track stock and patient information.

## Tech

The Open Clinic uses a number of open source projects to work properly:

- [Laravel] - The PHP Framework For Web Artisans!
- [jQuery] - jQuery is a fast, small, and feature-rich JavaScript library.
- [tailwindcss] - Rapidly build modern websites without ever leaving your HTML

## Installation
Clone & Install the dependencies and devDependencies and start the server.

```sh
git clone https://github.com/alaksandarjesus/theopenclinic.git

cd theopenclinic

composer update

npm install
```


copy & paste .env.example as .env

update superadmin details in .env file

update database information

Then run below commands

```
php artisan key:generate
php artisan migrate:refresh --seed
```

For development Envirnonment

```
php artisan serve
npm run watch
```

For production environment
```
npm run prod
```


## Demo Testing

To test the demo working on your local navigate to
```
database\seeders\DatabaseSeeder.php
```
and toogle comments as instructed

if you  want to see demo credentials, remove {{-- and --}} from 
```
resources\views\guest\login\index.blade.php
```



[Laravel]: <https://laravel.com/>
[jQuery]: <https://jquery.com/>
[tailwindcss]: <https://tailwindcss.com/>
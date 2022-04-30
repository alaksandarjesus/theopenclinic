## Installation

Clone the repository

    git clone https://github.com/alaksandarjesus/AMS-CLINIC.git

    cd AMS-CLINIC

    composer update

    npm install

Create a mysql database

Copy .env.example & Rename .env

Update your db credentials

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=openclinic
    DB_USERNAME=root
    DB_PASSWORD=

If you want to test with dummy data

    php artisan migrate:refresh --seed 

If you dont want dummy data, use seeders to set super administrator and roles

Generate a key for your application

    php artisan key:generate

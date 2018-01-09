# Vue Todo

A simple Vue & Laravel based todo app.


# Installation
```
cd \todo-dir
composer install
cp .env.example .env
```

Update the database credentials and name in the `.env` file and setup the cache & session options (they are set to file by default).

```
php artisan key:generate
php artisan migrate
npm install
npm run prod
```

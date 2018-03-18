
## Backend TEST

- He desarrollado la prueba con Laravel 5.4
- Añadido a composer la libreria Goutte
- Mysql como base de datos
- php artisan talentier:data devuelve los últimos 10 links
- php artisan talentier:test ejecuta el spider para la web https://www.isdin.com parametrizable desde DB.
- Por defecto almacena los headers X-Generator y Cache-Control parametrizables desde DB.

## Instalación

- .env tiene creada un DB: talienter. 
- La podemos crear desde mysql -u <login> -p y create database talentier;
- git clone https://github.com/jordivr/backend_test.git
- cd backend_test
- composer install
- DB: php artisan migrate:install
- DB: php artisan migrate:refresh
- DB: php artisan db:seed -> Populate DB

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

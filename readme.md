1. go to .env file and change the database credentials and admin credentials.
2. open cmd at this folder root and run the following commands :
	php artisan config:cache
	php artisan migrate:refresh --seed
3. go to browser and run the application.
4. for example your url is localhost/aems/public/ then go to admin panel on this localhost/aems/public/admin and do the insert, update, active and deactive of event,college and otherthings.

Thank you.
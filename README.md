# certificate-manager

App to manager certificates, it will be possible to create a new self-signed certificate, import a certificate and view all the certificates the app is managing.
It will also be possible to receive emails telling in advance that a certain certificate is going to expire soon. 
I'm planning to send slack notifications regarding expiration dates.

I don't have to mention that it will also be possible to export (download) a certificate.

# Dependencies

- php >= 5.3
- composer
- laravel >= 5.3.10
- database engine MySQL or PostgreSQL (currently using MySQL in development)
- libssl-dev (openssl-devel)
- php-mysql
- php-ssh2

# How to use it
Clone the repository in the desired location.

In the root of the desired location:

- Create a .env file based on the example.
- Create directories:
	- storage/framework
	- storage/framework/cache
	- storage/framework/sessions
	- storage/framework/views

```
	$ composer install
	$ php artisan key:generate
	$ php artisan config:cache
	$ php artisan migrate
```

To start the development server

```
	$ php artisan serve
```

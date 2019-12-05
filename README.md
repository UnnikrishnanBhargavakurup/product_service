# Product Service
Microservices implementation in Symfony 4 for managing products and orders

Installation
------------

In order to install this service do the following:

- Get the application code and install php dependencies and node packages.
```bash
git clone https://github.com/UnnikrishnanBhargavakurup/product_service.git
cd product_service
composer install
cp .env .env.local
```

- Open `.env.local` and insert your MySQL database credentials. Let's say it will be look like this:
```yaml
DATABASE_URL=mysql://myuser:mypassword@127.0.0.1:3306/product_service?serverVersion=5.7
```

- Run the following command to build database tables
```bash

# To Create The Database (DEV Purposes)
php bin/console doctrine:database:create

# Generate Migrations Diff (Not Needed Since Latest with The Repo)
php bin/console doctrine:migrations:migrate

```

- Run the following command to seed our database with products, customers and offers
```bash
php bin/console doctrine:fixtures:load
```

- We are ready to run our application
```bash
php bin/console server:start
```

Open your browser and access `http://127.0.0.1:8000/api/doc/` for API

access  `http://127.0.0.1:8000/api/doc/` for Admin UI

How to use this service
-----------------------



Misc
----

### Testing



### Changelog

Version 1.0.0:

### Acknowledgements

Released under the [MIT License](http://www.opensource.org/licenses/mit-license.php).

**Product Service** is authored and maintained by [@UnnikrishnanBhargavakurup](https://github.com/UnnikrishnanBhargavakurup).
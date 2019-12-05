# Product Service
Microservices implementation in Symfony 4 for managing products and orders

Requirements
------------

  * PHP 7.1.3 or higher;
  * PDO_MYSQL PHP extension enabled;
  * and the [usual Symfony application requirements][2].
  
Installation
------------

In order to install this service do the following:

- Get the application code and installing dependencies.
```bash
git clone https://github.com/UnnikrishnanBhargavakurup/product_service.git
cd product_service
composer install
```
- Creating and configuring database
Create `.env.local` file using the following command

```bash
cp .env .env.local
```
Open `.env.local` and insert your MySQL database credentials. Let's say it will be look like this:
```yaml
DATABASE_URL=mysql://myuser:mypassword@127.0.0.1:3306/product_service?serverVersion=5.7
```

- Run the following command to build database tables
```bash

# To Create The Database (DEV Purposes)
php bin/console doctrine:database:create

# To Create Database Schema
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

How To Use?
----------



Misc
----

### Testing



### Changelog

Version 1.0.0:

### Acknowledgements

We have an issue with 500 server error exception handling in API's. You can see the details of the issue here[3] this issue will taken care of after the merge

Released under the [MIT License](http://www.opensource.org/licenses/mit-license.php).

**Product Service** is authored and maintained by [@UnnikrishnanBhargavakurup][1].

[1]: https://github.com/UnnikrishnanBhargavakurup
[2]: https://symfony.com/doc/current/reference/requirements.html
[3]: https://github.com/FriendsOfSymfony/FOSRestBundle/issues/2031
# Product Service
A microservices implementation in Symfony 4 for basic products, offer, cutomer and orders management

## Enabled Bundles

Concern  | Bundles
-------  | -------
Documentation   | [`NelmioApiDocBundle`]
ORM      | [`DoctrineBundle`]
REST API | [`FOSRestBundle`]
Administration backend  | [`EasyAdminBundle`]

## Features
- CRUD operations for products, order, orderitem, customer and offers
- Creation of product bundles
- API for acessing order information
- API for product listing with discounted price

## Requirements
  * PHP 7.1.3 or higher;
  * PDO_MYSQL PHP extension enabled;
  * and the [usual Symfony application requirements][2].
  
## Try it Yourself

- Get the application code and installing dependencies.

```bash
git clone https://github.com/UnnikrishnanBhargavakurup/product_service.git
cd product_service
composer install

# Create `.env.local` file using the following command
cp .env .env.local
```

- Open `.env.local` and insert your MySQL database credentials. Let's say it will be look like this:
```yaml
DATABASE_URL=mysql://myuser:mypassword@127.0.0.1:3306/product_service?serverVersion=5.7
```

- Run the following command to build database tables

```bash
# To Create The Database (DEV Purposes)
bin/console doctrine:database:create --if-not-exists

# To Create Database Schema 
php bin/console doctrine:migrations:migrate

# Run the following command to seed the database with products, customers and offers
php bin/console doctrine:fixtures:load

# We are ready to run our application
php -S 127.0.0.1:8000 -t public
```

## How To Use?


For accessing API end points open the browser and access `http://127.0.0.1:8000/api/doc/`

For accessing Admin related functions access `http://127.0.0.1:8000/api/doc/`

1. Manage a list of products that have prices.
  `http://127.0.0.1:8000/admin/?entity=Product` Or using the product API's
2. Enable the administrator to set concrete prices (such as 10EUR) and discounts to prices either by a concrete amount (-1 EUR) or by percentage (-10%).
  `http://127.0.0.1:8000/admin/?entity=Offer`
3. Enable the administrator to group products together to form bundles (which is also a
product) that have independent prices.
  `http://127.0.0.1:8000/admin/?entity=Product&action=new` Or using the product API's
4. Enable customers to get the list of products and respective prices.
  Use `Custom` API endpoint `http://127.0.0.1:8000//api/product-list`  
5. Enable customers to place an order for one or more products
  create an order using `Order` API all OrderItems using `OrderItem` API
6. provide customers with the list of products and the total price.
  Use `Custom` API endpoint `http://127.0.0.1:8000/api/order-details/{orderId}`

## Testing

Need to implement

## Changelog

Version 1.0.0:

## Acknowledgements

We have an issue with `500 exception handling` in API's. You can see the details of the issue [Symfony 4.4 compatibility: use Either ErrorListener or ExceptionListener][3] this issue will taken care of once the fix is merged to master and available for download.

Released under the [MIT License](http://www.opensource.org/licenses/mit-license.php).

**Product Service** is authored and maintained by [@UnnikrishnanBhargavakurup][1].

[1]: https://github.com/UnnikrishnanBhargavakurup
[2]: https://symfony.com/doc/current/reference/requirements.html
[3]: https://github.com/FriendsOfSymfony/FOSRestBundle/issues/2031

[`DoctrineBundle`]: https://github.com/doctrine/DoctrineBundle
[`NelmioApiDocBundle`]: https://github.com/nelmio/NelmioApiDocBundle
[`FOSRestBundle`]: https://github.com/FriendsOfSymfony/FOSRestBundle
[`EasyAdminBundle`]: https://github.com/EasyCorp/EasyAdminBundle

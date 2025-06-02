# Acme – PHP Basket System

## Description
A simple PHP-based shopping basket prototype for Acme.

## Features
- Product catalog from MySQL
- Delivery charges based on total
- Offer: Buy one red widget, get the second half-price

## Setup

1. Import the `schema.sql` into MySQL:
    ```
    mysql -u root -p < schema.sql
    ```
2. Update `config.php` with your database credentials.
3. Run:
    ```
    php index.php
    ```

## Expected Output Examples

- Basket: R01, R01 → $54.37
- Basket: B01, G01 → $37.85
- Basket: R01, G01 → $60.85
- Basket: B01, B01, R01, R01, R01 → $98.27

## Notes
- Products are loaded from the database.
- Offers can be extended in `Basket.php`.


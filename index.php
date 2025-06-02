<?php

require 'db.php';
require 'Basket.php';

$deliveryRules = [
    50 => 4.95,
    90 => 2.95,
    PHP_INT_MAX => 0.00
];

$offers = [
    'R01' => ['type' => 'bogo_half']
];

$basket = new Basket($pdo, $deliveryRules, $offers);
$basket->add('R01');
$basket->add('R01');

echo "Total: $" . $basket->total();


?>


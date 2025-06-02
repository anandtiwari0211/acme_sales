<?php

class Basket {
    private $products = [];
    private $deliveryRules;
    private $offers;
    private $items = [];

    public function __construct($pdo, $deliveryRules, $offers) {

        $stmt = $pdo->query("SELECT * FROM products");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->products[$row['code']] = [
                'name' => $row['name'],
                'price' => $row['price']
            ];
        }

        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
    }

    public function add($productCode) {
        if (!isset($this->products[$productCode])) {
            throw new Exception("Product code not found: " . $productCode);
        }
        $this->items[] = $productCode;
    }

    public function total() {
        $subtotal = 0;
        $itemCounts = array_count_values($this->items);

        foreach ($itemCounts as $code => $qty) {
            $price = $this->products[$code]['price'];

            // Offer: Buy One, Get Second Half Price for Red Widget
            if (isset($this->offers[$code]) && $this->offers[$code]['type'] === 'bogo_half') {
                $pairs = floor($qty / 2);
                $remaining = $qty % 2;
                $subtotal += $pairs * ($price + $price / 2) + $remaining * $price;
            } else {
                $subtotal += $qty * $price;
            }
        }

        $delivery = 0;
        foreach ($this->deliveryRules as $threshold => $cost) {
            if ($subtotal < $threshold) {
                $delivery = $cost;
                break;
            }
        }

        return number_format($subtotal + $delivery, 2);
    }
}
?>


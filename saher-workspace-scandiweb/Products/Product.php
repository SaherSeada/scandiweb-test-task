<?php
abstract class Product {
    private $sku;
    private $name;
    private $price;
    private $attribute;

    public function __construct($sku, $name, $price) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = number_format($price,2);
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function checkSKU($newSKU, $allProducts) {
        while($row = mysqli_fetch_assoc($allProducts)) {
            if ($row['SKU'] == $newSKU) {
                return false;
            }
        }
        return true;
    }

    abstract public function displayProduct();
    abstract public function getAddQuery();
}
?>
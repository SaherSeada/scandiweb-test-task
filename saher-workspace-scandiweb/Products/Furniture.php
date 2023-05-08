<?php
require_once('Product.php');

class Furniture extends Product {
    
    const ATTRIBUTE_NAME = 'Dimension';

    public function displayProduct() {
        echo "<li> <input type='checkbox' class='delete-checkbox' name='{$this->sku}'> <br/> <p class='listItem'> {$this->sku} <br/> {$this->name} <br/> {$this->price} $ <br/> Dimension: {$this->attribute} </p></li>";
    }

    public function getAddQuery() {
        $query = "INSERT INTO `products` (`SKU`, `Name`, `Price`, `Type`, `Dimension`) VALUES ('{$this->sku}', '{$this->name}', '{$this->price}', 'Furniture', '{$this->attribute}');";
        return $query;
    }
}
?>
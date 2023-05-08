<?php
require_once('Product.php');

class Book extends Product {

    const ATTRIBUTE_NAME = 'Weight';

    public function displayProduct() {
        echo "<li> <input type='checkbox' class='delete-checkbox' name='{$this->sku}'> <br/> <p class='listItem'> {$this->sku} <br/> {$this->name} <br/> {$this->price} $ <br/> Weight: {$this->attribute} KG</p></li>";
    }

    public function getAddQuery() {
        $query = "INSERT INTO `products` (`SKU`, `Name`, `Price`, `Type`, `Weight`) VALUES ('{$this->sku}', '{$this->name}', '{$this->price}', 'Book', '{$this->attribute}');";
        return $query;
    }
}
?>
<?php
require_once('Product.php');

class DVD extends Product {
    
    const ATTRIBUTE_NAME = 'Size';

    public function displayProduct() {
        echo "<li> <input type='checkbox' class='delete-checkbox' name='{$this->sku}'> <br/> <p class='listItem'> {$this->sku} <br/> {$this->name} <br/> {$this->price} $ <br/> Size: {$this->attribute} MB</p></li>";
    }

    public function getAddQuery() {
        $query = "INSERT INTO `products` (`SKU`, `Name`, `Price`, `Type`, `Size`) VALUES ('{$this->sku}', '{$this->name}', '{$this->price}', 'DVD', '{$this->attribute}');";
        return $query;
    }
}
?>
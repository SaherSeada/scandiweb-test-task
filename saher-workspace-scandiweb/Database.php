<?php

require('Products/Book.php');
require('Products/Furniture.php');
require('Products/DVD.php');

class Database {
    const DB_HOST = 'localhost';
    const DB_USER = 'id18897236_root';
    const DB_PASS = 'Ss-9163526847';
    const DB_NAME = 'id18897236_scandiweb';
    private $conn;
    private $stmt;

    public function __construct() {
        $this->conn = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
    }

    public function getAllProducts() {
        $query = "SELECT * FROM products ORDER BY SKU";
        return mysqli_query($this->conn, $query);
    }

    public function displayProducts() {
        $result = $this->getAllProducts();
        while($row = mysqli_fetch_assoc($result)) {
            $productType = $row['Type'];
            $product = new $productType($row['SKU'], $row['Name'], $row['Price']);
            $product->attribute = $row[$product::ATTRIBUTE_NAME];
            $product->displayProduct();
        }
        return;
    }

    public function addToDatabase($data) {
        $productData = json_decode($data);
        $productType = $productData->{'type'};
        $product = new $productType($productData->{'sku'}, $productData->{'name'}, $productData->{'price'});
        $product->attribute = $productData->{'attribute'};
        if ($product->checkSKU($product->sku, $this->getAllProducts())) {
            mysqli_query($this->conn, $product->getAddQuery());
            return true;
        }
        else {
            return false;
        }
    }

    public function deleteFromDatabase($checkedProducts) {
        for ($i = 0; $i < count($checkedProducts); $i++) {
            $query = "DELETE FROM `products` WHERE `products`.`SKU` = '{$checkedProducts[$i]}'";
            mysqli_query($this->conn, $query);
        }
        return;
    }
}
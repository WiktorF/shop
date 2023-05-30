<?php

namespace App\ValueObjects;

use App\Models\Product;

class CartItem{

    private int $productId;
    private string $name;
    private float $price;
    private ?string $imagePath;
    private int $quantity = 0;

    public function __construct(Product $product, int $quantity = 1){
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->imagePath = $product->imagePath;
        $this->quantity += $quantity;
    }

    public function getProductId(){
        return $this->productId;
    }


    public function getName(){
        return $this->name;
    }


    public function getPrice(){
        return $this->price;
    }


    public function getQuantity(){
        return $this->quantity;
    }

    public function getImagePath(){
        return $this->imagePath;
    }

    public function getSum(){
        return $this->price * $this->quantity;
    }

    public function addQuantity(Product $product){
        return new CartItem($product, ++$this->quantity);
    }
}

?>

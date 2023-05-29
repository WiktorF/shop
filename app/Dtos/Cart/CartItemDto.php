<?php

namespace App\Dtos\Cart;

class CartItemDto{

    private int $productId;
    private string $name;
    private float $price;
    private int $quantity;
    private ?string $imagePath;

    public function getProductId(){
        return $this->productId;
    }
    public function setProductId(int $productId){
        $this->productId = $productId;
    }

    public function getName(){
        return $this->name;
    }
    public function setName(string $name){
        $this->name = $name;
    }

    public function getPrice(){
        return $this->price;
    }
    public function setPrice(float $price){
        $this->price = $price;
    }

    public function getQuantity(){
        return $this->quantity;
    }
    public function setQuantity(int $quantity){
        $this->quantity = $quantity;
    }

    public function getImagePath(){
        return $this->imagePath;
    }
    public function setImagePath(?string $imagePath){
        $this->imagePath = $imagePath;
    }

    public function incrementQuantity(){
        $this->quantity += 1;
    }
}

?>

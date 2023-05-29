<?php

namespace App\Dtos\Cart;


class CartDto{
    private array $items = [];
    private float $totalSum = 0;
    private int $totalQuantity = 0;

    public function getItems(){
        return $this->items;
    }
    public function setItems(array $items){
        return $this->items = $items;
    }

    public function getTotalSum(){
        return $this->totalSum;
    }
    public function setTotalSum(float $totalSum){
        return $this->totalSum = $totalSum;
    }

    public function getTotalQuantity(){
        return $this->totalQuantity;
    }
    public function setTotalQuantity(int $totalQuantity){
        return $this->totalQuantity = $totalQuantity;
    }

    public function incrementTotalQuantity(){
        $this->totalQuantity += 1;
    }

    public function incrementTotalSum(float $price){
        $this->totalSum += $price;
    }
}

?>

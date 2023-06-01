<?php

namespace App\ValueObjects;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;

class Cart{
    private Collection $items;

    public function __construct(Collection $items = null){
        $this->items = $items ?? Collection::empty();
    }

    public function getItems(){
        return $this->items;
    }

    public function getSum(){
        return $this->items->sum(function ($item){
            return $item->getSum();
        });
    }

    public function getQuantity(){
        return $this->items->sum(function ($item){
            return $item->getQuantity();
        });
    }

    public function addItem(Product $product){
        $items = $this->items;
        $item = $items->first($this->isProductIdSameAsItemProduct($product));
        if(!is_null($item)){
            $items = $items->reject($this->isProductIdSameAsItemProduct($product));
            $newitem = $item->addQuantity($product);
        }else{
            $newitem = new CartItem($product);
        }
        $items->add($newitem);
        return new Cart($items);
    }

    public function removeItem(Product $product){
        $items = $this->items->reject($this->isProductIdSameAsItemProduct($product));
        return new Cart($items);
    }

    public function hasItems():bool
    {
        return $this->items->isNotEmpty();
    }

    public function isProductIdSameAsItemProduct(Product $product){
        return function($item) use ($product){
            return $product->id == $item->getProductId();
        };
    }
}

?>

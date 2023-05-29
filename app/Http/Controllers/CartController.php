<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Dtos\Cart\CartDto;
use App\Dtos\Cart\CartItemDto;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function store(Product $product)
    {
        $cart = Session::get('cart', new CartDto());
        $items = $cart->getItems();
        if(Arr::exists($items, $product->id)){
            $items[$product->id]->incrementQuantity();
        }else{
            $cartItemDto = $this->getCartItemDto();
            $items[$product->id] = $cartItemDto;
        }
        $cart->setItems($items);
        $cart->incrementTotalQuantity();
        $cart->incrementTotalSum($product->price);

        Session::put('cart', $cart);
        return response()->json([
            'status' => 'success',
        ]);
    }
    private function getCartItemDto(Product $product){
            $cartItemDto = new CartItemDto();
            $cartItemDto->setProductId($product->id);
            $cartItemDto->setName($product->name);
            $cartItemDto->setPrice($product->price);
            $cartItemDto->setQuantity(1);
            $cartItemDto->setImagePath($product->image_path);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd($cart = Session::get('cart', new CartDto()));
        return view('home');
    }
}

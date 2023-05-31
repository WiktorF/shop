<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\ValueObjects\Cart;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\ValueObjects\CartItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\Template\Exception;

class CartController extends Controller
{
    public function store(Product $product)
    {
        $cart = Session::get('cart', new Cart());
        Session::put('cart', $cart->addItem($product));
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('cart.index', [
            'cart' => Session::get('cart', new Cart()),
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        try {
            $cart = Session::get('cart', new Cart());
            Session::put('cart', $cart->removeItem($product));
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd'
            ])->setStatusCode(500);
        }
    }
}

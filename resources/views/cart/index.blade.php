@extends('layouts.app')

@section('content')
    <div class="container">
        @include('helpers.flash_massages')
        <div class="cart_section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="cart_container">
                            <div class="cart_title">{{__('shop.cart.cart')}}<small> ({{ $cart->getItems()->count() }}) </small></div>
                                <form action="{{route('orders.store')}}" method="POST" id="order-form">
                                    @csrf
                                    <div class="cart_items">
                                        <ul class="cart_list">
                                            @foreach ($cart->getItems() as $item )
                                                <li class="row text-center justify-content-center cart_item clearfix align-items-center">
                                                        <div class="col-md-2">
                                                            <img src="{{$item->getImagePath()}}" class="img-fluid mx-auto d-block" alt="Product image">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="cart_item_title">{{__('shop.cart.name')}}</div>
                                                            <div class="cart_item_text">{{ $item->getName() }}</div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="cart_item_title">{{__('shop.cart.quantity')}}</div>
                                                            <div class="cart_item_text">{{ $item->getQuantity() }}</div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="cart_item_title">{{__('shop.cart.price')}} [PLN]</div>
                                                            <div class="cart_item_text">{{ $item->getPrice()}}</div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="cart_item_title">{{__('shop.cart.total')}} [PLN]</div>
                                                            <div class="cart_item_text">{{ $item->getSum() }}</div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $item->getProductId() }}">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="order_total">
                                        <div class="order_total_content text-md-right">
                                            <div class="order_total_title">{{__('shop.cart.order_total')}}:</div>
                                            <div class="order_total_amount">{{ $cart->getSum() }}</div>
                                        </div>
                                    </div>
                                    <div class="cart_buttons">
                                        <a href="/" class="button cart_button_clear">{{__('shop.cart.button.continue')}}</a>
                                        <button type="submit" class="button cart_button_checkout" {{ !$cart->hasItems() ? 'disabled' : '' }}>{{__('shop.cart.button.pay')}}</button>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
const deleteUrl = "{{url('cart')}}/";
@endsection
@section('js-files')
    @vite(['resources/css/cart.css', 'resources/js/delete.js'])
@endsection

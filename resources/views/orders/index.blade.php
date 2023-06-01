@extends('layouts.app')

@section('content')
<div class="container">
        @include('helpers.flash_massages')
    <div class="row">
        <div class="col-6">
            <h1><i class="fa-solid fa-list"></i> {{__('shop.cart.list')}} </h1>
        </div>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">{{__('shop.product.fields.amount')}}</th>
                    <th scope="col">{{__('shop.product.fields.price')}}</th>
                    <th scope="col">{{__('shop.welcome.products')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td scope="row">{{$order->quantity}}</td>
                    <td scope="row">{{$order->price}} [PLN]</td>
                    <td scope="row">
                        <ul>
                    @foreach ($order->products as $product )
                            <li>{{$product->name}}</li>
                    @endforeach
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$orders->links()}}
    </div>
</div>
@endsection


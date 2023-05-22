@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-6">
                <h1>Lista produktów</h1>
            </div>
            <div class="col-6">
                <a class="float-right" href="{{route('products.create')}}">
                    <button type="button" class="btn btn-primary">Dodaj</button>
                </a>
            </div>
    </div>
    <div class="row">
<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Amount</th>
        <th scope="col">Price</th>
        <th scope="col">Akcje</th>
      </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->amount}}</td>
                <td>{{$product->price}}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}">
                        <button class="btn btn-primary btn-sm">S</button>
                    </a>
                    <a href="{{ route('products.edit', $product->id) }}">
                        <button class="btn btn-dark btn-sm">E</button>
                    </a>
                    <button class="btn btn-danger btn-sm delete" data-id="{{$product->id}}">X</button>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{$products->links()}}
</div>
</div>
  @endsection
  @section('javascript')
    const deleteUrl = "{{url('products')}}/";
  @endsection
  @section('js-files')
    @vite(['resources/js/delete.js'])
  @endsection

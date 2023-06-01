@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('shop.product.show')}}</div>

                <div class="card-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{__('shop.product.fields.name')}}</label>

                            <div class="col-md-6">
                                <input id="name" maxlenght="500" type="text" class="form-control" name="name" value="{{ $product->name }}" autofocus disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{__('shop.product.fields.description')}}</label>

                            <div class="col-md-6">
                                <textarea id="description" maxlenght="1500" class="form-control" type="text" name="description" autofocus disabled>{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="amount" class="col-md-4 col-form-label text-md-end">{{__('shop.product.fields.amount')}}</label>

                            <div class="col-md-6">
                                <input id="amount" min="0" type="number" class="form-control" name="amount" value="{{ $product->amount }}" autofocus disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{__('shop.product.fields.price')}}</label>

                            <div class="col-md-6">
                                <input id="price" step="0.01" min="0" class="form-control" type="number" name="price" value="{{ $product->price }}" autofocus disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('shop.product.fields.category')}}</label>

                            <div class="col-md-6">
                                <select id="category" class="form-control" name="category_id" disabled>
                                    @if($product->hasCategory()))
                                    <option>{{$product->category->name}}</option>
                                    @else
                                    <option>{{__('shop.product.no_category')}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 justify-center">
                                @if(!is_null($product->image_path))
                                    <img src="{{ asset('storage/' . $product->image_path) }}" class="img-fluid mx-auto d-block" alt="Zdjecie">
                                @endif

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

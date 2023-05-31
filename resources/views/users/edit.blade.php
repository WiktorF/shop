@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('shop.user.edit_title', ['email' => $user->email])}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        {{method_field('PUT')}}
                        @csrf

                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">{{__('shop.user.fields.city')}}</label>

                            <div class="col-md-6">
                                <input id="city" maxlenght="255" type="text" class="form-control @error('city') is-invalid @enderror" name="address[city]" value="@if($user->hasAddress()){{$user->address->city}}@endif" required autocomplete="city" autofocus>

                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-end">{{__('shop.user.fields.zip_code')}}</label>

                            <div class="col-md-6">
                                <input id="zip_code" maxlenght="6" type="text" class="form-control @error('zip_code') is-invalid @enderror" name="address[zip_code]" value="@if($user->hasAddress()){{$user->address->zip_code}}@endif" autofocus></input>

                                @error('zip_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="street" class="col-md-4 col-form-label text-md-end">{{__('shop.user.fields.street')}}</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="address[street]" required autocomplete="street" value="@if($user->hasAddress()){{$user->address->street}}@endif" autofocus>

                                @error('street')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="street_no" class="col-md-4 col-form-label text-md-end">{{__('shop.user.fields.street_no')}}</label>

                            <div class="col-md-6">
                                <input id="street_no" maxlength="5" type="text" class="form-control @error('street_no') is-invalid @enderror" name="address[street_no]" value="@if($user->hasAddress()){{$user->address->street_no}}@endif" required autocomplete="street_no">

                                @error('street_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="house_no" class="col-md-4 col-form-label text-md-end">{{__('shop.user.fields.house_no')}}</label>

                            <div class="col-md-6">
                                <input id="house_no" maxlength="5" type="text" class="form-control @error('house_no') is-invalid @enderror" name="address[house_no]" value="@if($user->hasAddress()){{$user->address->house_no}}@endif" required autocomplete="house_no">

                                @error('house_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary float-end">
                                    {{__('shop.button.save')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

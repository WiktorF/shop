@extends('layouts.app')

@section('content')
<div class="container">
    @include('helpers.flash_massages')
    <div class="row">
        <div class="col-12">
            <h1><i class="fa-solid fa-users"></i> {{__('shop.user.index_title')}}</h1>
        </div>

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">E-mail</th>
        <th scope="col">Imie</th>
        <th scope="col">Nazwisko</th>
        <th scope="col">Numer telefonu</th>
        <th scope="col">Akcje</th>
      </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->email}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->surname}}</td>
                <td>{{$user->phone_number}}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}">
                        <button class="btn btn-dark btn-sm"><i class="fa-solid fa-pen"></i></button>
                    </a>
                    <button class="btn btn-danger btn-sm delete" data-id="{{$user->id}}"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{$users->links()}}
</div>
  @endsection
  @section('javascript')
    const deleteUrl = "{{url('users')}}/";
  @endsection
  @section('js-files')
    @vite(['resources/js/delete.js'])
  @endsection

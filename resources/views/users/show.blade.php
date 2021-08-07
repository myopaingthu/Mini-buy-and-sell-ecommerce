@extends('layouts.app')

@section('css')
<style>
    .profile-photo{
            width: 200px;
            height: 200px;
        }
    @media only screen and (max-width: 600px) {
        .profile-photo{
            width: 200px;
            height: 200px;
        }
    }
</style>
@endsection

@section('page', 'User Profile')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{$user->profile ? asset('image/'.$user->profile) :'https://ui-avatars.com/api/?name='.$user->name}}" class="img-thumbnail mx-auto profile-photo" alt="...">
                    <div class="mt-2">
                        <h5 class="card-title">{{$user->name}}</h5>
                        <a class="btn btn-dark" href="{{route('userProduct', [$user->id])}}">{{$user->products_count}} products <i class="fa fa-list"></i></a>
                        <a class="btn btn-dark" href="{{route('userFavourites', [$user->id])}}">{{$user->favourites_count}} favourites <i class="fa fa-heart"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
      <div class="card mb-2">
        <div class="card-body">
          <div class="row justify-content-center">
            <h5 class="car-title">User Information</h5>
          </div>
          <div class="form-group row">
            <div class="col-md-2">
              <h6 class="card-title">Full Name</h6>
            </div>
            <div class="col-md-10">
              <p class="card-text">{{$user->name}}</p>
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <div class="col-md-2">
              <h6 class="card-title">Email</h6>
            </div>
            <div class="col-md-10">
              <p class="card-text">{{$user->email}}</p>
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <div class="col-md-2">
              <h6 class="card-title">Phone</h6>
            </div>
            <div class="col-md-10">
              <p class="card-text">{{$user->phone}}</p>
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <div class="col-md-2">
              <h6 class="card-title">Address</h6>
            </div>
            <div class="col-md-10">
              <p class="card-text">{{$user->address}}</p>
            </div>
          </div>
          <hr>
          <a class="btn btn-dark" href="{{route('users.edit', [$user->id])}}">Edit  <i class="fa fa-user-edit"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection




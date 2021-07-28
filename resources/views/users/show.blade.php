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
@if ($message = Session::get('invalid-data'))
<div class="toast bg-dark text-white" style="position: absolute; top: 20; left: 0; z-index: 5;" data-delay="5000">
    <div class="toast-header">
      <strong class="mr-auto">Opps!!</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
        {{$message}}
    </div>
</div>
@endif
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{asset('image/'.($user->profile ? $user->profile : '20210505144131.jpg'))}}" class="img-thumbnail mx-auto profile-photo" alt="...">
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

@section('script')
<script>
  $('.toast').toast('show')
</script>
@endsection


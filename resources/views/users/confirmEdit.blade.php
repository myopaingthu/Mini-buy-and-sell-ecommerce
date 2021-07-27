@extends('layouts.app')

@section('title', 'User Profile Edit')

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

@section('page', 'Edit Confirmation')

@section('content')
<div class="container-fluid">
    <form method="POST" action="{{ route('users.update', [$user['id']]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
    <div class="row">
      <div class="col-md-4">
          <div class="card">
              <div class="card-body">
                  <div class="text-center">
                      <img src="{{asset('image/'.($user['profile'] ? $user['profile'] : '20210505144131.jpg'))}}" class="img-thumbnail mx-auto profile-photo">
                    <input type="hidden" name="profile" value="{{$user['profile']}}">
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-8">
        <div class="card mb-2">
          <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">{{ __('Name') }}</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="name" value="{{$user['name']}}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">{{ __('Email Address') }}</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="email" value="{{$user['email']}}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">{{ __('Phone') }}</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="phone" value="{{$user['phone']}}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">{{ __('Address') }}</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="address" value="{{$user['address']}}" readonly>
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-dark">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
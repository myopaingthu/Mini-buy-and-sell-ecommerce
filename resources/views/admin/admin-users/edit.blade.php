@extends('admin.app')

@section('title', 'Users edit')

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Edit User
            </div>
        </div>
    </div>
</div>            
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('adminusers.update', $user->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">{{ __('Name') }}</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="name" value="{{$user->name}}">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-2 col-form-label">{{ __('Email Address') }}</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="email" value="{{$user->email}}">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-2 col-form-label">{{ __('Password') }}</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" name="password" value="{{old('password')}}">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirmation" class="col-md-2 col-form-label">{{ __('Confirm Password') }}</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" name="password_confirmation" value="{{old('password')}}">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <a href="#" class="btn btn-secondary back-btn">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection


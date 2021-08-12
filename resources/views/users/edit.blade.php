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

@section('page', 'User Profile Edit')

@section('content')
<div class="container-fluid">
    <form method="POST" action="{{ route('confirmEdit') }}" enctype="multipart/form-data">
        @csrf
    <div class="row">
      <div class="col-md-4">
          <div class="card">
              <div class="card-body">
                  <div class="text-center">
                      <img src="{{$user->profile ? asset('image/'.$user->profile) :'https://ui-avatars.com/api/?name='.$user->name}}" class="img-thumbnail mx-auto profile-photo" id="preview-image-before-upload">
                      <div class="mt-2">
                        <div class="custom-file">
                            <input type="file" name="profile" class="custom-file-input" id="image">
                            <label class="custom-file-label" for="customFile">Choose Photo</label>
                        </div>
                      </div>
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
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">{{ __('Email Address') }}</label>
                <div class="col-md-10">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">{{ __('Phone') }}</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">{{ __('Address') }}</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="address" value="{{$user->address}}">
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-dark">
                        {{ __('Submit') }}
                    </button>
                    <a class="btn btn-dark float-right" href="{{route('change.password.show')}}">Change password <i class="fa fa-unlock"></i></a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function (e) {
$('#image').change(function(){
let reader = new FileReader();
reader.onload = (e) => { 
    $('#preview-image-before-upload').attr('src', e.target.result); 
}
reader.readAsDataURL(this.files[0]); 
});
});  
</script>
@endsection
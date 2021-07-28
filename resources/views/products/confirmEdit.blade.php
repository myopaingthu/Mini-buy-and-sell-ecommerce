@extends('layouts.app')

@section('title', 'Confirmation')

@section('css')
<style>
    #images-preview-div img
    {
    padding: 10px;
    max-width: 100px;
    }
</style>
@endsection

@section('page', 'Edit Confirmation')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-body">
                    <form method="POST" action="{{ route('products.update', [$id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row" id="images-preview-div"> 
                            @foreach ($images as $image)
                                <img src="{{asset('images/'.$image)}}" alt="product">
                                <input type="hidden" name="images[]" value="{{$image}}">
                            @endforeach
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{$edited_product['name']}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Choose Category') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="cat" value="{{$category->name}}" readonly>
                                <input type="hidden" class="form-control" name="category" value="{{$category->id}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="price" value="{{$edited_product['price']}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <input type="tel" class="form-control" name="phone" value="{{$edited_product['phone']}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" style="height:60px" name="address" readonly>{{$edited_product['address']}}</textarea>
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" style="height:60px" name="description" readonly>{{$edited_product['description']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Submit') }}
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
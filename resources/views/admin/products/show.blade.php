@extends('admin.app')

@section('title', 'Product Show')

@section('css')
<style>
    #images-preview-div img
    {
    padding: 10px;
    max-width: 100px;
    max-height: 100px;
    }
</style>
@endsection

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-tags icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Product Detail
            </div>
        </div>
    </div>
</div>            
<div class="card">
    <div class="card-body">
        @if ($product->images->isNotEmpty())
            <div class="row" id="images-preview-div">
                 @foreach ($product->images as $image)
                    <img src="{{asset('images/'.$image->name)}}" alt="product">
                @endforeach
            </div>
        @endif 
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label">{{ __('Name') }}</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" value="{{$product->name}}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="category" class="col-md-2 col-form-label">{{ __('Category') }}</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" value="{{$product->category->name}}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-md-2 col-form-label">{{ __('Price') }}</label>
            <div class="col-md-10">
                <input type="number" class="form-control" name="price" value="{{$product->price}}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="seller" class="col-md-2 col-form-label">{{ __('Seller') }}</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="seller" value="{{$product->user->name}}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-md-2 col-form-label">{{ __('Phone Number') }}</label>
            <div class="col-md-10">
                <input type="tel" class="form-control" name="phone" value="{{ $product->phone }}" readonly>
                @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-md-2 col-form-label">{{ __('Address') }}</label>
            <div class="col-md-10">
                <textarea class="form-control" style="height:60px" name="address" readonly>{{ $product->address }}</textarea>
                @error('address')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-md-2 col-form-label">{{ __('Description') }}</label>
            <div class="col-md-10">
                <textarea class="form-control" style="height:100px" name="description" readonly>{{ $product->description }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="date" class="col-md-2 col-form-label">{{ __('Create at') }}</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" value="{{$product->created_at}}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-md-2 col-form-label">{{ __('Status') }}</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" value="{{$product->available == 1 ? 'Available' : 'Sold out'}}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="date" class="col-md-2 col-form-label">{{ __('Updated at') }}</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="name" value="{{$product->updated_at}}" readonly>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <a href="#" class="btn btn-secondary back-btn">Go back</a>
            </div>
        </div>
    </div>
</div>

@endsection


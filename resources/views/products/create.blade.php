@extends('layouts.app')

@section('title', 'Sell')

@section('css')
<style>
    #images-preview-div img
    {
    padding: 10px;
    max-width: 100px;
    }
</style>
@endsection

@section('page', 'Sell Your Product')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-body">
                    <form method="POST" action="{{ route('confirmCreate') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <div class="form-group row">
                            <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Choose Photo') }}</label>
                            <div class="col-md-6">
                                <div class="custom-file">
                                    <input type="file" name="images[]" class="custom-file-input @error('images') is-invalid @enderror" id="images"  multiple>
                                    <label class="custom-file-label" for="customFile">Select once to upload multiple</label>
                                    @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror  
                                    @error('images.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror  
                                </div>
                            </div>
                        </div>
                            <div class="row" id="images-preview-div"> </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Product Name" value="{{ old('name') }}" autofocus>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Choose Category') }}</label>
                            <div class="col-md-6">
                            <select class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>  
                                @endforeach
                            </select>
                            @error('category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Enter Your Product Price" value="{{ old('price') }}">
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Plz Describe Number to Contact" value="{{ old('phone') }}">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('address') is-invalid @enderror" style="height:60px" name="address" placeholder="Describe Location for Product">{{ old('address') }}</textarea>
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('description') is-invalid @enderror" style="height:60px" name="description" placeholder="Describe Detail about Product (Optional)">{{ old('description') }}</textarea>
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

@section('script')
<script>
    $(function() {
    // Multiple images preview with JavaScript
    var previewImages = function(input, imgPreviewPlaceholder) {
    if (input.files) {
    var filesAmount = input.files.length;
    for (i = 0; i < filesAmount; i++) {
    var reader = new FileReader();
    reader.onload = function(event) {
    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
    }
    reader.readAsDataURL(input.files[i]);
    }
    }
    };
    $('#images').on('change', function() {
    previewImages(this, 'div#images-preview-div');
    });
    });
</script>
@endsection
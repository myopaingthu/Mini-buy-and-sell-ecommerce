@extends('admin.app')

@section('title', 'Product Create')

@section('css')
<style>
    #images-preview-div img
    {
    padding: 10px;
    max-width: 100px;
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
            <div>Create new product
            </div>
        </div>
    </div>
</div>            
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('backend-products.store') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="images" class="col-md-2 col-form-label">{{ __('Choose Photo') }}</label>
                <div class="col-md-10">
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
                <label for="name" class="col-md-2 col-form-label">{{ __('Name') }}</label>
                <div class="col-md-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="category" class="col-md-2 col-form-label">{{ __('Choose Category') }}</label>
                <div class="col-md-10">
                    <select class="form-control" name="category" value="{{ old('category') }}">
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
                <label for="price" class="col-md-2 col-form-label">{{ __('Price') }}</label>
                <div class="col-md-10">
                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old('price')}}">
                    @error('price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-md-2 col-form-label">{{ __('Phone Number') }}</label>
                <div class="col-md-10">
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-md-2 col-form-label">{{ __('Address') }}</label>
                <div class="col-md-10">
                    <textarea class="form-control @error('address') is-invalid @enderror" style="height:60px" name="address">{{ old('address') }}</textarea>
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-md-2 col-form-label">{{ __('Description') }}</label>
                <div class="col-md-10">
                    <textarea class="form-control" style="height:60px" name="description">{{ old('description') }}</textarea>
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
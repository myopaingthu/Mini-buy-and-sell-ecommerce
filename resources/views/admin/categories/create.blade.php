@extends('admin.app')

@section('title', 'Category Create')

@section('content')

<div class="app-page-title mb-2">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-stream icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Create category
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('backend-categories.store') }}" autocomplete="off">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">{{ __('Name') }}</label>
                <div class="col-md-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                    @error('name')
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
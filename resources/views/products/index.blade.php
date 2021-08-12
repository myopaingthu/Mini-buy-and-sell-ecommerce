@extends('layouts.app')

@section('title', 'Products')

@section('css')
<style>
    .card-size{
        width: 14rem;
        height: 16rem; 
    }
    .text-size{
            overflow: hidden;
            text-overflow: ellipsis;
        }
    @media only screen and (max-width: 600px) {
        .card-size{
        width: 10rem;
        height: 14rem; 
        }
        .text-size{
            font-size: 15px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-3">
            <form action="{{route('search')}}" method="GET">
                @csrf
                <div class="input-group">
                    <input class="form-control py-2" name="search" type="search" placeholder="Search products...">
                    <span class="input-group-append">
                      <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                            <i class="fa fa-search"></i>
                      </button>
                    </span>
                </div>
                @error('search')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </form>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3 text-md-right mt-md-0 mt-2">
            <form action="{{route('sort')}}" method="GET">
                @csrf
                <div class="form-group row">
                    <label for="type" class="col-4 col-form-label">{{ __('Sort by') }}</label>
                    <div class="col-8">
                    <select class="form-control" name="type">
                        <option value="date">Date</option>
                        <option value="price">Price</option>  
                    </select>
                    </div>
                </div>
        </div>
        <div class="col-md-3">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="sort" value="ascend" class="custom-control-input" required>
                <label class="custom-control-label" for="customRadioInline1">Ascending</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="sort" value="descend" class="custom-control-input" required>
                <label class="custom-control-label" for="customRadioInline2">Descending</label>
            </div>
            <button type="submit" class="btn btn-secondary">
                {{ __('Sort') }}
            </button>
        </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidebar')
            {{-- <div class="bg-gray mt-3">
                <form action="{{route('search')}}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input class="form-control py-2" name="search" type="search" placeholder="Search products...">
                        <span class="input-group-append">
                          <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                                <i class="fa fa-search"></i>
                          </button>
                        </span>
                    </div>
                    @error('search')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </form>
                <hr>
                <div class="mt-3">
                    <form action="{{route('sort')}}" method="GET">
                        @csrf
                        <div class="form-group row">
                            <label for="type" class="col-4 col-form-label">{{ __('Sort by') }}</label>
                            <div class="col-8">
                            <select class="form-control" name="type">
                                <option value="date">Date</option>
                                <option value="price">Price</option>  
                            </select>
                            </div>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="sort" value="ascend" class="custom-control-input" required>
                            <label class="custom-control-label" for="customRadioInline1">Ascending</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="sort" value="descend" class="custom-control-input" required>
                            <label class="custom-control-label" for="customRadioInline2">Descending</label>
                        </div>
                        <button type="submit" class="btn btn-secondary">
                            {{ __('Sort') }}
                        </button>
                    </form>
                </div>
            </div> --}}
        </div>
        <div class="col-md-9">
            <div class="container-fluid mt-3 mt-sm-0 pl-0">
                <div class="row row-cols-2 row-cols-md-4">
                @foreach ($products as $product)
                    <div class="col mb-3">
                    <div class="card card-size">
                        @if($product->images->count() > 0)
                        <img src="{{asset('images/'.$product->images->first()->name)}}" class="card-img-top" style="height: 50%;"  alt="...">
                        @else
                        <img src="{{asset('image/20210505144131.jpg')}}" class="card-img-top" style="max-height: 50%;"  alt="...">
                        @endif
                        <div class="card-body text-size">
                            <h6 class="card-title">{{$product->price}} mmk</h6>
                            <p class="card-text">{{$product->name}}</p>
                            <a href="{{route('products.show' , [$product->id])}}" class="stretched-link"></a>
                        </div>
                    </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div> 
    </div>
</div>
{!! $products->withQueryString()->links() !!}

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $(".card").hover(function(){
        $(this).addClass("text-white bg-dark");
        }, function(){
        $(this).removeClass("text-white bg-dark");
        });
    });
</script>
@endsection

@extends('layouts.app')

@section('title', 'Products')

@section('css')
<style>
    .card-size{
        width: 14rem;
        height: 18rem; 
    }
    .text-size{
            overflow: hidden;
            text-overflow: ellipsis;
        }
    @media only screen and (max-width: 600px) {
        .card-size{
        width: 9rem;
        height: 15rem; 
        }
    }
</style>
@endsection

@section('page', 'Search Result')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-3">
          <div class="jumbotron bg-white p-3">
                @if ($products->isNotEmpty())
                    <h6 class="card-subtitle">{{ $products->count() }} products for '{{ request()->input('search') }}'</h6>
                @else
                <h6 class="card-subtitle">Sorry,No products found for '{{ request()->input('search') }}'</h6>
                @endif
          </div>
        </div>
        <div class="col-md-9">
            <div class="container-fluid mt-3 mt-sm-0">
                <div class="row row-cols-2 row-cols-md-4">
                @foreach ($products as $product)
                    <div class="col mb-5">
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
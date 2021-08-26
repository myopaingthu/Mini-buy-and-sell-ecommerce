@extends('layouts.app')

@section('title', 'Products')

@section('css')
<style>
    .card-size{
        width: 195px;
        height: 250px; 
    }
    .text-size{
        height: 36px;
        line-height: 18px;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
        margin-bottom: 4px;
        font-size: 16px;
        }
    @media only screen and (max-width: 600px) {
        .card-size{
        width: 10rem;
        height: 14rem; 
        }
        .text-size{
            height: 36px;
            line-height: 18px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            margin-bottom: 4px;
            font-size: 15px;
        }
    }
</style>
@endsection

@section('page')
Your Products
<span class="badge badge-secondary">{{$products->count()}}</span>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="container-fluid mt-3 mt-sm-0">
            <div class="row row-cols-2 row-cols-md-6">
            @foreach ($products as $product)
                <div class="col mb-3">
                <div class="card card-size">
                    @if($product->images->count() > 0)
                    <img src="{{asset('storage/images/'.$product->images->first()->name)}}" class="card-img-top" style="height: 60%;"  alt="...">
                    @else
                    <img src="{{asset('storage/images/16297091780.jpg')}}" class="card-img-top" style="height: 60%;"  alt="...">
                    @endif
                    <div class="card-body p-0">
                        <h6 class="card-title mt-1 ml-1">{{$product->price}} mmk</h6>
                        <div class="card-text ml-1 text-size">{{$product->name}}</div>
                        <a href="{{route('products.show' , [$product->id])}}" class="stretched-link"></a>
                    </div>
                </div>
                </div>
            @endforeach
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
